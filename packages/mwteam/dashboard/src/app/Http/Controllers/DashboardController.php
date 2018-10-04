<?php

namespace Mwteam\Dashboard\App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function home()
    {
        if (!auth()->user()->isAdminOrSuperAdmin()){
            abort(404);
        }

        return view('dashboard::home');
    }
}
