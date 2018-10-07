<?php

namespace Mwteam\Ticket\Controllers;

use App\Helpers\PackageHelper;
use App\Http\Controllers\Controller;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Response;
use Mwteam\Ticket\App\Models\Ticket;
use Mwteam\Ticket\App\Models\TicketMessages;

class TicketController extends Controller
{
    public function index(Request $request)
    {
        $this->authorize('tickets', Ticket::class);

        $hasFilter = false;
        $tickets = Ticket::orderBy('updated_at')->with(['messages','userWithTrashed'])->paginate(1);
        return view('ticket::dashboard.index')->with(['tickets' => $tickets, 'hasFilter' => $hasFilter,
            'request' => $request->all()]);
    }

    public function create()
    {
        $this->authorize('tickets-send', Ticket::class);

        $users = User::notSuperAdmin()->get()
            ->mapWithKeys(function($item){
                return [$item->id => $item->first_name.' '. $item->last_name. ' - '. $item->username];
            });

        return view('ticket::dashboard.create')->with(['users' => $users]);
    }

    public function store(Request $request)
    {
        $this->authorize('tickets-send', Ticket::class);

        $this->validate($request, [
            'title' => 'required|string|max:191',
            'user' => 'required|integer|min:1',
            'status' => 'required|string|in:'. implode(',',array_keys(Ticket::statuses())),
            'message' => 'required|string',
            'file' => 'nullable|file|mimetypes:'.PackageHelper::getConfig('ticket.validation.file.laravel.mimetypes')
                .'|max:'.PackageHelper::getConfig('ticket.validation.file.laravel.max'),
        ],[
            'file.mimetypes' => 'فرمت فایل معتبر نمی باشد',
            'file.max' => PackageHelper::getConfig('ticket.validation.file.laravel.file-max'),
        ]);

        $user = User::notSuperAdmin()->where('id', $request['user'])->firstOrFail();

        $file = $request->file('file');
        $fileName = null;

        if (!is_null($file)) {
            $fileName = md5(microtime()) . str_random(15) . "." . $file->getClientOriginalExtension();
        }

        DB::beginTransaction();

        try{
            $ticket = Ticket::create([
                'user_id' => $user->id,
                'title' => $request['title'],
                'status' => $request['status'],
            ]);

            TicketMessages::create([
                'ticket_id' => $ticket->id,
                'sender' => auth()->user()->id,
                'message' => $request['message'],
                'file' => $fileName,
            ]);

            if (!is_null($file)) {
                $file->move(Ticket::getFilePath($ticket->id), $fileName);
            }
        }catch (\Exception $e){
            return $e->getMessage();
            DB::rollBack();
            abort(500);
        }

        DB::commit();
        session()->flash('success', 'تیکت جدید با شماره '.$ticket->id.' ارسال گردید');
        return redirect()->route('dashboard.tickets.show',['ticketId' => $ticket->id]);
    }

    public function show($ticketId)
    {
        $this->authorize('tickets', Ticket::class);

        $ticket = Ticket::where('id', $ticketId)->with(['messages.senderWithTrashed','userWithTrashed'])->firstOrFail();
        return view('ticket::dashboard.show')->with(['ticket' => $ticket]);
    }

    public function reply(Request $request, $ticketId)
    {
        $this->authorize('tickets-send', Ticket::class);

        $ticket = Ticket::notClosed()->where('id', $ticketId)->firstOrFail();

        $this->validate($request, [
            'message' => 'required|string',
            'file' => 'nullable|file|mimetypes:'.PackageHelper::getConfig('ticket.validation.file.laravel.mimetypes')
                .'|max:'.PackageHelper::getConfig('ticket.validation.file.laravel.max'),
        ],[
            'file.mimetypes' => 'فرمت فایل معتبر نمی باشد',
            'file.max' => PackageHelper::getConfig('ticket.validation.file.laravel.file-max'),
        ]);

        $file = $request->file('file');
        $fileName = null;

        if (!is_null($file)) {
            $fileName = md5(microtime()) . str_random(15) . "." . $file->getClientOriginalExtension();
        }

        DB::beginTransaction();

        try{
            TicketMessages::create([
                'ticket_id' => $ticket->id,
                'sender' => auth()->user()->id,
                'message' => $request['message'],
                'status' => 'answered',
                'file' => $fileName,
            ]);

            $ticket->update(['updated_at' => Carbon::now()]);

            if (!is_null($file)) {
                $file->move(Ticket::getFilePath($ticket->id),$fileName);
            }
        }catch (\Exception $e){
            DB::rollBack();
            return $e->getMessage();
            abort(500);
        }

        DB::commit();
        session()->flash('success', 'پیام ارسال گردید.');
        return redirect()->back();
    }

    public function destroy($ticketId)
    {
        $this->authorize('tickets-delete', Ticket::class);

        $ticket = Ticket::where('id', $ticketId)->firstOrFail();
        DB::beginTransaction();

        try{
            TicketMessages::where('ticket_id', $ticketId)->delete();
            $ticket->delete();
        }catch (\Exception $e){
            DB::rollBack();
            abort(500);
        }

        DB::commit();
        session()->flash('success','تیکت شماره '. $ticketId .' حذف گردید.');
        return redirect()->back();
    }

    public function destroyMessage($ticketId, $messageId)
    {
        $this->authorize('tickets-delete', Ticket::class);

        Ticket::where('id', $ticketId)->firstOrFail();
        $message = TicketMessages::where('ticket_id', $ticketId)->where('id', $messageId)->firstOrFail();
        $message->delete();

        if (!is_null($message->file)){
            $file = Ticket::getFilePath($ticketId).$message->file;
            File::delete($file);
        }

        session()->flash('success','پیام حذف گردید.');
        return redirect()->back();
    }

    public function status(Request $request, $ticketId)
    {
        $this->authorize('tickets', Ticket::class);
        $ticket = Ticket::where('id', $ticketId)->firstOrFail();

        $this->validate($request, [
            'status' => 'required|string|in:'. implode(',',array_keys(Ticket::statuses())),
        ]);

        $ticket->update([
            'status' => $request['status']
        ]);

        session()->flash('success', 'وضعیت تیکت تغییر یافت');
        return redirect()->back();
    }

    public function file($ticketId, $fileName)
    {
        $this->authorize('tickets', Ticket::class);

        $path = Ticket::getFilePath($ticketId). $fileName;

        if (!File::exists($path)) {
            abort(404);
        }

        $file = File::get($path);
        $type = File::mimeType($path);

        $response = Response::make($file, 200);
        $response->header("Content-Type", $type);

        return $response;
    }
}
