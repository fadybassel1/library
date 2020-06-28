@extends('layouts.app')

@section('content')
<style>
  .address {
    width: 45%;
    float: left;
    box-shadow: 0 10px 20px #9FB2C1, 0 6px 6px #9FB2C1;
    margin-left: 75px;
    padding-bottom: 15px;
  }

  .address:hover {
    box-shadow: 0 19px 38px #9FB2C1, 0 15px 12px #2CD2EC;
  }

  .infoo {
    width: 45%;
    float: left;
    box-shadow: 0 10px 20px #9FB2C1, 0 6px 6px #9FB2C1;
    margin-left: 50px;
    padding-bottom: 15px;
  }

  .infoo:hover {
    box-shadow: 0 19px 38px #9FB2C1, 0 15px 12px #2CD2EC;
  }
</style>
@if(Session::has('created'))
<div class="container alert alert-success" role="alert">
  {{ Session::get('created') }}
</div>
@endif
<div style="text-align: center">
  <form action="{{ route('books.store') }}" method="post">
    @csrf
    <div class="address">

      <p class="alert alert-info">اسم الكتاب</p>
      <input name="book_name" style="width: 90%; margin: 0 auto;" class="form-control text-center" required="required">
      <br>
      <p class="alert alert-info">ترقيم المكتبة</p>
      <input name="book_position" style="width: 90%; margin: 0 auto;" class="form-control text-center"
        required="required">
      <br>
      <p class="alert alert-info">اسم الكاتب</p>
      <input name="book_author" style="width: 90%; margin: 0 auto;" class="form-control text-center"
        required="required">
      <br>
      <p class="alert alert-info">اسم الجزء/رقم السلسلة</p>
      <input name="book_seriesno" style="width: 90%; margin: 0 auto;" class="form-control text-center"
        required="required">
      <br>
      <p class="alert alert-info">اسم السلسة</p>
      <input name="book_seriesname" style="width: 90%; margin: 0 auto;" class="form-control text-center"
        required="required">
      <br>
      <p class="alert alert-info">اسم الناشر</p>
      <input name="book_publisher" style="width: 90%; margin: 0 auto;" class="form-control text-center"
        required="required">
      <br>
      <p class="alert alert-info">يسمح بالقراءة</p>
      <div style="text-align: center" class="custom-control custom-switch">
        <input type="checkbox" name="book_access" value="1" checked class="custom-control-input" id="customSwitches">
        <label class="custom-control-label" for="customSwitches">يسمح بالقراءة</label>
      </div>
    </div>
    <div class="infoo">
      <p class="alert alert-info">المحتوى</p>

      <textarea name="book_description" style="width: 90%; margin: 0 auto;" dir="rtl" class="form-control" rows="28"
        cols="30"></textarea>
      <br>
      <label for="">Tags</label>
      <select name="tags[]" class="selectpicker show-menu-arrow" data-style="form-control" data-live-search="true"
        title="Tags" multiple="multiple">
        @foreach ($tags as $tag)
        <option value="{{ $tag->id }}" data-tokens="{{ $tag->id }}">{{ $tag->name }}</option>
        @endforeach
      </select>
      <br>
      <button class="btn btn-primary btn-lg" type="submit">حفظ</button>
    </div>
  </form>
</div>

<script>
  $('select').selectpicker();
</script>
{{-- <button type="button" class="btn btn-primary" name="button">create book</button> --}}

@endsection

{{-- 
// include 'appbar.php';
// include 'close.php';
// require_once('conn.php');  
// $_SESSION == null? header('location: login.php') : "";
// try{
//      if(isset($_POST['submit']))
//      { 
//           $query = $db->prepare("INSERT INTO shelf VALUES (NULL , :book_name , :book_publisher , :book_author , :book_description , '' , :library_num , '' , '' , :book_seriesno , :book_seriesname , '', :bookaccess, :book_creator)");
//           $query->execute(
//                array(
//                     ':book_name' => $_POST['book_name'],
//                     ':book_publisher' => $_POST['book_publisher'],
//                     ':book_author' => $_POST['book_author'],
//                     ':book_description' => $_POST['book_description'],
//                     ':library_num' => $_POST['library_num'],
//                     ':book_seriesno' => $_POST['book_seriesno'],
//                     ':book_seriesname' => $_POST['book_seriesname'],
//                     ':bookaccess' => isset($_POST['book_access']) && $_POST['book_access'] == 1 ? 1 : 0,
//                     ':book_creator' => $_SESSION['staffname'],
//                ),
//           );
//           $count = $query->rowCount();
          
//           if($count == 1)
//           {
//                $stmt = $db->prepare("INSERT INTO staff_log VALUES(NULL ,'".$_SESSION['staffname']."',' Add Book ". $_POST['book_name'] ." at " .date('Y-m-d H:i:s')."' )");
//                $stmt->execute();  
//           }
          
//      }
// }catch(PDOException $e){
//      $message = "فشل الاتصال بقاعدة البيانات";
// } --}}