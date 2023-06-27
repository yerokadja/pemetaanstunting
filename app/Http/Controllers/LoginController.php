<?php

namespace App\Http\Controllers;

use illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    public function index()
    {
        if (auth()->check()) {
            return redirect()->route('dashboard.index');
        }

        return view('auth.login');
    }

    public function authenticate(Request $request)
    {

        $credentials = $request->validate(
            [
                'username'     => 'required',
                'password'     => 'required'
            ],

            [
                'username.required' => 'Username tidak boleh kosong',
                'password.required' => 'Password tidak boleh kosong',
            ]
        );

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            return redirect('/dashboard');
        }
        return redirect()->back()->withInput()->with('error', 'Periksa kembali username atau password anda');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        return redirect('/');
    }
}
