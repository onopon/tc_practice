<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use \App\Models\User;
use \App\Libraries\Api\Forecast;

class UserController extends Controller
{
    protected $forecastApi;

    public function __construct(Forecast $forecastApi)
    {
        $this->forecastApi = $forecastApi;
    }

    public function login()
    {
        return view('user/login');
    }

    public function mypage()
    {
        $user = Auth::user();
        $forecast = $this->forecastApi->loadOverviewText();
        return view('user/index', compact('user', 'forecast'));
    }
}
