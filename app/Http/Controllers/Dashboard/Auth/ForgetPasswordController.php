<?php

namespace App\Http\Controllers\Dashboard\Auth;
use App\Models\Admin;
use Ichtrojan\Otp\Otp;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Notifications\SendOtpNotify;
use App\Services\Auth\PasswordService;
use App\Http\Requests\ForgetPasswordRequest;

class ForgetPasswordController extends Controller
{
    protected $otp2;
    protected $passwordService;
    public function __construct(PasswordService $passwordService)
    {
        $this->passwordService = $passwordService;
        $this->otp2 = new Otp();
    }
    public function showEmailForm()
    {
        return view('dashboard.auth.password.email');
    }

    public function sendOtp(ForgetPasswordRequest $request)
    {
        $admin = $this->passwordService->sendOtp($request->email);
        if (!$admin) {
            return redirect()
                ->back()
                ->withErrors(['email' => __('auth.email_not_registered')]);
        }
        return redirect()->route('dashboard.password.verify', ['email' => $admin->email]);
    }

    public function showOtpForm($email)
    {
        return view('dashboard.auth.password.verify', ['email' => $email]);
    }

    public function verifyOtp(ForgetPasswordRequest $request)
    {
        $data = $request->only('email', 'code');
        if (!$this->passwordService->verifyOtp($data)) {
            return redirect()
                ->back()
                ->withErrors(['error' => __('auth.code_invalid')]);
        }
        return redirect()->route('dashboard.password.reset', ['email' => $request->email]);
    }
}
