<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function dashboard()
    {
        if(Auth::user()->user_type_id == 1)
        {
            return view('backend.dashboard.super_admin');
        }
        elseif(Auth::user()->user_type_id == 2)
        {
            return view('backend.dashboard.admin');
        }
        elseif(Auth::user()->user_type_id == 3)
        {
            return view('backend.dashboard.normal_user');
        }
    }
}
