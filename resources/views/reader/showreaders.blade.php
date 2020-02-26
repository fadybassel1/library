@extends('layouts.app')
@section('content')
  <br>
  <h2 class="text-muted" style="text-align:center"> جميع الاعضاء</h2>
  <br>
  <input class="form-control" type="text" name="advancedname" id="scanId" oninput="javascript:scanID();" style="direction: rtl" placeholder=" IDبحث بالاسم او ال">

  <table id="table" class="table table-striped table-hove">
<thead class="thead-dark">
      <tr>
        <th scope="col">#</th>
        <th scope="col">الاسم</th>
        <th scope="col">ID</th>
        <th scope="col">الايميل</th>
        <th scope="col">رقم التليفون</th>
        <th scope="col">رقم الاستمارة</th>
        <th scope="col">جميع البيانات</th>
        <th scope="col"> تعديل</th>
        <th scope="col"> حذف</th>
      </tr>
    </thead>
    <tbody>
      @forelse ($readers as $reader)
        <tr>
          <th scope="row">1</th>
          <td>{{$reader->name}}</td>
          <td>{{$reader->id}}</td>
          <td>{{$reader->email}}</td>
          <td>{{$reader->phone}}</td>
          <td>{{$reader->formno}}</td>
          <td><a href="/readers/{{$reader->id}}">جميع البيانات</a></td>
          <td><a href="#">تعديل</a></td>
          <td><a href="#">حذف</a></td>

        </tr>
      @empty
        <th colspan="9" style="text-align:center">No Readers to show </th>
    @endforelse

<script type="text/javascript">
function scanID(){

  var table = document.getElementById("table");
    var td,td1, txtValue,txtValue1;
    var input = document.getElementById("scanId");
    var f=input.value;
    var tr = table.getElementsByTagName("tr");

    document.cookie = "myJavascriptVar ="+f;




    // Loop through all table rows, and hide those who don't match the search query
    for (var i = 0; i < tr.length; i++) {
        td = tr[i].getElementsByTagName("td")[1];
        td1=tr[i].getElementsByTagName("td")[0];

        if (td || td1) {
            txtValue = td.innerText;
            txtValue1 = td1.innerText;
            if (txtValue.indexOf(input.value) > -1 || txtValue1.indexOf(input.value) > -1 ) {
                tr[i].style.display = "";
            } else {
                tr[i].style.display = "none";
            }
        }
    }
}
</script>
    </tbody>
  </table>
@endsection
