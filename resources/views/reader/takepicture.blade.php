@extends('layouts.app')
@section('content')

<div class="card" style="width: 50%; margin: 0 auto;"> 
<div class="input-group">
    <div class="input-group-prepend">
      <span class="input-group-text" id="inputGroupFileAddon01"> التقاط صورة</span>
    </div>
    <div class="custom-file">
      <input type="file" class="custom-file-input" id="inputGroupFile01"
        aria-describedby="inputGroupFileAddon01">
      <label class="custom-file-label" for="inputGroupFile01">اختار ملف</label>
    </div>
  </div>

  <button class="btn btn-primary">التقط صورة</button>
</div>

@endsection