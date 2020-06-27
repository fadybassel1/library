<?php

namespace App\Http\Controllers\Reader;

use App\Http\Controllers\Controller;

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
        return view('reader.home');
    }
}
