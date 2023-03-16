<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use \App\Models\User;

class UserController extends Controller
{
    public function login()
    {
        return view('user/login');
    }

    public function mypage()
    {
        $user = Auth::user();
        return view('user/index', compact('user'));
    }
}
