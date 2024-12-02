<?php

namespace App\Http\Controllers\Dashboard\Auth;
use App\Models\Admin;
use Illuminate\Http\Request;
use Ichtrojan\Otp\Otp;
use App\Http\Controllers\Controller;
use App\Notifications\SendOtpNotify;


class ForgetPasswordController extends Controller
{
    protected $otp2;

    public function __construct()
    {

        $this->otp2  = new Otp;
    }
    public function showEmailForm()
    {
        return view('dashboard.auth.password.email');
    }

    public function sendOtp(Request $request)
{
    // Validation for the email field
    $request->validate([
        'email' => ['required', 'email'],
    ]);

    // Fetch the admin record based on the email
    $admin = Admin::where('email', $request->email)->first();

    // If the admin is not found, return with an error
    if (!$admin) {

        return redirect()->back()->withErrors(['email' => __('validation.email_not_registered')]);
    }

    // Notify the admin with an OTP
    $admin->notify(new SendOtpNotify());

    // Redirect to the verify OTP route with the admin's email
    return redirect()->route('dashboard.password.verify', ['email' => $admin->email]);
}

public function showOtpForm($email)
    {
        return view('dashboard.auth.password.verify' , ['email'=>$email]);
    }

    public function verifyOtp(Request $request)
    {
        $request->validate([
            'email' => ['required', 'email'],
            'code' => ['required', 'min:5'],
        ]);

        $otp = $this->otp2->validate($request->email, $request->code);

        if ($otp->status === false) {
            return redirect()->back()->withErrors(['error' => __('auth.code_invalid')]);
        }

        return redirect()->route('dashboard.password.reset', ['email' => $request->email]);
    }

}
