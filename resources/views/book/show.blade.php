@extends('layouts.app')
@section('content')

<style>
    .address {
        width: 45%;
        float: left;
        box-shadow: 0 10px 20px #9FB2C1, 0 6px 6px #9FB2C1;
        margin-left: 75px;
        padding-bottom: 15px;
    }

    .address:hover {
        box-shadow: 0 19px 38px #9FB2C1, 0 15px 12px #2CD2EC;
    }

    .infoo {
        width: 45%;
        float: left;
        box-shadow: 0 10px 20px #9FB2C1, 0 6px 6px #9FB2C1;
        margin-left: 50px;
        padding-bottom: 15px;
    }

    .infoo:hover {
        box-shadow: 0 19px 38px #9FB2C1, 0 15px 12px #2CD2EC;
    }

    .book-name {
        display: inline;
        text-align: center;
        font-weight: bold;
        font-size: 30px;
        padding-left: 10px;
    }

    .book-values {
        text-align: center;
        font-size: 20px;
    }
</style>
@if(Session::has('status'))
<br>
<div class="container alert alert-success" role="alert">
    {{ Session::get('status') }}
</div>
@endif

<div class="text-center">
    @if (Auth::user()->role=='admin')
    <a href="{{ route('books.edit', $book) }}" class="btn btn-primary">تعديل</a>
    <form class="d-inline" action="{{ route('books.destroy', $book) }}" method="POST">
        @csrf
        @method('DELETE')
        <input onclick="return confirm('تاكيد حذف الكتاب ؟');" class="btn btn-danger" type="submit" value="حذف">
    </form>
    @endif
    <p class="book-name {{ $book['book_access'] ==1 ? '' : 'alert alert-danger'}}"> {{ $book['book_name'] }}
    </p>
</div>
<br>
<div class="text-center">
    @foreach ($book->tags as $tag)
    <a style="font-size: 20px; margin-right: 15px;" class="badge badge-light"
        href="/bookSearch/{{ $tag->id }}">{{ $tag->name }}</a>
    @endforeach
</div>
<br>
<div class="address">

    <p class="text-center alert alert-info">ترقيم المكتبة</p>
    <p class="book-values"> {{ $book['book_position'] != "" ? $book['book_position'] : 'NOT KNOWN' }} </p>

    <p class="text-center alert alert-info">ID</p>
    <p class="book-values"> {{ $book['id'] != "" ? $book['id'] : 'NOT KNOWN' }} </p>

    <p class="text-center alert alert-info">اسم الكاتب</p>
    <p class="book-values"> {{ $book['book_author'] != "" ? $book['book_author'] : 'NOT KNOWN' }} </p>

    <p class="text-center alert alert-info">اسم الجزء/رقم السلسلة</p>
    <p class="book-values"> {{ $book['book_seriesno'] != "" ? $book['book_seriesno'] : 'NOT KNOWN' }} </p>

    <p class="text-center alert alert-info">اسم السلسة</p>
    <p class="book-values"> {{ $book['book_seriesname'] != "" ? $book['book_seriesname'] : 'NOT KNOWN' }} </p>

    <p class="text-center alert alert-info">اسم الناشر</p>
    <p class="book-values"> {{ $book['book_publisher'] != "" ? $book['book_publisher'] : 'NOT KNOWN' }} </p>

</div>
<div class="infoo">
    <p class="text-center alert alert-info">المحتوى</p>
    <p class="book-values"> {{ $book['book_description'] != "" ? $book['book_description'] : 'NOT KNOWN' }} </p>
</div>

@endsection