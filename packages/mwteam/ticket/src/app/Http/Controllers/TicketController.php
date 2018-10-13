<?php

namespace Mwteam\Ticket\Controllers;

use App\Helpers\DatetimeHelper;
use App\Helpers\PackageHelper;
use App\Http\Controllers\Controller;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Validator;
use Mwteam\Ticket\App\Models\Ticket;
use Mwteam\Ticket\App\Models\TicketMessages;
use Illuminate\Pagination\Paginator;

class TicketController extends Controller
{
    public function index(Request $request)
    {
        $this->authorize('tickets', Ticket::class);

        $this->validate($request,[
            'id' => 'nullable|integer|min:1',
            'user' => 'nullable',
            'status' => 'nullable|string|in:all,'. implode(',',array_keys(Ticket::statuses())),
            'from-date' => ['nullable','regex:/^1[3-9][0-9]{2}\/(0[1-9]|1[0-2])\/(0[1-9]|[1-2][0-9]|3[0-1])$/'],
            'to-date' => ['nullable','regex:/^1[3-9][0-9]{2}\/(0[1-9]|1[0-2])\/(0[1-9]|[1-2][0-9]|3[0-1])$/'],
        ]);

        if (isset($request['from-date']) && $request['from-date'] != '' && !DatetimeHelper::checkJalaliDate($request['from-date'].' 00:00:00')){
            return redirect()->back()->withErrors(['از تاریخ صحیح نمی باشد'])->withInput($request->toArray());
        }

        if (isset($request['to-date']) && $request['to-date'] != '' && !DatetimeHelper::checkJalaliDate($request['to-date'].' 00:00:00')){
            return redirect()->back()->withErrors(['تا تاریخ صحیح نمی باشد'])->withInput($request->toArray());
        }

        $hasFilter = count($request->except('page')) == 0 ? false:true;
        $statuses = ['all' => 'همه'];
        $statuses = array_merge($statuses,Ticket::statuses());

        $query = Ticket::query();

        if (isset($request['id']) && $request['id'] != "") {
            $query->where('id','like','%'.$request['id'].'%');
        }

        if (isset($request['user']) && $request['user'] != "") {
            $query->whereHas('userWithTrashed',function ($q) use ($request){
                $q->where('username','like','%'.$request['user'].'%');
            });
        }else{
            $query->with('userWithTrashed');
        }

        if (isset($request['status']) && $request['status'] != "" && $request['status'] != 'all') {
            $query->where('status', $request['status']);
        }

        if (isset($request['from-date']) && $request['from-date'] != "") {
            $query->where('created_at','>=',DatetimeHelper::toGregorianDatetime($request['from-date'].' 00:00:00'));
        }

        if (isset($request['to-date']) && $request['to-date'] != "") {
            $query->where('created_at','<=',DatetimeHelper::toGregorianDatetime($request['to-date'].' 23:59:59'));
        }

        $query->orderBy('updated_at','desc');
        $tempQuery = clone $query;
        $tickets = $query->paginate(2);

        if ($tickets->count() == 0 && $request['page'] != 1){
            Paginator::currentPageResolver(function ()  {
                return 1;
            });

            $tickets = $tempQuery->paginate(2);
        }

        return view('ticket::dashboard.index')->with(['tickets' => $tickets, 'hasFilter' => $hasFilter,
            'request' => $request->all(),'statuses' => $statuses]);
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
                'sent_from' => 'admin-panel',
                'message' => $request['message'],
                'file' => $fileName,
            ]);

            if (!is_null($file)) {
                $file->move(Ticket::getFilePath($ticket->id), $fileName);
            }
        }catch (\Exception $e){
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
                'sent_from' => 'admin-panel',
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
            abort(500);
        }

        DB::commit();
        session()->flash('success', 'پیام ارسال گردید.');
        return redirect()->back();
    }

    public function status(Request $request, $ticketId)
    {
        $this->authorize('tickets', Ticket::class);
        $ticket = Ticket::where('id', $ticketId)->firstOrFail();

        $validator = Validator::make($request->all(), [
            'status' => 'required|string|in:'. implode(',',array_keys(Ticket::statuses())),
        ]);

        if ($validator->fails()){
            return response()->json(['status' => false]);
        }

        $ticket->update([
            'status' => $request['status']
        ]);

        return response()->json(['status' => true]);
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

        File::deleteDirectory(Ticket::getFilePath($ticketId));
        File::deleteDirectory(Ticket::getFilePath($ticketId));

        session()->flash('success','تیکت شماره '. $ticketId .' حذف گردید.');
        return redirect()->route('dashboard.tickets.index');
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

}
