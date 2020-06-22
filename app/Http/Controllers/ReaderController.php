<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Reader;
use App\Visit;
use App\Photo;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\Auth;
use Johntaa\Arabic\Arabic\I18N_Arabic_Soundex;
use Illuminate\Support\Facades\Storage;

class ReaderController extends Controller
{
  public function __construct()
  {
    $this->middleware('auth');
    $this->middleware('role:admin')->only('edit','destroy','update');
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
   * Remove the specified resource from storage.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function destroy(Reader $reader)
  {
    $reader->delete();
    return back()->with('status', 'تم حذف العضو');
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


    $reader->update($request->all());




    return redirect()->route('readers.show', $reader)->with('status', 'تم تعديل البيانات بنجاح');
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

  public function storeimage(Request $request)
  {

    $request->validate([
      'formno' => 'required | numeric | digits_between:1,8',
      'filee' => 'mimes:jpg,jpeg,png|max:4000'
    ]);

    if ($request->file('filee') && $request->image != null) {

      return redirect()->back()->with('error', 'لا يمكن تحميل صورتين');
    }


    if (!$request->file('filee') && $request->image == null) {

      return redirect()->back()->with('error', 'من فضلك اختر صورة');
    }


    try {

      $reader = Reader::where('formno', $request->formno)->firstOrFail();
      $id = $reader->id;
    } catch (ModelNotFoundException $e) {
      return redirect()->back()->with('error', ' رقم الاستمارة غير صحيح');
    }
    $img = $request['image'];

    if ($img != null) {

      if (strpos($img, "data:image/jpeg;base64,") === false) {

        return redirect()->back()->with('error', 'الملف لم يكن صورة');
      }

      $image_parts = explode(";base64,", $img);
      $image_type_aux = explode("image/", $image_parts[0]);
      $img = imagecreatefromstring(base64_decode($image_parts[1]));
      if (!$img) {
        return redirect()->back()->with('error', 'الملف لم يكن صورة');
      }


      if ($reader->photo) {
        $photo = $reader->photo;
        // remove the old image
        unlink('member photos/' . $photo->filename);
        imagejpeg($img, "member photos/$id.jpeg");
        $photo->filename = $id . '.jpeg';
        $photo->save();
      } else {
        imagejpeg($img, "member photos/$id.jpeg");
        Photo::create([
          'filename' => $id . '.jpeg',
          'photoable_id' => $reader->id,
          'photoable_type' => "App\Reader"
        ]);
      }
    } else {
      $file = $request->file('filee');
      $filextention = $file->getClientOriginalExtension();
      $filename = $reader->id . '.' . $filextention;

      if ($reader->photo) {
        $photo = $reader->photo;
        // remove old image.....
        unlink('member photos/' . $photo->filename);
        $file->move('member photos', $filename);

        // update photo file name
        $photo->filename = $filename;
        $photo->save();
      } else {
        $file->move('member photos', $filename);
        Photo::create([
          'filename' => $filename,
          'photoable_id' => $reader->id,
          'photoable_type' => "App\Reader"
        ]);
      }
    }
    return redirect()->back()->with('status', $reader->id);
  }

  public function printcard($reader)
  {
    $reader = Reader::where('id', $reader)->with('photo')->first();
    $photo = $reader->photo->filename;
    return view('reader.printcard', compact('reader', 'photo'));
  }
}
