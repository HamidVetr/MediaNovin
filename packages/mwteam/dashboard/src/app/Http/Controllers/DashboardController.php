<?php

namespace Mwteam\Dashboard\App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware('admin');
    }

    public function home()
    {
        return view('dashboard::home');
    }

    public function showProfile()
    {
        return view('dashboard::profile');
    }

    public function updateProfile(Request $request)
    {
        //
    }
}
