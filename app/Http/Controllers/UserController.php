<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
  public function __construct()
  {
    $this->middleware('auth');
    $this->middleware('role:superadmin');
  }



  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index()
  {
    $users = User::where('id', '!=', auth()->id())->get();
    return view('user.allusers', compact('users'));
  }

  // public function show($readerid)
  // {
  //   $reader = \App\Reader::findOrFail($readerid);
  //   return view('reader.show', compact('reader'));
  // }



  /**
   * Show the form for creating a new resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function create()
  {
    return view('user.create');
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
      'name' => 'required|min:3|max:50',
      'username' => 'required|min:3|max:50|unique:users',
      'password' => 'required|confirmed|min:6',
    ]);
    $user = new User();
    $user->name = $request->name;
    $user->username = $request->username;
    $user->password = Hash::make($request->password);
    $user->role = $request->role;
    $user->save();
    return back()->with('status', 'تم تسجيل المدير');
  }


  /**
   * Show the form for editing the specified resource.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function edit(User $user)
  {
    return view('user.edit', compact('user'));
  }


  /**
   * Remove the specified resource from storage.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function destroy(User $user)
  {
    $user->delete();
    return back()->with('status', 'تم حذف العضو');
  }

  /**
   * Update the specified resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function update(Request $request, User $user)
  {

    $this->validate($request, [
      'name' => 'required|min:3|max:50',
      'username' => 'nullable|min:3|max:50|unique:users',
      'password' => 'nullable|confirmed|min:6',
    ]);
    $user->name = $request->name;
    if ($request->username != "")
      $user->username = $request->username;
    if ($request->password != "")
      $user->password = Hash::make($request->password);
    $user->name = $request->name;
    $user->role = $request->role;
    $user->update();
    return redirect()->route('users.index', $user)->with('status', 'تم تعديل البيانات بنجاح');
  }


  public function deletedusers()
  {
    $users = User::onlyTrashed()->get();
    return view('user.showdeleted', compact('users'));
  }

  public function restoredeleted($user)
  {
    User::onlyTrashed()->findOrFail($user)->restore();
    return redirect()->back()->with('status', 'تم استرجاع المدير');
  }
}
