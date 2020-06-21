<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Reader;
use App\Visit;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\Auth;
use Johntaa\Arabic\Arabic\I18N_Arabic_Soundex;

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
    $readers = \App\Reader::all();
    return view('reader.showreaders', compact('readers'));
  }



  public function show($readerid)
  {
    $reader = \App\Reader::findOrFail($readerid);
    return view('reader.show', compact('reader'));
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
    $this->validate($request, [
      'formno' => 'required | unique:readers,formno',
    ]);
    $arabic = new I18N_Arabic_Soundex('ArSoundex');
    $reader = new Reader();
    $reader->name = $request['name'];
    $reader->phone = $request['phone'];
    $reader->email = $request["email"];
    $reader->bdate = $request["bdate"];
    $reader->streetname = $request["streetname"];
    $reader->region = $request["region"];
    $reader->city = $request["city"];
    $reader->appno = $request["appno"] == NULL ? 0 : $_POST["appno"];
    $reader->buildingno = $request["buildingno"] == NULL ? 0 : $_POST['buildingno'];
    $reader->floorno = $request["floorno"] == NULL ? 0 : $_POST["floorno"];
    $reader->country = $request["country"];
    $reader->church = $request["church"];
    $reader->churchlocation = $request["churchlocation"];
    $reader->churchcity = $request["churchcity"];
    $reader->churchcountry = $request["churchcountry"];
    $reader->type = $request["type"];
    $reader->yearofstudy = $request["yearofstudy"] == NULL ? 0 : $_POST["yearofstudy"];
    $reader->schoolname = $request['schoolname'];
    $reader->degree = $request['degree'];
    $reader->job = $request['job'];
    $reader->company = $request['company'];
    $reader->service = $request['service'];
    $reader->servicename = $request['servicename'];
    $reader->servicechurch = $request['servicechurch'];
    $reader->entrydate = $request['entrydate'];
    $reader->formno = $request['formno'];
    $reader->category = $request['category'];
    $reader->whocreated = Auth::user()->name;
    $reader->active = 1;
    $reader->soundlike = @$arabic->soundex($request['name']);

    $reader->save();
    return back()->with('created', 'تم تسجيل العضو');
  }


  /**
   * Show the form for editing the specified resource.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function edit(Reader $reader)
  {
    return view('reader.edit', compact('reader'));
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


  public function attend(Request $request)
  {

    $request->validate([
      'id' => "numeric",
    ]);


    try {
      $reader = \App\Reader::findOrFail($request->id);
      Visit::create(['reader_id' => $reader->id, 'day' => date("Y-m-d"), 'time' => date('Y-m-d H:i:s')]);
      return view('reader.attendance', compact('reader'));
    } catch (ModelNotFoundException $e) {
      return redirect('attendance')->with('error', 'لا يوجد عضو بهذا الرقم');
    }
  }
}
