<?php

namespace Mwteam\Dashboard\Controllers;

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
}
