<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ReaderController extends Controller
{
  public function __construct()
    {
        $this->middleware('auth');
}

public function showall(){

$readers=\App\Reader::all();
return view('reader.showreaders',compact('readers'));
}

public function show($readerid){

$reader=\App\Reader::findOrFail($readerid);
return view('reader.show',compact('reader'));}

public function create(){
  return view('reader.create');
}
}
