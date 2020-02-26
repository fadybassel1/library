@extends('layouts.app')
@section('content')
  <!DOCTYPE html>
<html lang="en">
<head>
<script src="{{ URL::asset('css/viewuser.slim.min.js') }}"></script>
<script type="text/javascript" src="{{ URL::asset('js/viewuser.min.js') }}"></script>

</head>
<body>

  <div class="card" style="width: 18rem;margin: 0 auto; text-align:center">
    <img class="card-img-down" src="{{URL::asset('avatar.jpeg')}}" alt="Card image cap">
    <div class="card-body">
      <p class="card-text">{{$reader->name ?? "unknown" }}</p>
      <p class="card-text">{{$reader->email ?? "unknown" }}</p>
      <p class="card-text">{{$reader->formno ?? "unknown"}}</p>
      <p class="card-text">{{$reader->phone ?? "unknown"}}</p>
    </div>
  </div>

<div class="bs-example">
    <div class="accordion" id="accordionExample">

        <div class="card">
            <div class="card-header" id="headingTwo" style="text-align:center">
                <h2 class="mb-0">
                    <button type="button" class="btn btn-link collapsed" data-toggle="collapse"  data-target="#collapseTwo">كنيسة</button>
                </h2>
            </div>
            <div id="collapseTwo" class="collapse show" aria-labelledby="headingTwo" data-parent="#accordionExample" style="text-align:center" >
                <div class="card-body">
                  <p class="card-text">{{$reader->church ?? "unknown" }}</p>
                  <p class="card-text">{{$reader->readers_churchlocation ?? "unknown" }}</p>
                  <p class="card-text">{{$reader->readers_churchcountry ?? "unknown"}}</p>
                  <p class="card-text">{{$reader->readers_churchcity ?? "unknown"}}</p>
                </div>
            </div>
        </div>
        <div class="card"style="text-align:center">
            <div class="card-header" id="headingOne">
                <h2 class="mb-0">
                    <button type="button" class="btn btn-link" data-toggle="collapse" data-target="#collapseOne">سكن</button>
                </h2>
            </div>
            <div id="collapseOne" class="collapse" aria-labelledby="headingOne" data-parent="#accordionExample">
                <div class="card-body">
<p> not done yet :(</p>
                </div>
            </div>
        </div>
        <div class="card" style="text-align:center">
            <div class="card-header" id="headingThree">
                <h2 class="mb-0">
                    <button type="button" class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapseThree">اخرى</button>
                </h2>
            </div>
            <div id="collapseThree" class="collapse" aria-labelledby="headingThree" data-parent="#accordionExample">
                <div class="card-body">
<p>also not done yet :(  <3 </p>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>
@endsection
