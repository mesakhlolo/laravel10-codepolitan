<?php

namespace App\Http\Controllers;

use GuzzleHttp\RedirectMiddleware;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class AuthController extends Controller
{
    public function login()
    {
        return view('auth.login');
    }

    public function authenticate(Request $request)
    {
        $credentials = $request->only('email', 'password');
        if (Auth::attempt($credentials)) {
            return redirect('posts');
        } else {
            return redirect('login')->with('error_message', 'Salah masukkin email ato password lu bre!');
        }
    }
}
