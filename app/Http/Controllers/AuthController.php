<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use Carbon\Carbon;
use Hash;
use Auth;
use Exception;
class AuthController extends Controller
{
    public function login(){
        return view('auth.index');
    }

  public function register(){
  
    return view('auth.register');
  }


 public function register_refreal($id){
      if($id !=''){
          $id = $id;
      }else{
          $id = '';
      }
    return view('auth.register',compact('id'));
  }
  

public function send_otp(Request $request)
{
    try {
        $request->validate([
            'email' => 'required|email|'
        ]);

        $otp = rand(100000, 999999);

        // Store OTP & expiry
        session([
            'email_otp' => $otp,
            'email_otp_expires' => now()->addMinutes(10),
            'email' => $request->email
        ]);

        // Send OTP email
        Mail::raw(
    "Welcome To GM Selection Hub \n Your One time Password is: $otp\n valid for 10 minutes Email Verification.\n For security reasons, please do not share this OTP with anyone.
Thank You,\n
Team GM Selection Hub",
    function ($message) use ($request) {
        $message->to($request->email)
                ->from(config('mail.from.address'), config('mail.from.name'))
                ->subject('Email Confirmation OTP');
    }
);


        return response()->json([
            'status' => true,
            'message' => 'OTP sent successfully to your email'
        ]);

    } catch (ValidationException $e) {
        return response()->json([
            'status' => false,
            'message' => $e->getMessage(),
            'errors' => $e->errors()
        ], 422);

    } catch (Exception $e) {
    return response()->json([
        'status' => false,
        'message' => $e->getMessage(),
        'line' => $e->getLine(),
        'file' => $e->getFile()
    ], 500);
}

}
public function verify_otp(Request $request)
{
    try {
        $request->validate([
            'otp'   => 'required|digits:6'
        ]);

        // Check email match
        if ($request->email !== session('email')) {
            return response()->json([
                'status' => false,
                'message' => 'Email does not match OTP request'
            ], 400);
        }

        // Check OTP exists
        if (!session()->has('email_otp')) {
            return response()->json([
                'status' => false,
                'message' => 'OTP not found or already used'
            ], 400);
        }

        // Check OTP expiry
        if (now()->greaterThan(session('email_otp_expires'))) {
            session()->forget(['email_otp', 'email_otp_expires', 'email']);

            return response()->json([
                'status' => false,
                'message' => 'OTP has expired'
            ], 400);
        }

        // Check OTP match
        if ($request->otp != session('email_otp')) {
            return response()->json([
                'status' => false,
                'message' => 'Invalid OTP'
            ], 400);
        }

        // OTP verified — clear session
        session()->forget(['email_otp', 'email_otp_expires', 'email']);

        return response()->json([
            'status' => true,
            'message' => 'OTP verified successfully'
        ]);

    } catch (ValidationException $e) {
        return response()->json([
            'status' => false,
            'message' => $e->getMessage(),
            'errors' => $e->errors()
        ], 422);

    } catch (Exception $e) {
        return response()->json([
            'status' => false,
            'message' => 'OTP verification failed'
        ], 500);
    }
}


  public function store(Request $request)
    {

        //dd($request->all());
        $refferalCode = User::where('referral_code',$request->refferal)->first();

//dd($refferalCode);
       
        // Validation
        $validator = Validator::make($request->all(), [
            'name'          => 'required|string|max:255',
            'email'         => 'required|string|email|max:255|unique:users',
            'password'      => 'required|string|min:6|confirmed',
            'phone'      => 'required|unique:users',
            'referral_code' => 'nullable|string|max:255',
            'coupon'        => 'nullable|string|max:255',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        // User create
        $user = User::create([
            'name'          => $request->name,
            'email'         => $request->email,
            'coins'         => 100,
            'referral_code' => $this->generateReferralCode(),
            'phone'=>$request->phone,
            'coupon'        => '',
            'password'      => Hash::make($request->password),
        ]);

        if($refferalCode !=''){
            $coins = $refferalCode->coins + 100;
            User::where('id',$refferalCode->id)->update(array('coins'=>$coins));
            DB::table('refferal')->insert(array('user_id'=>$refferalCode->id,'refferal_userid'=>$user->id));
        }

        // Auto login
        auth()->login($user);
        return redirect()->route('login')->with('success', 'Registration successful!');
    }

    public function emailConfirm(){
        return view('auth.emailconfirm');
    }


    public function emailverify(Request $request){

        $request->validate([
            'email' => 'required|email',
            'otp'   => 'required|digits:6',
        ]);

        $record = DB::table('users')
            ->where('email', $request->email)
            ->where('otp', $request->otp)
            ->where('expires_at', '>', now())
            ->first();

        if (!$record) {
            return back()->withErrors(['otp' => 'Invalid or expired OTP']);
        }else{
            User::where('email', $request->email)->update([
                'email_verify' => 1,
            ]);
        return redirect('/')->with('success','Welcome Student!');

        }
    }

    public function userlogin(Request $request)
    {

        //dd($request->all());
        // Validation
        $credentials = $request->validate([
            'email'    => 'required|email',
            'password' => 'required|string|min:6',
        ]);

        // Attempt login
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($request->only('email','password'))) {
            $user = Auth::user();
            //dd($user->type);
            //  Condition lagayi type ke hisaab se
            if ($user->type === 'student') {
               // dd('test');

if($user->email_verify == 1){
    return redirect('/')->with('success','Welcome Student!');
}else{
   
   $request->validate(['email' => 'required|email|exists:users,email']);
        $otp = rand(100000, 999999);
        DB::table('users')->updateOrInsert(
            ['email' => $request->email],
            [
                'otp'        => $otp,
                'created_at' => now(),
                'expires_at' => Carbon::now()->addMinutes(10), // OTP valid 10 min
            ]
        );

        // Send OTP via mail
        Mail::raw("Your email confirm OTP is: $otp (valid for 10 minutes)", function ($message) use ($request) {
            $message->to($request->email)
                    ->subject('Email Confirm OTP');
        });
   
   session(['email' => $request->email]);
        return redirect()->route('email.otp.form')->with('success','Please Enter your OTP Send in you Email');
   
   
}

                
            } else {
               // dd('test 1');
               
                return redirect()->route('admin.dashboard')->with('success','Welcome Admin!');
            }
        }
       
        return back()->with('error', 'Invalid credentials!');

    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/login')->with('success', 'You have been logged out.');
    }


    public function forgot(Request $request)
    {
       
       return view('auth.forgot');
    }

    function generateReferralCode()
{
    $prefix = "GML";
    $characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
    $randomString = '';
    for ($i = 0; $i < 8; $i++) {
        $randomString .= $characters[rand(0, strlen($characters) - 1)];
    }
    return $prefix . $randomString;
}

}
