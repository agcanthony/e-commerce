<?php
// app/Http/Controllers/AuthController.php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class AuthController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->only('username', 'password');
        
        if ($credentials['username'] === 'admin' && $credentials['password'] === '123456') {
            Session::put('authenticated', true); 
            return redirect()->intended('/');
        }
        
        return redirect()->back()->withErrors(['message' => 'Credenciais inválidas']);
    }

    public function logout()
    {
        Session::forget('authenticated');
        return redirect('/login');
    }
}
