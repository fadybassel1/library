<?php

namespace App\Http\Controllers\Reader;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{

    protected $redirectTo = '/reader/login';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('reader.auth:reader');
    }

    /**
     * Show the Reader dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $keywords = DB::table('search_keywords')->where('reader_id', Auth::guard('reader')->user()->id)->orderBy('created_at', 'desc')->take(5)->get();
        return view('reader.home', compact('keywords'));
    }
}
