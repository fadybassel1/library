@extends('layouts.app')

@section('content')


@if(Session::has('status'))
<div class="container alert alert-success" role="alert">
    {{ Session::get('status') }}
</div>
@endif
<div class="card">
<ul class="list-group list-group-flush text-right">
    @foreach ($readers as $reader)
    <li class="list-group-item">
        <div class="row">
            <div class="col-6">
                <h5><a
                        href="">{{ $reader->name }}</a>
                </h5>
            </div> 
             <div class="col">
                {{ $reader->deleted_at->diffForHumans() }}
               
            </div>
            <div class="col">
                <a class="btn btn-success" href="{{route('restorereader',$reader)}}">ارجاع</a>
                </h5>
            </div>
        </div>
    </li>
    @endforeach
    
</ul>
</div>
{{$readers->links()}}


@endsection