<?php

namespace App\Http\Controllers\Reader\Auth;

use App\Http\Controllers\Controller;
use App\Reader;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/reader';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }


    public function login(Request $request)
    {
        $request->validate([
            'name' => "required|string",
            'id' => 'required|size:8',
        ]);
        $user = Reader::where('id', $request->id)->first(); // Something like User:: where() or whatever depending on your impl.
        if (!$user)
            return redirect()->back()->with('status', 'الاسم او الرقم غير صحيح');

        $user = $request->name == strtok($user->name,  ' ') ? $user : NULL;
        if ($user) {
            Log::info('READER: ' . $user->name . ' Enter At ' . date("Y-m-d H:i:s"));
            Session::put('lastLogin', $user->last_login);
            $user->last_login = date('Y-m-d');
            $user->save();
            Auth::guard('reader')->login($user);
            $request->session()->regenerate();
            return redirect()->intended('/reader');
        }
        return redirect()->back()->with('status', 'الاسم او الرقم غير صحيح');
    }
    /**
     * Get the guard to be used during authentication.
     *
     * @return \Illuminate\Contracts\Auth\StatefulGuard
     */
    protected function guard()
    {
        return Auth::guard('reader');
    }

    /**
     * Show the application's login form.
     *
     * @return \Illuminate\Http\Response
     */
    public function showLoginForm()
    {
        return view('reader.auth.login');
    }

    /**
     * Log the user out of the application.
     *
     * @param \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function logout(Request $request)
    {
        Log::info('READER: ' . $this->guard()->user()->name . ' Exit At ' . date("Y-m-d H:i:s"));
        $this->guard()->logout();

        $request->session()->invalidate();

        return $this->loggedOut($request) ?: redirect()->route('reader.dashboard');
    }
}
