<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use \App\Models\User;
use \App\Libraries\Api\Forecast;

class UserController extends Controller
{
    public function login()
    {
        return view('user/login');
    }

    public function mypage()
    {
        $user = Auth::user();
        $forecast = (new Forecast())->loadOverviewText();
        return view('user/index', compact('user', 'forecast'));
    }
}
