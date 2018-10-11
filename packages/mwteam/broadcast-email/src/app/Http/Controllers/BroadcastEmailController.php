<?php

namespace Mwteam\BroadcastEmail\Controllers;

use App\Helpers\DatetimeHelper;
use App\Http\Controllers\Controller;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\DB;
use Mwteam\BroadcastEmail\App\Jobs\SendBroadcastEmail;
use Mwteam\BroadcastEmail\App\Models\BroadcastEmail;

class BroadcastEmailController extends Controller
{
    public function index(Request $request)
    {
        $this->authorize('broadcastEmail', BroadcastEmail::class);

        $this->validate($request,[
            'title' => 'nullable|string'
        ]);

        $hasFilter = count($request->except('page')) > 0 ? true:false;
        $query = BroadcastEmail::latest();

        if (isset($request['title']) && $request['title'] != ''){
            $query->where('title','like','%'.$request['title'].'%');
        }

        $emails = $query->paginate(10);
        return view('broadcast-email::dashboard.index')->with(['emails' => $emails, 'hasFilter' => $hasFilter,
        'request' => $request->all()]);
    }

    public function create()
    {
        $this->authorize('broadcastEmail', BroadcastEmail::class);

        $tempUsers = User::notAdminAndSuperAdmin()->get();
        $users[0] = 'همه کاربران';

        foreach ($tempUsers as $user){
            $users[$user->id] = '&lt; '.$user->username.' &lt; '.$user->email;
        }

        return view('broadcast-email::dashboard.create')->with(['users' => $users]);
    }

    public function store(Request $request)
    {
        $this->authorize('broadcastEmail', BroadcastEmail::class);

        $userIds = User::notAdminAndSuperAdmin()->pluck('id')->toArray();
        $userIds[] = 0;

        $this->validate($request, [
            'title' => 'required|string|max:191',
            'users' => 'required|array',
            'users.*' => 'required|integer|in:'.implode(',',$userIds),
            'content' => 'required|string',
        ]);


        if (in_array(0,$request['users']) && count($request['users']) > 1){
            return redirect()->back()->withInput($request->all())->withErrors(['اطلاعات ارسالی معتبر نمی باشد.']);
        }

        DB::beginTransaction();

        try{
            $query = User::notAdminAndSuperAdmin();

            if ($request['users'][0] != 0){
                 $query->whereIn('id',$request['users']);
            }

            $info = BroadcastEmail::create([
                'title' => $request['title'],
                'content' => $request['content'],
                'users' => $request['users']
            ]);

            $emails = $query->pluck('email')->toArray();

            foreach ($emails as $email) {
                dispatch(new SendBroadcastEmail($email, $info))->onQueue('low');
            }
        }catch (\Exception $e){
            return $e->getMessage();
            DB::rollBack();
            abort(500);
        }

        DB::commit();
        session()->flash('success', 'پیام با موفقیت ارسال گردید');
        return redirect()->route('dashboard.broadcastEmail.index');
    }

    public function show($emailId)
    {
        $this->authorize('broadcastEmail', BroadcastEmail::class);

        $email = BroadcastEmail::where('id',$emailId)->firstOrFail();

        if (count($email->users) == 1 && $email->users[0] == 0){
            $users = null;
        }else{
            $users = User::whereIn('id',$email->users)->get();
        }

        return view('broadcast-email::dashboard.show')->with(['email' => $email, 'users' => $users]);
    }

}
