@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Reader :: Dashboard</div>

                <div class="card-body">
                    @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                    @endif

                    You are logged in!
                </div>
            </div>
            Book read
            @foreach (Auth::guard('reader')->user()->books as $book)
            <div>{{ $book->book_name }}, {{ $book->pivot->date_read }}</div>
            @endforeach
        </div>
    </div>
</div>
@endsection