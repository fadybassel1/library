@extends('layouts.app')

@section('content')
<style>
    input[type=text] {
        position: relative;
        top: 20px;
        right: -30%;
        width: 30%;
        padding: 10px;
        margin: 5px 0 15px 0;
        border-style: groove;
        border: 1px solid black;
        background: #f1f1f1;
    }

    input[type=submit] {
        position: relative;
        top: 20px;
        right: -30%;
        width: 80px;
        height: 40px;
        background: black;
        color: white;
        font-size: 14px;
        border-radius: 20px;
        border: none;

    }

    .select-css {
        position: relative;
        right: -40%;
        top: 15px;
        display: block;
        font-size: 16px;
        font-family: sans-serif;
        font-weight: 700;
        color: #fff;
        line-height: 1.3;
        padding: .6em 1.4em .5em .8em;
        width: 100%;
        max-width: 18%;
        box-sizing: border-box;
        margin: 0;
        border: 1px solid #aaa;
        box-shadow: 0 1px 0 1px rgba(0, 0, 0, .04);
        border-radius: .5em;
        -moz-appearance: none;
        -webkit-appearance: none;
        appearance: none;
        background-color: #444;
        background-repeat: no-repeat, repeat;
        background-position: right .7em top 50%, 0 0;
        background-size: .65em auto, 100%;
    }

    .select-css:hover {
        border-color: #888;
    }

    .select-css:focus {
        border-color: #aaa;
        box-shadow: 0 0 1px 3px rgba(59, 153, 252, .7);
        box-shadow: 0 0 0 3px -moz-mac-focusring;
        color: #fff;
        outline: none;
    }

    .select-css option {
        font-weight: normal;
    }


    h3 {
        font-size: 20px;
        margin: 20px 0px 0px 0px;
        padding: 0px;
    }

    p {

        padding: 0px;
        margin: 0px;
    }

    .dot {
        height: 20px;
        width: 20px;
        background-color: red;
        border-radius: 50%;
        display: inline-block;
    }
</style>
<form action="/bookSearch" method="get">
    @csrf
    <input type="submit" id="searchbtn" value="بحث" />
    <input type="text" placeholder="" name="qq" id="searchbar" autocomplete="on" />
    <select name="search" class="select-css">
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
</form>
<div dir="rtl">
    @if ($count ?? '' != NULL)
    {{  $count ?? '' }}
    {{ ' results found' }}
    @foreach ($books as $book)

    <h3><a href="results.php?id={{ $book['id']  }}">{{ $book['book_name'] }}</a>
        @if($book['book_access']==0)<span class="dot"></span>@endif
    </h3>
    <p>{{ $book['book_description'] }}</p>
    <br />

    @endforeach
    @endif
    <div>
        @endsection