<?php

namespace App\Http\Controllers\Dashboard\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\CreateAdminRequest;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;

class AuthController extends Controller implements HasMiddleware
{
    public static function middleware(){
        return [
            new Middleware(middleware: 'guest:admin', except: ['logout']),
        ];
    }


    public function showLoginForm(){
        return view('dashboard.auth.login');
    }

    public function login(CreateAdminRequest $request){
        $email = $request->input('email');
        $password = $request->input('password');

        if (Auth::guard('admin')->attempt(['email' => $email, 'password' => $password], true)) {
            return redirect()->intended(route('dashboard.welcome')); // Login To Previous Route
        } else {
            return redirect()->back()->withErrors(['email'=> __('auth.not_match')]);
        }

    }
    public function logout(){
       Auth::guard('admin')->logout();
       return redirect()->route('dashboard.login');
    }
}
