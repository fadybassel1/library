@extends('layouts.app')
@section('content')

<form class="border border-light p-5" action="{{route('tags.store')}}" method="POST">
  @csrf
  <p class="h4 mb-4 text-center">ِAdd Tag</p>

  <div class="form-group">
    <label for="formGroupExampleInput">Tag Name</label>
    <input name="name" type="text" class="form-control" id="formGroupExampleInput">
  </div>

  <button class="btn btn-info btn-block my-4" type="submit">ADD</button>
</form>
@endsection