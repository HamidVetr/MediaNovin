<?php

namespace App\Http\Controllers\Dashboard;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AdminController extends Controller
{
    public function index()
    {
        return view('dashboard.admins.index');
    }

    public function create()
    {
        return view('dashboard.admins.create');
    }

    public function store(Request $request)
    {

    }

    public function edit($adminId)
    {
        return view('dashboard.admins.edit');
    }

    public function update($adminId, Request $request)
    {

    }

    public function destroy($adminId)
    {

    }

    public function showPermissions()
    {
        return view('dashboard.admins.permissions');
    }

    public function updatePermissions()
    {

    }

    public function active($adminId)
    {

    }

    public function deactive($adminId)
    {

    }
}
