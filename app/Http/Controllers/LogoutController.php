<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LogoutController extends Controller
{
    public function attempt(Request $request)
    {
        Auth::logout();
        return redirect('/');
    }
}
