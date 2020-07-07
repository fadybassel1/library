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

    .icon-google {
        margin-left: 10px;
        background: conic-gradient(from -45deg, #ea4335 110deg, #4285f4 90deg 180deg, #34a853 180deg 270deg, #fbbc05 270deg) 73% 55%/150% 150% no-repeat;
        -webkit-background-clip: text;
        background-clip: text;
        color: transparent;
        -webkit-text-fill-color: transparent;
    }
</style>
@if(Session::has('status'))
<br>
<div class="container alert alert-success" role="alert">
    {{ Session::get('status') }}
</div>
@endif

@if ($errors->any())
<div class="alert alert-danger">
    <ul>
        @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif

<div class="text-center">
    @if (Auth::user()->role=='admin')
    <a data-toggle="modal" data-target="#modalSubscriptionForm" style="color: white" class="btn btn-warning"> ارسال
        مشكلة <i style="color: white" class="fas fa-flag"> </i></a>
    <a href="{{ route('books.edit', $book) }}" class="btn btn-primary">تعديل</a>
    <form class="d-inline" action="{{ route('books.destroy', $book) }}" method="POST">
        @csrf
        @method('DELETE')
        <input onclick="return confirm('تاكيد حذف الكتاب ؟');" class="btn btn-danger" type="submit" value="حذف">
    </form>
    @endif
    <p class="book-name {{ $book['book_access'] ==1 ? '' : 'alert alert-danger'}}"> {{ $book['book_name'] }}
    </p>
    <a href="https://www.google.com/search?q={{ $book->book_name }}" target="_blank"><i style="font-size: 30px;"
            class="fab fa-google icon-google"></i></a>
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












<div class="modal fade" id="modalSubscriptionForm" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header text-center">
                <h4 class="modal-title w-100 font-weight-bold">ارسال مشكلة عن كتاب</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{route('reportproblem')}}" method="POST">
                @csrf
                @method('POST')
                <div class="modal-body mx-3">
                    <div style="margin: 0 auto; text-align: center" class="md-form mb-5">

                        <!-- Group of default radios - option 2 -->
                        <div class="custom-control custom-radio">
                            <input value="بيانات الكتاب" type="radio" class="custom-control-input"
                                id="defaultGroupExample2" name="about" checked>
                            <label class="custom-control-label" for="defaultGroupExample2">بيانات الكتاب</label>
                        </div>
                        <input type="hidden" name="bookid" value="{{$book->id}}">
                        <div class="custom-control custom-radio">
                            <input value="صورة الكتاب" type="radio" class="custom-control-input"
                                id="defaultGroupExample1" name="about">
                            <label class="custom-control-label" for="defaultGroupExample1">صورة الكتاب</label>
                        </div>
                    </div>



                    <div class="md-form mb-4">
                        <i class="fas fa-envelope prefix grey-text"></i>
                        <input name="details" required type="text" id="form2" class="form-control validate">
                        <label data-error="wrong" data-success="right" for="form2">تفاصيل</label>
                    </div>

                </div>
                <div class="modal-footer d-flex justify-content-center">
                    <button type="submit" class="btn btn-primary">Send<i class="fas fa-paper-plane-o ml-1"></i></button>
            </form>
        </div>
    </div>
</div>
</div>


@endsection