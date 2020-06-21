@extends('layouts.app')

@section('content')





<form action="/bookSearch" method="get">
    @csrf

    <div style="" class="card align-items-center">
        <div class="card-body">
            <div class="row">
                <div class="col-10">
                    <input class="form-control" name="qq" autocomplete="on" type="text" placeholder="Search"
                        aria-label="Search">
                </div>
                <div class="col">

                    <input class="btn btn-elegant" style="color: white" type="submit" id="searchbtn" value="بحث" />

                </div>
            </div>
            <div class="row">
                <div class="col">
                    <select style="background-color: #363936; color:white" name="search" class="form-control">
                        <option value="book_name">كتاب</option>
                        <option value="book_description">وصف</option>
                        <option value="book_author">مؤلف</option>
                        <option value="book_position">رف</option>
                        <option value="all">الجميع</option>
                        <option disabled>──────────</option>
                        <option disabled value="genre">تصنيف</option>
                        <option value="">— كتاب</option>
                        <option>— مجلة</option>
                        <option>— موسوعة</option>
                    </select>
                </div>
            </div>
        </div>
    </div>
</form>

@if ($books ?? '' != NULL)
<div style="text-align: center" class="alert alert-info">found total of {{  $books->total() }} results</div>
<ul class="list-group list-group-flush text-right">
    @foreach ($books as $book)
    <li class="list-group-item">
        <h5><a href="{{ route('books.show', $book) }}">{{ $book['book_name'] }}</a>
            @if($book['book_access']==0)<span class="dot"></span>@endif
        </h5>
        <p>{{ $book['book_description'] }}</p>

    </li>
    @endforeach
</ul>
<div style="direction: RTL">
    {{$books->appends(Request::all())->links()}}
</div>
@endif

@endsection