@extends('layouts.app')

@section('content')
<style>
  .address {
    width: 45%;
    float: left;
    box-shadow: 0 10px 20px #9FB2C1, 0 6px 6px #9FB2C1;
    margin-top: 25px;
    margin-left: 20px;
    padding-bottom: 15px;
  }

  .hh {
    text-align: center;
    color: black;
    text-shadow: 2px 2px 4px #9FB2C1;
    font-size: 25px;
    border: 2px solid #9FB2C1;
    border-radius: 50px 20px;
    margin-left: 150px;
    margin-right: 150px;

  }

  .yy {
    margin: 0 auto;
    display: block;
    width: 60%;
    padding: 10px;
    border: none;
    border-radius: 20px;
    background: #f1f1f1;
  }

  body {
    font-family: sans-serif;
    color: #3c3939;
  }

  .address:hover {
    box-shadow: 0 19px 38px #9FB2C1, 0 15px 12px #9FB2C1;
  }

  .infoo {
    width: 45%;
    float: left;
    box-shadow: 0 10px 20px #9FB2C1, 0 6px 6px #9FB2C1;
    margin-top: 25px;
    margin-left: 50px;
    padding-bottom: 15px;
  }

  .infoo:hover {
    box-shadow: 0 19px 38px #9FB2C1, 0 15px 12px #2CD2EC;
  }

  button {
    margin-top: 2%;
    margin-right: 45%;
    padding: 10px;
    width: 10%;
    background: black;
    color: white;
    font-size: 14px;
    border-radius: 20px;
    border: none;
  }
</style>
@if(Session::has('created'))
<br>
<div class="container alert alert-success" role="alert">
  {{ Session::get('created') }}
</div>
@endif
<form action="{{ route('books.store') }}" method="post">
  @csrf
  <div class="address">

    <p class="hh">اسم الكتاب</p>
    <input name="book_name" class="yy" required="required">

    <p class="hh">ترقيم المكتبة</p>
    <input name="book_position" class="yy" required="required">

    <p class="hh">اسم الكاتب</p>
    <input name="book_author" class="yy" required="required">

    <p class="hh">اسم الجزء/رقم السلسلة</p>
    <input name="book_seriesno" class="yy" required="required">

    <p class="hh">اسم السلسة</p>
    <input name="book_seriesname" class="yy" required="required">

    <p class="hh">اسم الناشر</p>
    <input name="book_publisher" class="yy" required="required">

    <p class="hh">يسمح بالقراءة</p>
    <input name="book_access" class="yy" type="checkbox" value="1" checked>
  </div>
  <div class="infoo">
    <p class="hh">المحتوى</p>
    <textarea name="book_description" style="width:80%;" class="yy" rows="30" cols="30"></textarea>
  </div>
  <button type="submit">حفظ</button>
</form>
{{-- <button type="button" class="btn btn-primary" name="button">create book</button> --}}

<script>
  document.getElementById("addbook").className="active";
</script>

@endsection


<?php
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
// }

?>