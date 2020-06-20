@extends('layouts.app')
@section('content')


<html lang="en">

<body class="clickup-chrome-ext_installed">

    @php
     if($reader->service==0)
     $row="col-xl-4 col-lg-6";
     else 
     $row="col-xl-3 col-lg-6"   
    @endphp
    <div class="main-content">
        <!-- Top navbar -->
        <nav class="navbar" id="navbar-main">
            <div class="container-fluid">
                <span class="avatar avatar-sm rounded-circle">
                    <img alt="Image placeholder" src="{{  asset('avatar.jpeg')   }}">
                </span>
                <p class="card-text"> {{$reader->name ?? "unknown" }} <span style="color:green"> :الاسم </span></p>
                <p class="card-text">{{$reader->email ?? "unknown" }}</p>
                <p class="card-text">{{$reader->formno ?? "unknown"}}<span style="color:green"> :رقم الاستمارة </span>
                </p>
                <p class="card-text">{{$reader->phone ?? "unknown"}}<span style="color:green"> :رقم التليفون </span></p>
                <p class="card-text">{{$reader->bdate ?? "unknown"}}<span style="color:green"> :تاريخ الميلاد </span></p>
            </div>
        </nav>
        <div class="header bg-gradient-primary pb-3 pt-2 pt-md-5">
            <div class="container-fluid">
                <div style="text-align: center" class="alert alert-info" role="alert">
                    <strong>البيانات</strong>
                </div>
                <div class="header-body">
                    <!-- Card stats -->
                    <div class="row">
                        <div class='{{$row}}'>
                            <div class="card card-stats mb-4 mb-xl-0">
                                <div class="card-body">
                                    <div class="row">
                                        <div style="text-align: center" class="col">
                                            <h5 class="card-title">الكنيسة</h5>
                                        </div>
                                    </div>
                                    <div style="text-align: center">
                                        <p  class="alert alert-info">اسم الكنيسة</p>
                                        <p class="card-text">{{$reader->church ?? "unknown" }}</p>
                                        <p  class="alert alert-info">المنطقة</p>
                                        <p class="card-text">{{$reader->readers_churchlocation ?? "unknown" }}</p>
                                        <p  class="alert alert-info">البلد</p>
                                        <p class="card-text">{{$reader->readers_churchcountry ?? "unknown"}}</p>
                                        <p  class="alert alert-info">المدينة</p>
                                        <p class="card-text">{{$reader->readers_churchcity ?? "unknown"}}</p>
                                    </div>
                                </div>
                            </div>
                        </div>






                        <div class="{{$row}}">
                            <div class="card card-stats mb-4 mb-xl-0">
                                <div class="card-body">
                                    <div class="row">
                                        <div style="text-align: center" class="col">
                                            <h5 class="card-title">السكن</h5>
                                        </div>
                                    </div>
                                    <div style="text-align: center">
                                        <p  class="alert alert-info">البلد</p>
                                        <p class="card-text">{{$reader->country ?? "unknown" }}</p>
                                        <p  class="alert alert-info">المحافظة</p>
                                        <p class="card-text">{{$reader->city ?? "unknown" }}</p>
                                        <p  class="alert alert-info">المنطقة</p>
                                        <p class="card-text">{{$reader->reigon ?? "unknown"}}</p>
                                        <p  class="alert alert-info">اسم الشارع</p>
                                        <p class="card-text">{{$reader->streetname ?? "unknown"}}</p>
                                        <p  class="alert alert-info">العمارة | الدور | الشقة</p>
                                        <p class="card-text">{{$reader->appno ?? "unknown"}} | {{$reader->floorno ?? "unknown"}} | {{$reader->buildingno ?? "unknown"}} </p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        @if ($reader->type==0)
                        <div class="{{$row}}">
                            <div class="card card-stats mb-4 mb-xl-0">
                                <div class="card-body">
                                    <div class="row">
                                        <div style="text-align: center" class="col">
                                            <h5 class="card-title">الدراسة</h5>
                                        </div>
                                    </div>
                                    <div style="text-align: center">
                                        <p  class="alert alert-info">سنة الدراسة</p>
                                        <p class="card-text">{{$reader->yearofstudy ?? "unknown" }}</p>
                                        <p  class="alert alert-info">المدرسة</p>
                                        <p class="card-text">{{$reader->schoolname ?? "unknown" }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @else
                        <div class="{{$row}}">
                            <div class="card card-stats mb-4 mb-xl-0">
                                <div class="card-body">
                                    <div class="row">
                                        <div style="text-align: center" class="col">
                                            <h5 class="card-title">العمل</h5>
                                        </div>
                                    </div>
                                    <div style="text-align: center">
                                        <p  class="alert alert-info">المؤهل</p>
                                        <p class="card-text">{{$reader->degree ?? "unknown" }}</p>
                                        <p  class="alert alert-info">الوظيفة</p>
                                        <p class="card-text">{{$reader->job ?? "unknown" }}</p>
                                        <p  class="alert alert-info">الشركة</p>
                                        <p class="card-text">{{$reader->company ?? "unknown" }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endif




                        @if ($reader->service==1)
                        <div class="{{$row}}">
                            <div class="card card-stats mb-4 mb-xl-0">
                                <div class="card-body">
                                    <div class="row">
                                        <div style="text-align: center" class="col">
                                            <h5 class="card-title">الخدمة</h5>
                                        </div>
                                    </div>
                                    <div style="text-align: center">
                                        <p  class="alert alert-info">البلد</p>
                                        <p class="card-text">{{$reader->country ?? "unknown" }}</p>
                                        <p  class="alert alert-info">المحافظة</p>
                                        <p class="card-text">{{$reader->city ?? "unknown" }}</p>
                                        <p  class="alert alert-info">المنطقة</p>
                                        <p class="card-text">{{$reader->reigon ?? "unknown"}}</p>
                                        <p  class="alert alert-info">اسم الشارع</p>
                                        <p class="card-text">{{$reader->streetname ?? "unknown"}}</p>
                                        <p  class="alert alert-info">العمارة | الدور | الشقة</p>
                                        <p class="card-text">{{$reader->appno ?? "unknown"}} | {{$reader->floorno ?? "unknown"}} | {{$reader->buildingno ?? "unknown"}} </p>
                                    </div>
                                </div>
                            </div>
                        </div>
    
                        @endif
                        

                

                      
                       
                     
                    </div>
                </div>
            </div>
        </div>
        <div class="container-fluid mt--7">
            <div class="row">
                <div class="col">
                    <div class="card shadow">
                        <div class="card-header border-0">
                            <div class="row align-items-center">
                                <div class="text-center">
                                    <a href="" class="btn btn-md btn-primary"> تعديل</a>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer py-4">
                            <nav class="d-flex justify-content-end" aria-label="...">

                            </nav>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>

</body>

</html>

@endsection
































{{-- <!DOCTYPE html>
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
                        <button type="button" class="btn btn-link collapsed" data-toggle="collapse"
                            data-target="#collapseTwo">كنيسة</button>
                    </h2>
                </div>
                <div id="collapseTwo" class="collapse show" aria-labelledby="headingTwo" data-parent="#accordionExample"
                    style="text-align:center">
                    <div class="card-body">
                        <p class="card-text">{{$reader->church ?? "unknown" }}</p>
                        <p class="card-text">{{$reader->readers_churchlocation ?? "unknown" }}</p>
                        <p class="card-text">{{$reader->readers_churchcountry ?? "unknown"}}</p>
                        <p class="card-text">{{$reader->readers_churchcity ?? "unknown"}}</p>
                    </div>
                </div>
            </div>
            <div class="card" style="text-align:center">
                <div class="card-header" id="headingOne">
                    <h2 class="mb-0">
                        <button type="button" class="btn btn-link" data-toggle="collapse"
                            data-target="#collapseOne">سكن</button>
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
                        <button type="button" class="btn btn-link collapsed" data-toggle="collapse"
                            data-target="#collapseThree">اخرى</button>
                    </h2>
                </div>
                <div id="collapseThree" class="collapse" aria-labelledby="headingThree" data-parent="#accordionExample">
                    <div class="card-body">
                        <p>also not done yet :( <3 </p> </div> </div> </div> </div> </div> </body> </html> --}}