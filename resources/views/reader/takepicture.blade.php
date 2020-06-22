@extends('layouts.app')
@section('content')

@if (session('status'))
<div style="text-align: center" class="alert alert-success" role="alert">
    <strong>تم حفظ الصورة بنجاح</strong>
</div>
@endif
@error('image')
<div style="text-align: center" class="alert alert-danger">{{ $message }}</div>
@enderror
@error('formno')
<div style="text-align: center" class="alert alert-danger">{{ $message }}</div>
@enderror
@error('filee')
<div style="text-align: center" class="alert alert-danger">{{ $message }}</div>
@enderror
@if (session('error'))
<div style="text-align: center" class="alert alert-danger" role="alert">
    <strong >{{session('error')}}</strong>
</div>
@endif
<form action="{{route('storeimage')}}" method="POST" enctype="multipart/form-data">
  @csrf
<div class="card" style="width: 50%; margin: 0 auto;"> 
<div class="input-group">
    <div class="input-group-prepend">
      <span class="input-group-text" id="inputGroupFileAddon01"> التقاط صورة</span>
    </div>
    <div class="custom-file">
      <input name="filee" type="file" class="custom-file-input @error('filee') is-invalid @enderror" id="inputGroupFile01"
        aria-describedby="inputGroupFileAddon01">
        
        <textarea id="image" name="image" style="display: none"></textarea>
      <label class="custom-file-label" for="inputGroupFile01">اختار ملف</label>
    </div>
  </div>
<br>
<input name="formno" style="text-align: center" placeholder="رقم الاستمارة" required class="form-control">
<br>

  <button type="button" onclick="opencamera()" class="btn btn-primary">التقط صورة</button>
  <div style="margin:0 auto" id="my_camera"></div>
  <button type="button" class="btn btn-success" id="capture" style="display: none" onclick="take_snapshot()" >ألتقط</button>
  <div style="margin:0 auto" id="results" ></div>
</div>

<div class="card" style="width: 50%; margin: 2% auto;"> 
 
  <button type="submit" style="color: white" class="btn btn-warning" value="Submit">حفظ</button>

</div>
</form>

@if (session('status'))
<div  class="card" style="width: 50%; margin: 2% auto;" role="alert">
    <a class="btn btn-success" href="{{route('printcard',session('status'))}}">طباعة الكارت</a>
</div>
@endif

<script type="text/javascript" src="webcamjs/webcam.min.js"></script>

<!-- Configure a few settings and attach camera -->
<script language="JavaScript">
 Webcam.set({
  width: 320,
  height: 240,
  image_format: 'jpeg',
  jpeg_quality: 90
 });

 function opencamera(){

 Webcam.attach( '#my_camera' );
 document.getElementById('capture').style.display="";
 }

function take_snapshot() {
 
 // take snapshot and get image data
 Webcam.snap( function(data_uri) {
  // display results in page
  document.getElementById('results').innerHTML = 
  '<img src="'+data_uri+'"/>';
 
  document.getElementById('image').value = data_uri;
  } );
}
</script>



@endsection