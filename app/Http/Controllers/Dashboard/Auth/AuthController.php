<?php

namespace App\Http\Controllers\Dashboard\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\CreateAdminRequest;

class AuthController extends Controller
{
    public function showLoginForm(){
        return view('dashboard.auth.login');
    }

    public function login(CreateAdminRequest $request){
        $email = $request->input('email');
        $password = $request->input('password');

        if (Auth::guard('admin')->attempt(['email' => $email, 'password' => $password])) {
            return redirect()->intended(route('dashboard.welcome')); // Login To Previous Route
        } else {
            return redirect()->back()->withErrors(['email'=> __('auth.not_match')]);
        }

    }
}