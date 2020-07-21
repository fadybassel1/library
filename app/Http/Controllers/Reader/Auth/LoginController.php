<?php

namespace App\Http\Controllers\Reader\Auth;

use App\Http\Controllers\Controller;
use App\Reader;
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

    public function __construct()
    {
        $this->middleware('guest');
    }


    public function login(Request $request)
    {
        $request->validate([
            'name' => "required|string",
            'id' => 'required|size:8',
        ]);

        if(Auth::guard('reader')->attempt(['name'=>$request->name,'password'=>$request->id],$request->remember)){
            $user = Reader::where('id', $request->id)->first();
             Log::info('READER: ' . $user->name . ' Enter At ' . date("Y-m-d H:i:s"));
             Session::put('lastLogin', $user->last_login);
             $user->last_login = date('Y-m-d');
             $user->save();
            return redirect()->intended(route('reader.dashboard'));
        }
        return redirect()->back()->with('status','الاسم او الرقم غير صحيح');



        // $user = Reader::where('id', $request->id)->first(); // Something like User:: where() or whatever depending on your impl.
        // if (!$user)
        //     return redirect()->back()->with('status', 'الاسم او الرقم غير صحيح');

        // $user = $request->name == strtok($user->name,  ' ') ? $user : NULL;
        // if ($user) {
        //     Log::info('READER: ' . $user->name . ' Enter At ' . date("Y-m-d H:i:s"));
        //     Session::put('lastLogin', $user->last_login);
        //     $user->last_login = date('Y-m-d');
        //     $user->save();
        //     Auth::guard('reader')->login($user);
        //     $request->session()->regenerate();
        //     return redirect()->intended('/reader');
        // }
        // return redirect()->back()->with('status', 'الاسم او الرقم غير صحيح');
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


}
