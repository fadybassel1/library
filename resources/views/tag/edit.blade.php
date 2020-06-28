@extends('layouts.app')
@section('content')
<div class="container">
  <form class="border border-light p-5" action="{{route('tags.update',$tag->id)}}" method="POST">
    @csrf
    @method('PUT')
    <p class="h4 mb-4 text-center">Edit Tag</p>

    <div class="form-group">
      <label for="formGroupExampleInput">Tag Name</label>
      <input name="name" type="text" class="form-control  @error('name') is-invalid @enderror"
        id="formGroupExampleInput" value="{{$tag->name}}" required>
      @error('name')
      <span class="invalid-feedback" role="alert">
        <strong>{{ $message }}</strong>
      </span>
      @enderror
    </div>

    <button class="btn btn-info btn-block my-4" type="submit">Edit</button>
  </form>
</div>
@endsection