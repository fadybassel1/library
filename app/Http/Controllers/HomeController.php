<?php

namespace App\Http\Controllers;

use App\Reader;
use App\Visit;
use Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        // Session::flash('status','hiiii');
        $daysCount = Visit::select(DB::raw('COUNT(*)'), 'day')->Where('day', '>', DB::raw("Date(NOW()) - INTERVAL 5 DAY"))->groupby('day')->get();
        $todayUsers = Reader::select('name')->join('visits', 'readers.id', '=', 'visits.reader_id')->where('visits.day', date('Y-m-d'))->get();

        return view('home', compact('daysCount', 'todayUsers'));
    }
}
