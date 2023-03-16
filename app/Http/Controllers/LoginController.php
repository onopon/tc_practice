<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use \App\Models\User;

class LoginController extends Controller
{
    public function attempt(Request $request)
    {
        $loginId = $request->input('login_id');
        $password = $request->input('password');
        $user = User::findWith($loginId, $password);
        if ($user) {
            $request->session()->regenerate();
            Auth::login($user, $remember = true);
        }
        return redirect('/');
    }
}
