<?php

namespace App\Http\Controllers;

use App\Book;
use App\Tag;
use App\Report;
use App\Events\UserReadBook;
use App\User;
use Illuminate\Support\Facades\Gate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

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
    $users = User::select('id','name')->where('role','!=','superadmin')->withTrashed()->get();
    return view('book.allbooks', compact('tags','users'));
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
    $request->merge(["book_creator" => auth()->user()->id]);
    $book = Book::create($request->except(['tags']));
    $book->tags()->attach($request->tags);
    return Redirect::route('books.show',$book->id)->with('status', 'تم اضافة الكتاب');
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
   
          $request->merge(["book_last_updated_by" => auth()->user()->id]);
          $book->update($request->except(['tags']));
          $book->tags()->sync($request->tags);
          return redirect()->route('books.show', $book)->with('status', 'تم تعديل بيانات الكتاب بنجاح');
    
    }
    else return redirect()->back()->with('status','هذا الأمر غير مصرح لك');
  }

  public function bookSearch(Request $request)
  {
    $users = User::select('id','name')->where('role','!=','superadmin')->withTrashed()->get();

    $tags = Tag::all();
    $query = Book::query();
    if ($request['search'] == 'tags') {
      $books = $query->whereHas('tags', function ($q) use ($request) {
        $q->whereIn('tag_id', $request->tags);
      });
    }
    $searching = $request['qq'] ?? "";
    $searching = str_replace(['ي', 'أ', 'إ', 'ة', 'ه', 'ؤ', 'ئ', 'ء'], ['ى', 'ا', 'ا', 'ه', 'ه', 'و', 'ي', 'ا'], $searching);
    $column = $request['search'] ?? "book_name";
    $query->where(\DB::raw("REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(".$column.", 'ي', 'ى'), 'أ', 'ا'), 'إ', 'ا'), 'ة', 'ه'), 'ه', 'ه'), 'ؤ', 'و'), 'ئ', 'ي'), 'ء', 'ا')"), 'LIKE', '%' . $searching . '%');
    
    if($request->input("edited_to"))
    $query->whereDate('updated_at', '<=', $request->input("edited_to"));
    
    if($request->input("edited_from"))
    $query->whereDate('updated_at', '>=', $request->input("edited_from"));
    
    if($request->input("created_to"))
    $query->whereDate('created_at', '<=', $request->input("created_to"));
    
    if($request->input("created_from"))
    $query->whereDate('created_at', '>=', $request->input("created_from"));
    
    if($request->input("created_by"))
    $query->where('book_creator', '=', $request->input("created_by"));
    
    if($request->input("last_edited_by"))
    $query->where('book_last_updated_by', '=', $request->input("last_edited_by"));
    
    $filter = false;
    $sortBy = $request->input("sort_by") ?? "id";
    
    if(count($query->getQuery()->wheres) > 1 || $sortBy != "id") $filter = true;

    $sortOrder = $request->input("sortDecending") == "on" ? "desc":"asc";
    
    // null values last
    $query->orderByRaw('ISNULL('.$sortBy.'), '.$sortBy.' '.$sortOrder);
    
    
    if($filter){
      $query->with('creator:id,name')->with('lastUpdater:id,name');
    }
    
    $books = $query->Paginate(10);
    
    return view('book.allbooks', compact('books', 'tags','users','filter'));
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
    $users = User::select('id','name')->where('role','!=','superadmin')->withTrashed()->get();

    $tag = Tag::findOrFail($tagid);
    $tags=Tag::all();
    return view('book.allbooks', ['books' => $tag->books()->paginate(10), 'tagname' => $tag->name , 'tags' => $tags,'users'=>$users]);
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
