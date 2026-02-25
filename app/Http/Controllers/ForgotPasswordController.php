<?php


namespace App\Http\Controllers; 

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use Carbon\Carbon;
use App\Models\User;
use Hash;


class ForgotPasswordController extends Controller
{

    public function sendOtp(Request $request)
    {
        $request->validate(['email' => 'required|email|exists:users,email']);

        $otp = rand(100000, 999999);

        DB::table('password_resets')->updateOrInsert(
            ['email' => $request->email],
            [
                'otp'        => $otp,
                'created_at' => now(),
                'expires_at' => Carbon::now()->addMinutes(10), // OTP valid 10 min
            ]
        );

        // Send OTP via mail
        Mail::raw("Your password reset OTP is: $otp (valid for 10 minutes)", function ($message) use ($request) {
            $message->to($request->email)
                    ->subject('Password Reset OTP');
        });
        session(['email' => $request->email]);
        return redirect()->route('password.otp.form');
    }

    public function showOtpForm(Request $request)
    {
        
        return view('auth.verify');
    }

    public function verifyOtp(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'otp'   => 'required|digits:6',
        ]);

        $record = DB::table('password_resets')
            ->where('email', $request->email)
            ->where('otp', $request->otp)
            ->where('expires_at', '>', now())
            ->first();

        if (!$record) {
            return back()->withErrors(['otp' => 'Invalid or expired OTP']);
        }else{
           
            return redirect()->route('password.reset.form');
        }

        
    }

    public function showResetForm()
    {
        return view('auth.reset-password');
    }

    public function resetPassword(Request $request)
    {

        //dd($request->all());
        $request->validate([
            'email'                 => 'required|email|exists:users,email',
            'password'              => 'required|string|min:6',
        ]);

        User::where('email', $request->email)->update([
            'password' => Hash::make($request->password),
        ]);

        DB::table('password_resets')->where('email', $request->email)->delete();

        return redirect()->route('login')->with('success', 'Password reset successful!');
    }
}
