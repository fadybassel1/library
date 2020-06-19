@extends('layouts.app')
@section('content')
  
  <div class="card">
    <h3 class="card-header text-center font-weight-bold text-uppercase py-4">جميع الاعضاء</h3>
    <div class="card-body">
      <div id="table" class="table-editable">
        <span class="table-add float-right mb-3 mr-2"><a href="#!" class="text-success"><i
              class="fas fa-plus fa-2x" aria-hidden="true"></i></a></span>
        <table id="DBTable" class="table table-bordered table-responsive-md table-striped text-center">
          <thead class="elegant-color white-text">
            <tr>
              <th class="text-center">#</th>
              <th class="text-center">الاسم</th>
              <th class="text-center">ID</th>
              <th class="text-center">الايميل</th>
              <th class="text-center">رقم التليفون</th>
              <th class="text-center">رقم الاستمارة</th>
              <th class="text-center">جميع البيانات</th>
              <th class="text-center"> تعديل</th>
              <th class="text-center"> حذف</th>
            </tr>
          </thead>
          <tbody>
            @php($i=1)
        @forelse ($readers as $reader)
          <tr>
          <th class="pt-3-half">{{$i}}</th>
            <td class="pt-3-half">{{$reader->name}}</td>
            <td class="pt-3-half">{{$reader->id}}</td>
            <td class="pt-3-half">{{$reader->email}}</td>
            <td class="pt-3-half">{{$reader->phone}}</td>
            <td class="pt-3-half">{{$reader->formno}}</td>
            <td class="pt-3-half"><a href="/readers/{{$reader->id}}">جميع البيانات</a></td>
            <td class="pt-3-half"><a href="#">تعديل</a></td>
            <td class="pt-3-half"><a href="#">حذف</a></td>
            @php($i++)
          </tr>
        @empty
          <th colspan="9" style="text-align:center">No Readers to show </th>
      @endforelse
          </tbody>
        </table>
      </div>
    </div>
  </div>
<script type="text/javascript">
   window.onload = function () {
    $(document).ready(function () {
    $('#DBTable').DataTable(
      {
        "columnDefs": [
          
          { "orderable": false, "targets":[0,1,2,3,4,5,6,7,8] },
        ],
      }
    );
    $('.dataTables_length').addClass('bs-select');
  });
  
  }
 </script>
@endsection

<!-- Editable table -->