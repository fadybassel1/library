@extends('layouts.app')
@section('content')

<form class="border border-light p-5" action="{{route('tags.update',$tag->id)}}" method="POST">
  @csrf
  @method('PUT')
  <p class="h4 mb-4 text-center">Edit Tag</p>

  <div class="form-group">
    <label for="formGroupExampleInput">Tag Name</label>
    <input name="name" type="text" class="form-control" id="formGroupExampleInput" value="{{$tag->name}}">
  </div>

  <button class="btn btn-info btn-block my-4" type="submit">Edit</button>
</form>
@endsection