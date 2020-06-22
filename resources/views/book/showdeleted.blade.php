@extends('layouts.app')

@section('content')


@if(Session::has('status'))
<div class="container alert alert-success" role="alert">
    {{ Session::get('status') }}
</div>
@endif
<div class="card">
<ul class="list-group list-group-flush text-right">
    @foreach ($books as $book)
    <li class="list-group-item">
        <div class="row">
            <div class="col-6">
                <h5> @if($book['book_access']==0) <span class="badge badge-danger">Restricted</span>@endif <a
                        href="">{{ $book['book_name'] }}</a>
                </h5>
            </div>
            <div class="col-6">
                <a class="btn btn-success" href="{{route('restorebook',$book)}}">ارجاع</a>
                </h5>
            </div>
        </div>
    </li>
    @endforeach
    
</ul>
</div>
{{$books->links()}}


@endsection