<?php

namespace Mwteam\Dashboard\App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Mwteam\Dashboard\App\Models\Permission;

class AdminController extends Controller
{
    public function index(Request $request)
    {
        $this->authorize('admins',User::class);
        $hasFilter = count($request->except('page')) > 0 ? true:false;
        $admins = User::admins()->withTrashed()->orderBy('deleted_at')->paginate(1);

        return view('dashboard::admins.index')->with(['admins' => $admins , 'hasFilter' => $hasFilter]);
    }

    public function create()
    {
        $this->authorize('admins',User::class);
        return view('dashboard::admins.create');
    }

    public function store(Request $request)
    {
        $this->authorize('admins',User::class);
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
            'role' => 'admin'
        ]);

        session()->flash('success','مدیر جدید ایجاد گردید. اکنون می توانید دسترسی های مدیر جدید را تعیین نمایید.');
        return redirect()->route('dashboard.admins.showPermissions',['adminId' => $admin->id]);
    }

    public function edit($adminId)
    {
        $this->authorize('admins',User::class);
        $admin = User::admins()->withTrashed()->where('id', $adminId)->firstOrFail();
        return view('dashboard::admins.edit')->with(['admin' => $admin]);
    }

    public function update($adminId, Request $request)
    {
        $this->authorize('admins',User::class);
        $admin = User::admins()->withTrashed()->where('id', $adminId)->firstOrFail();

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

    public function showPermissions($adminId)
    {
        $this->authorize('admins',User::class);
        $admin = User::admins()->withTrashed()->where('id', $adminId)
            ->with('permissions')
            ->firstOrFail();

        $adminPermissions = $admin->permissions->pluck('id')->toArray();
        $permissions = Permission::all()->mapToGroups(function ($item) use($adminPermissions){
            $key = is_null($item['parent']) ? '0' : $item['parent'];
            return [
                $key => [
                    'id' => $item['id'],
                    'fa_title' => $item['fa_title'],
                    'en_title' => $item['en_title'],
                    'value' => in_array($item['id'], $adminPermissions),
                ]
            ];
        });

        return view('dashboard::admins.permissions')->with(['admin' => $admin, 'permissions' => $permissions]);
    }

    public function updatePermissions(Request $request, $adminId)
    {
        $this->authorize('admins',User::class);
        $admin = User::admins()->withTrashed()->where('id', $adminId)->firstOrFail();

        $this->validate($request, [
            'main-permissions' => 'required|array',
            'main-permissions.*' => 'required|integer|min:1',
            'sub-permissions' => 'nullable|array',
            'sub-permissions.*' => 'nullable|array',
            'sub-permissions.*.*' => 'nullable|integer|min:1',
        ]);

        $permissions = Permission::with('parentItem')->get()->mapToGroups(function ($item){
            $key = is_null($item['parentItem']) ? '0' : $item['parentItem']['id'];
            return [$key => $item['id']];
        });

        //validate inputs
        $mainPermissions = $permissions['0']->toArray();
        $permissionIds = [];

        if (count(array_diff($request['main-permissions'],$mainPermissions)) > 1){
            return redirect()->back()->withErrors(['اطلاعات ارسالی نامعتبر می باشد.'])->withInput($request->all());
        }

        foreach ($request['main-permissions'] as $requestMainPermission){
            $permissionIds[] = $requestMainPermission;

            if (isset($permissions[$requestMainPermission])){
                $subPermissions = $permissions[$requestMainPermission]->toArray();
                $requestSubPermissions = $request['sub-permissions'][$requestMainPermission];

                if (count($requestSubPermissions) == 0 || count(array_diff($requestSubPermissions,$subPermissions)) > 1){
                    return redirect()->back()->withErrors(['اطلاعات ارسالی نامعتبر می باشد.'])->withInput($request->all());
                }

                $permissionIds = array_merge($permissionIds,$requestSubPermissions);
            }
        }

        //update admin permissions
        $admin->permissions()->sync($permissionIds);
        session()->flash('success','تغییرات ذخیره گردید.');
        return redirect()->back();
    }

    public function active($adminId)
    {
        $this->authorize('admins',User::class);
        User::admins()->onlyTrashed()->where('id', $adminId)->restore();
        session()->flash('success','مدیر با شناسه ' .$adminId. ' فعال گردید.');
        return redirect()->back();
    }

    public function deactive($adminId)
    {
        $this->authorize('admins',User::class);
        User::admins()->where('id', $adminId)->where('id', '!=', auth()->user()->id)->delete();
        session()->flash('success','مدیر با شناسه ' .$adminId. ' غیر فعال گردید.');
        return redirect()->back();
    }
}
