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

    <form method="POST" action="{{route('readers.update',$reader)}}">
        @csrf
        @method('put')

        <div class="main-content">
            <!-- Top navbar -->
            <nav class="navbar" id="navbar-main">
                <div class="container-fluid">
                    <span class="avatar avatar-sm rounded-circle">
                        <img alt="Image placeholder" src="{{  asset('avatar.jpeg')   }}">
                    </span>
                    <p class="card-text"> {{$reader->name ?? "unknown" }} <span style="color:green"> :الاسم </span></p>


                    <label for="mail">email:</label><input id="mail" style="width: 20%"
                        value="{{$reader->email ?? "unknown" }}" name="email" 
                        class="form-control @error('mail') is-invalid @enderror">


                    <p class="card-text">{{$reader->formno ?? "unknown"}}<span style="color:green"> :رقم الاستمارة
                        </span>
                    </p>


                    <label for="phone">phone:</label><input style="width:20%" id="phone"
                        value="{{$reader->phone ?? "unknown"}}" name="phone" type="number"
                        class="form-control @error('phone') is-invalid @enderror">
                    @error('phone')
                    <div class="alert alert-danger">{{ $message }}</div>
                    @enderror


                    <p class="card-text">{{$reader->bdate ?? "unknown"}}<span style="color:green"> :تاريخ الميلاد
                        </span>
                    </p>


                </div>
            </nav>
            <div class="header bg-gradient-primary pb-3 pt-2 pt-md-5">
                <div class="container-fluid">
                    <div style="text-align: center" class="alert alert-info" role="alert">
                        <strong>البيانات</strong>
                        <div style="float: right" class="custom-control custom-radio custom-control-inline">
                            <input @if($reader->service==1) checked @endif onclick="servicee()" type="radio" value="1"
                            class="custom-control-input" id="defaultInline1" name="service">
                            <label class="custom-control-label" for="defaultInline1">يوجد خدمة</label>
                        </div>
                        <div style="float: right" class="custom-control custom-radio custom-control-inline">
                            <input @if($reader->service==0) checked @endif onclick="noservice()" type="radio" value="0"
                            class="custom-control-input" id="defaultInline2" name="service">
                            <label class="custom-control-label" for="defaultInline2">لا يوجد خدمة</label>
                        </div>
                    </div>
                    <div class="header-body">
                        <!-- Card stats -->
                        <div class="row">
                            <div id="first" class='{{$row}}'>
                                <div class="card card-stats mb-4 mb-xl-0">
                                    <div class="card-body">
                                        <div class="row">
                                            <div style="text-align: center" class="col">
                                                <h5 class="card-title">الكنيسة</h5>
                                            </div>
                                        </div>
                                        <div style="text-align: center">

                                            <p class="alert alert-info">اسم الكنيسة</p>


                                            <input id="church" name="church" value="{{$reader->church ?? "unknown" }}"
                                                type="text" class="form-control @error('church') is-invalid @enderror">
                                            @error('church')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                            @enderror

                                            <p class="alert alert-info">المنطقة</p>


                                            <input id="churchlocation" value="{{$reader->churchlocation ?? "unknown" }}"
                                                name="churchlocation" type="text"
                                                class="form-control @error('churchlocation') is-invalid @enderror">
                                            @error('churchlocation')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                            @enderror


                                            <p class="alert alert-info">البلد</p>


                                            <input id="churchcountry" value="{{$reader->churchcountry ?? "unknown"}}"
                                                name="churchcountry" type="text"
                                                class="form-control @error('churchcountry') is-invalid @enderror">
                                            @error('churchcountry')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                            @enderror


                                            <p class="alert alert-info">المدينة</p>


                                            <input id="churchcity" value="{{$reader->churchcity ?? "unknown"}}"
                                                name="churchcity" type="text"
                                                class="form-control @error('churchlocation') is-invalid @enderror">
                                            @error('churchcity')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                            @enderror


                                        </div>
                                    </div>
                                </div>
                            </div>






                            <div id="second" class="{{$row}}">
                                <div class="card card-stats mb-4 mb-xl-0">
                                    <div class="card-body">
                                        <div class="row">
                                            <div style="text-align: center" class="col">
                                                <h5 class="card-title">السكن</h5>
                                            </div>
                                        </div>
                                        <div style="text-align: center">
                                            <p class="alert alert-info">البلد</p>


                                            <input id="country" value="{{$reader->country ?? "unknown" }}"
                                                name="country" type="text"
                                                class="form-control @error('country') is-invalid @enderror">
                                            @error('country')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                            @enderror

                                            <p class="alert alert-info">المحافظة</p>


                                            <input id="city" value="{{$reader->city ?? "unknown" }}" name="city"
                                                type="text" class="form-control @error('city') is-invalid @enderror">
                                            @error('city')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                            @enderror


                                            <p class="alert alert-info">المنطقة</p>
                                            <input id="region" name="region" value="{{$reader->region ?? "unknown"}}"
                                                type="text" class="form-control @error('region') is-invalid @enderror">
                                            @error('region')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                            @enderror


                                            <p class="alert alert-info">اسم الشارع</p>
                                            <input id="streetname" value="{{$reader->streetname ?? "unknown"}}"
                                                name="streetname" type="text"
                                                class="form-control @error('streetname') is-invalid @enderror">
                                            @error('streetname')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                            @enderror



                                            <div style="display: inline-block;"><label class="alert alert-info"
                                                    for="">الشقة</label> <input id="appno"
                                                    value="{{$reader->appno ?? "unknown"}}" name="appno" type="text"
                                                    class="form-control @error('appno') is-invalid @enderror">
                                            </div>
                                            <div style="display:inline-block;">
                                                <label class="alert alert-info" for="">الدور</label> <input id="floorno"
                                                    name="floorno" type="text" value="{{$reader->floorno ?? ""}}"
                                                    class="form-control @error('appno') is-invalid @enderror">
                                            </div>

                                            <div style="display: inline-block;">
                                                <label class="alert alert-info" for="">العمارة</label><input
                                                    value="{{$reader->buildingno}}" id="buildingno" name="buildingno"
                                                    type="text"
                                                    class="form-control @error('buildingno') is-invalid @enderror">
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>




                            <div id="third" class="{{$row}}">
                                <div class="card card-stats mb-4 mb-xl-0">
                                    <div class="card-body">

                                        <select onchange="changetype(this.value)" name="type"
                                            class="browser-default custom-select">
                                            @if ($reader->type==0)
                                            <option selected value="0">طالب</option>
                                            <option value="1">خريج</option>
                                            @else
                                            <option selected value="1">خريج</option>
                                            <option value="0">طالب</option>
                                            @endif
                                        </select>


                                        @if ($reader->type==0)
                                        <div id="study">
                                            <div class="row">
                                                <div style="text-align: center" class="col">
                                                    <h5 class="card-title">الدراسة</h5>
                                                </div>
                                            </div>
                                            <div style="text-align: center">
                                                <p class="alert alert-info">سنة الدراسة</p>
                                                <input type="text" value="{{$reader->yearofstudy ?? Null }}"
                                                    name="yearofstudy"
                                                    class="form-control @error('yearofstudy') is-invalid @enderror">
                                                @error('yearofstudy')
                                                <div class="alert alert-danger">{{ $message }}</div>
                                                @enderror

                                                <p class="alert alert-info">المدرسة</p>


                                                <input type="text" value="{{$reader->schoolname ?? "unknown" }}"
                                                    name="schoolname"
                                                    class="form-control @error('schoolname') is-invalid @enderror">
                                                @error('schoolname')
                                                <div class="alert alert-danger">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>

                                        <div id="work" style="display: none">
                                            <div class="row">
                                                <div style="text-align: center" class="col">
                                                    <h5 class="card-title">العمل</h5>
                                                </div>
                                            </div>
                                            <div style="text-align: center">
                                                <p class="alert alert-info">المؤهل</p>
                                                <input type="text" value="{{$reader->degree ?? "unknown" }}"
                                                    name="degree"
                                                    class="form-control @error('degree') is-invalid @enderror">
                                                @error('degree')
                                                <div class="alert alert-danger">{{ $message }}</div>
                                                @enderror

                                                <p class="alert alert-info">الوظيفة</p>
                                                <input type="text" value="{{$reader->job ?? "unknown" }}" name="job"
                                                    class="form-control @error('job') is-invalid @enderror">
                                                @error('degree')
                                                <div class="alert alert-danger">{{ $message }}</div>
                                                @enderror


                                                <p class="alert alert-info">الشركة</p>
                                                <input type="text" value="{{$reader->company ?? "unknown" }}"
                                                    name="company"
                                                    class="form-control @error('company') is-invalid @enderror">
                                                @error('company')
                                                <div class="alert alert-danger">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                        @else
                                        <div id="work">
                                            <div class="row">
                                                <div style="text-align: center" class="col">
                                                    <h5 class="card-title">العمل</h5>
                                                </div>
                                            </div>
                                            <div style="text-align: center">
                                                <p class="alert alert-info">المؤهل</p>
                                                <input type="text" value="{{$reader->degree ?? "unknown" }}"
                                                    name="degree"
                                                    class="form-control @error('degree') is-invalid @enderror">
                                                @error('degree')
                                                <div class="alert alert-danger">{{ $message }}</div>
                                                @enderror

                                                <p class="alert alert-info">الوظيفة</p>
                                                <input type="text" value="{{$reader->job ?? "unknown" }}" name="job"
                                                    class="form-control @error('job') is-invalid @enderror">
                                                @error('degree')
                                                <div class="alert alert-danger">{{ $message }}</div>
                                                @enderror


                                                <p class="alert alert-info">الشركة</p>
                                                <input type="text" value="{{$reader->company ?? "unknown" }}"
                                                    name="company"
                                                    class="form-control @error('company') is-invalid @enderror">
                                                @error('company')
                                                <div class="alert alert-danger">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>

                                        <div id="study" style="display: none">
                                            <div class="row">
                                                <div style="text-align: center" class="col">
                                                    <h5 class="card-title">الدراسة</h5>
                                                </div>
                                            </div>
                                            <div style="text-align: center">
                                                <p class="alert alert-info">سنة الدراسة</p>
                                                <input type="text" value="{{$reader->yearofstudy ?? Null }}"
                                                    name="yearofstudy"
                                                    class="form-control @error('yearofstudy') is-invalid @enderror">
                                                @error('yearofstudy')
                                                <div class="alert alert-danger">{{ $message }}</div>
                                                @enderror

                                                <p class="alert alert-info">المدرسة</p>


                                                <input type="text" value="{{$reader->schoolname ?? "unknown" }}"
                                                    name="schoolname"
                                                    class="form-control @error('schoolname') is-invalid @enderror">
                                                @error('schoolname')
                                                <div class="alert alert-danger">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>

                                        @endif
                                    </div>
                                </div>
                            </div>



                            @if ($reader->service==1)
                            <div id="service" class="{{$row}}">
                                @else
                                <div id="service" style="display: none" class="{{$row}}">
                                    @endif
                                    <div class="card card-stats mb-4 mb-xl-0">
                                        <div class="card-body">
                                            <div class="row">
                                                <div style="text-align: center" class="col">
                                                    <h5 class="card-title">الخدمة</h5>
                                                </div>
                                            </div>
                                            <div style="text-align: center">
                                                <p class="alert alert-info">ما هى الخدمة؟</p>
                                                <input type="text" value="{{$reader->servicename}}" name="servicename"
                                                    class="form-control">
                                                <p class="alert alert-info">الكنيسة</p>
                                                <input type="text" value="{{$reader->servicechurch}}"
                                                    name="servicechurch" class="form-control">
                                            </div>
                                        </div>
                                    </div>
                                </div>









                            </div>
                        </div>
                    </div>

                    <div style="margin: 1%" class="text-center">
                        <input type="submit" value="حفظ" class="btn btn-lg btn-primary">

                    </div>

                </div>
    </form>
</body>

</html>
<script>
    function changetype(type){
        if (type== 1){
        document.getElementById('study').style.display='none';
        document.getElementById('work').style.display='';
        }
        else{
            document.getElementById('work').style.display='none';
            document.getElementById('study').style.display='';
        }
    }
    function servicee(){
        document.getElementById('service').style.display="";
        document.getElementById('service').classList="col-xl-3 col-lg-6";
        document.getElementById('first').classList="col-xl-3 col-lg-6";
        document.getElementById('second').classList="col-xl-3 col-lg-6";
        document.getElementById('third').classList="col-xl-3 col-lg-6";
    }

    function noservice(){
        document.getElementById('service').style.display="none";
        document.getElementById('service').classList="col-xl-4 col-lg-6";
        document.getElementById('first').classList="col-xl-4 col-lg-6";
        document.getElementById('second').classList="col-xl-4 col-lg-6";
        document.getElementById('third').classList="col-xl-4 col-lg-6";
    }
</script>
@endsection