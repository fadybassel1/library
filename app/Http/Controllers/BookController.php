<?php

namespace App\Http\Controllers;

use App\Book;
use Illuminate\Http\Request;

class BookController extends Controller
{

  public function __construct()
  {
    $this->middleware('auth');
  }

  /* Display a listing of the resource.
  *
  * @return \Illuminate\Http\Response
  */
  public function index()
  {
    return view('book.allbooks');
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
    return view('book.create');
  }

  /**
   * Store a newly created resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @return \Illuminate\Http\Response
   */
  public function store(Request $request)
  {
    Book::create($request->all());
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
    return view('book.edit', compact('book'));
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
    $book->update($request->all());
    return redirect()->route('books.show', $book)->with('status', 'تم تعديل بيانات الكتاب بنجاح');
  }

  public function bookSearch(Request $request)
  {
    $searching = $request['qq'];

    if ($request['search'] == "position")
      $searching = 'ر' . $request['qq'] . '-';

    $books = Book::Where($request['search'], 'like', '%' . $searching . '%')->Paginate(10);
    return view('book.allbooks', ['books' => $books]);
  }
}
