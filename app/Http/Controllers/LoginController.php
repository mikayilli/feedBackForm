<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function index()
    {
        return view("login");
    }

    public function login()
    {
        $credentials = request()->validate([
            'username' => ['required'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($credentials)) {
            request()->session()->regenerate();

            return redirect()->intended('/');
        }

        return back()->with("TRY again");
    }

    public function logout()
    {
        Auth::logout();
        return redirect('/');
    }
}
