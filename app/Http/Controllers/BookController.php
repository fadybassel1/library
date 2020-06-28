<?php

namespace App\Http\Controllers;

use App\Book;
use App\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BookController extends Controller
{

  public function __construct()
  {
    $this->middleware('auth');
    $this->middleware('role:admin')->only('edit', 'destroy', 'update', 'deletedbooks', 'restoredeleted');
  }

  /* Display a listing of the resource.
  *
  * @return \Illuminate\Http\Response
  */
  public function index()
  {
    $tags = Tag::all();
    return view('book.allbooks', compact('tags'));
  }



  public function show($bookid)
  {
    $book = Book::findOrFail($bookid);
    return view('book.show', compact('book'));
  }

  /**
   * Show the form for creating a new resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function create()
  {
    $tags = Tag::all();
    return view('book.create', compact('tags'));
  }

  /**
   * Store a newly created resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @return \Illuminate\Http\Response
   */
  public function store(Request $request)
  {
    $book = Book::create($request->except(['tags']));
    $book->tags()->attach($request->tags);
    return back()->with('created', 'تم اضافة الكتاب');
  }


  /**
   * Show the form for editing the specified resource.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function edit(Book $book)
  {
    $tags = Tag::all();
    return view('book.edit', compact('book', 'tags'));
  }


  /**
   * Remove the specified resource from storage.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function destroy(Book $book)
  {
    $book->delete();
    return redirect()->route('books.index')->with('status', 'تم حذف الكتاب');
  }

  /**
   * Update the specified resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function update(Request $request, Book $book)
  {
    // dd($request);
    $book->update($request->except(['tags']));
    $book->tags()->sync($request->tags);
    return redirect()->route('books.show', $book)->with('status', 'تم تعديل بيانات الكتاب بنجاح');
  }

  public function bookSearch(Request $request)
  {
    
    $tags = Tag::all();
    if ($request['search'] == 'tags') {
      $books = Book::whereHas('tags', function ($query) use ($request) {
        $query->whereIn('tag_id', $request->tags);
      })->Paginate(10);
      return view('book.allbooks', compact('books', 'tags'));
    }
    $searching = $request['qq'];
    if ($request['search'] == "book_position")
      $searching = 'ر' . $request['qq'] . '-';

    $books = Book::Where($request['search'], 'like', '%' . $searching . '%')->Paginate(10);
    return view('book.allbooks', compact('books','tags'));
  }

  public function deletedbooks()
  {
    $books = Book::onlyTrashed()->get();
    return view('book.showdeleted', compact('books'));
  }

  public function restoredeleted($book)
  {
    Book::onlyTrashed()->findOrFail($book)->restore();
    return redirect()->back()->with('status', 'تم استرجاع الكتاب');
  }

  public function bookTagSearch($tagid)
  {
    $tag = Tag::findOrFail($tagid);
    return view('book.allbooks', ['books' => $tag->books()->paginate(10), 'tagname' => $tag->name]);
  }
}
