<?php

namespace App\Http\Controllers;

use App\Book;
use App\Tag;
use App\Report;
use App\Events\UserReadBook;
use Illuminate\Support\Facades\Gate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


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
    $tags = Tag::all();
    return view('book.allbooks', compact('tags'));
  }



  public function show($bookid)
  {
   
    $book = Book::findOrFail($bookid);
    event(new UserReadBook($book));
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
    
    if (Gate::allows('edit-delete-book')) {
   
      $tags = Tag::all();
      return view('book.edit', compact('book', 'tags'));
    }
    else return redirect()->back()->with('status','هذا الأمر غير مصرح لك');
  }


  /**
   * Remove the specified resource from storage.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function destroy(Book $book)
  {
    if (Gate::allows('edit-delete-book')) {
   
      $book->delete();
    return redirect()->route('books.index')->with('status', 'تم حذف الكتاب');
    }
    else return redirect()->back()->with('status','هذا الأمر غير مصرح لك');

    
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
    if (Gate::allows('edit-delete-book')) {
   
      
          $book->update($request->except(['tags']));
          $book->tags()->sync($request->tags);
          return redirect()->route('books.show', $book)->with('status', 'تم تعديل بيانات الكتاب بنجاح');
    
    }
    else return redirect()->back()->with('status','هذا الأمر غير مصرح لك');
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
    return view('book.allbooks', compact('books', 'tags'));
  }

  public function deletedbooks()
  {
    if (Gate::allows('view-restore-recycle')) {
   
      $books = Book::onlyTrashed()->get();
      return view('book.showdeleted', compact('books'));
         
    }
    else return redirect()->back()->with('status','هذا الأمر غير مصرح لك');
  }

  public function restoredeleted($book)
  {
    if (Gate::allows('view-restore-recycle')) {
    Book::onlyTrashed()->findOrFail($book)->restore();
    return redirect()->back()->with('status', 'تم استرجاع الكتاب');
    } else return redirect()->back()->with('status','هذا الأمر غير مصرح لك');
  }

  public function bookTagSearch($tagid)
  {
    $tag = Tag::findOrFail($tagid);
    $tags=Tag::all();
    return view('book.allbooks', ['books' => $tag->books()->paginate(10), 'tagname' => $tag->name , 'tags' => $tags]);
  }

  public function report(Request $request)
  {
    $request->validate([
      'about' => 'in:بيانات الكتاب,صورة الكتاب',
      'details' => 'required | max:70',

    ]);
    $report = new Report();
    $report->target = "books";
    $report->targetid = $request->bookid;
    $report->about = $request->about;
    $report->details = $request->details;
    $report->save();
    return redirect()->back()->with('status', 'تم ارسال المشكلة');
  }

  public function showreports(){
    

    if (Gate::allows('view-delete-report')) {
   
      
      $reports =Report::all();
      return view('reports',compact('reports'));
         
    
    }
    else return redirect()->back()->with('status','هذا الأمر غير مصرح لك');
  }

  public function deletereport($id)
  {
    if (Gate::allows('view-delete-report')) {
   
      
      $report = Report::findOrFail($id);
      $report->delete();
      return back()->with('status', 'تم حذف الشكوى');
         
    
    }
    else return redirect()->back()->with('status','هذا الأمر غير مصرح لك');

  }
}
