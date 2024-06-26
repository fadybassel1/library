<?php

namespace App\Http\Controllers;

use App\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Gate;

class TagController extends Controller
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
        $tags = Tag::all();
        return view('tag.alltags', compact('tags'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('tag.create');
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
            'name' => 'required | min:3',
        ]);
        $tag = new Tag();
        $tag->name = $request->name;
        $tag->save();
        return redirect(route('tags.index'))->with('status', 'تم اضافة التاج');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Customer  $tag
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Customer  $tag
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (Gate::allows('edit-delete-tag')) {
        $tag = Tag::find($id);
        return view('tag.edit', compact('tag'));
        } else return redirect()->back()->with('status','هذا الأمر غير مصرح لك');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Customer  $tag
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        if (Gate::allows('edit-delete-tag')) {
        $this->validate($request, [
            'name' => 'required | min:3',
        ]);
        $tag = Tag::find($id);
        $tag->name = $request->name;
        $tag->save();
        return redirect(route('tags.index'))->with('status', 'تم تعديل التاج');;
    } else return redirect()->back()->with('status','هذا الأمر غير مصرح لك');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Customer  $tag
     * @return \Illuminate\Http\Response
     */
    public function destroy(Tag $tag)
    {
        if (Gate::allows('edit-delete-tag')) {
        $tag->delete();
        return back()->with('status', 'تم مسح التاج');
    } else return redirect()->back()->with('status','هذا الأمر غير مصرح لك');
    }
    
}
