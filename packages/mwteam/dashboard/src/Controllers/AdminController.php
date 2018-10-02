<?php

namespace App\Http\Controllers\Dashboard;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware('admin:admins');
    }

    public function index(Request $request)
    {
        $hasFilter = count($request->except('page')) > 0 ? true:false;
        $admins = User::admins()->withTrashed()->orderBy('deleted_at')->paginate(1);

        return view('dashboard.admins.index')->with(['admins' => $admins , 'hasFilter' => $hasFilter]);
    }

    public function create()
    {
        $admin = new User();
        return view('dashboard.admins.create')->with(['admin' => $admin]);
    }

    public function store(Request $request)
    {
        $this->validate($request,[
            'first_name' => 'required|string|max:191',
            'last_name' => 'required|string|max:191',
            'username' => 'required|string|max:191|unique:users',
            'email' => 'required|string|max:191|unique:users',
            'password' => 'required|string|min:6|max:191|confirmed',
        ]);

        $admin = User::create([
            'first_name' => $request['first_name'],
            'last_name' => $request['last_name'],
            'username' => $request['username'],
            'email' => $request['email'],
            'password' => bcrypt($request['password']),
            'role' => 1
        ]);

        session()->flash('success','مدیر جدید ایجاد گردید. اکنون می توانید دسترسی های مدیر جدید را تعیین نمایید.');
        return redirect()->route('dashboard.admins.showPermissions',['adminId' => $admin->id]);
    }

    public function edit($adminId)
    {
        $admin = User::admins()->where('id', $adminId)->firstOrFail();
        return view('dashboard.admins.edit')->with(['admin' => $admin]);
    }

    public function update($adminId, Request $request)
    {
        $admin = User::admins()->where('id', $adminId)->firstOrFail();

        $this->validate($request,[
            'first_name' => 'required|string|max:191',
            'last_name' => 'required|string|max:191',
            'username' => 'required|string|max:191|unique:users,username,'.$adminId. ',id',
            'email' => 'required|string|max:191|unique:users,email,'.$adminId. ',id',
            'password' => 'nullable|string|min:6|max:191|confirmed',
        ]);

        $admin->update([
            'first_name' => $request['first_name'],
            'last_name' => $request['last_name'],
            'username' => $request['username'],
            'email' => $request['email'],
            'password' => is_null($request['password']) ? $admin->password : bcrypt($request['password']),
        ]);

        session()->flash('success','اطلاعات مدیر ویرایش گردید.');
        return redirect()->back();
    }

    public function showPermissions()
    {
        $permissions = [];

        return view('dashboard.admins.permissions');
    }

    public function updatePermissions()
    {

    }

    public function active($adminId)
    {
        User::admins()->where('id', $adminId)->restore();
        session()->flash('success','مدیر با شناسه ' .$adminId. ' فعال گردید.');
        return redirect()->back();
    }

    public function deactive($adminId)
    {
        User::admins()->where('id', $adminId)->where('id', '!=', auth()->user()->id)->delete();
        session()->flash('success','مدیر با شناسه ' .$adminId. ' غیر فعال گردید.');
        return redirect()->back();
    }
}
