<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Reader;


class ReaderController extends Controller
{
  public function __construct()
    {
        $this->middleware('auth');
}



/**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      $readers=\App\Reader::all();
      return view('reader.showreaders',compact('readers'));
      
    }



public function show($readerid){

  $reader=\App\Reader::findOrFail($readerid);
  return view('reader.show',compact('reader'));

}



    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
      return view('reader.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

    
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Reader $reader)
    {
      return view('reader.edit',compact('reader'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Reader $reader)
    {
       
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Reader $reader)
    {
        
    }












}
