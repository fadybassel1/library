@extends('layouts.app')
@section('content')

<form id="my-form" method="post" action="{{route('storeattendance')}}">
  @csrf
  <input type="text" name="id" id="id" autofocus autopostback='true'>
</form>
@if (session('error'))
<div style="text-align: center" class="alert alert-danger" role="alert">
  <strong>{{session('error')}}</strong>
</div>
@endif
<div class="card" style="width: 20%; text-align: center; margin:0 auto">

  <!-- Card image -->
  <div class="view overlay">
    @if($reader->photo ?? False)
    @php($image=$reader->photo->filename)
    <img class="card-img-top" width="100" src="{{asset("member photos/$image")}}">

    @else
    <img class="card-img-top" width="100" src="{{asset('avatar.jpg')}}" alt="Card image cap">
    @endif
    <a href="#!">
      <div class="mask rgba-white-slight"></div>
    </a>
  </div>

  <!-- Card content -->
  <div class="card-body">

    <!-- Title -->
    <h4 class="card-title">{{$reader->name ?? ''}}</h4>
    <!-- Text -->
    <p class="card-text">ID:{{$reader->id ?? "00000000"}}</p>
    <!-- Button -->
    @if($reader->id ?? False)
    <a href="readers/{{$reader->id ?? 000000}}" class="btn btn-primary">اظهار</a>
    @else
    <a href="" class="btn btn-primary">اظهار</a>
    @endif
  </div>

</div>
<!-- Card -->

@endsection