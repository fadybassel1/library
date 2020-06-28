@extends('layouts.app')

@section('content')

<style>


</style>
@if(Session::has('status'))
<div class="container alert alert-success" role="alert">
    {{ Session::get('status') }}
</div>
@endif
@if ($tagname ?? '' != NULL)
<div class="text-center">
    <div style="font-size: 20px; margin-right: 15px;" class="badge badge-light">{{ $tagname }}</div>
</div>
<br>
@endif

<form action="/bookSearch" method="get">
    @csrf
    
    <div style="" class="card align-items-center">
        <div class="card-body">
            <div class="row">
                <div class="col-10">
                    <input class="form-control" id="qq" name="qq" autocomplete="on" type="text" placeholder="Search"
                        aria-label="Search">
                    <div id="selectTags">
                        <select name="tags[]" style="margin-left: -2px;" class="selectpicker show-menu-arrow"
                            data-style="form-control" data-live-search="true" title="Search" multiple="multiple">
                            @foreach ($tags as $tag)
                            <option value="{{ $tag->id }}" data-tokens="{{ $tag->id }}">{{ $tag->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col">
                    
                    <input class="btn btn-elegant" style="color: white" type="submit" id="searchbtn" value="بحث" />
                    
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <select style="background-color: #363936; color:white" name="search" id="search"
                        class="form-control">
                        <option value="book_name">كتاب</option>
                        <option value="book_description">وصف</option>
                        <option value="book_author">مؤلف</option>
                        <option value="book_position">رف</option>
                        <option value="tags">Tags</option>
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




<div  style="margin: 0 auto; text-align: center"  id="container">
      <iframe id="iframe" src="{{asset('algo.pdf')}}#toolbar=0" width="70%" height="600px;" ></iframe>
  </div>


@if ($books ?? '' != NULL)
<div style="text-align: center" class="alert alert-info">found total of {{  $books->total() }} results</div>
<ul class="list-group list-group-flush text-right">
    @foreach ($books as $book)
    <li class="list-group-item">
        <h5> @if($book['book_access']==0) <span class="badge badge-danger">Restricted</span>@endif <a
            href="{{ route('books.show', $book) }}">{{ $book['book_name'] }}</a>

        </h5>
        <p>{{ $book['book_description'] }}</p>

    </li>
    @endforeach
</ul>
<div style="direction: RTL">
    {{$books->appends(Request::all())->links()}}
</div>
@endif

<script>
    $('#selectTags').hide();
    $('#search').on('change', function() {
       if(this.value == 'tags')
       {
           $('#qq').hide();
           $('#selectTags').show();
       }
       else
       {
           $('#qq').show();
           $('#selectTags').hide();
       }
    }); 
</script>

@endsection