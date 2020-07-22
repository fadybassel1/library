@extends('layouts.app')
@section('content')
@if(Session::has('status'))
<div class="container alert alert-success" role="alert">
    {{ Session::get('status') }}
</div>
@endif
<div class="card">
    <h3 class="card-header text-center font-weight-bold text-uppercase py-4">جميع المديرين</h3>
    <div class="card-body">
        <div id="table" class="table-editable">
            <table id="DBTable" class="table table-bordered table-responsive-md table-striped text-center">
                <thead class="elegant-color white-text">
                    <tr>
                        <th class="text-center">#</th>
                        <th class="text-center">الاسم</th>
                        <th class="text-center">username</th>
                        <th class="text-center">role</th>
                        <th class="text-center"> تعديل</th>
                        <th class="text-center"> حذف</th>
                    </tr>
                </thead>
                <tbody>
                    @php($i=1)
                    @forelse ($users as $user)
                    <tr>
                        <th class="pt-3-half">{{$i}}</th>
                        <td class="pt-3-half">{{$user->name}}</td>
                        <td class="pt-3-half">{{$user->username}}</td>
                        <td class="pt-3-half">{{$user->role}}</td>
                        <td class="pt-3-half"><a class="btn btn-primary btn-rounded btn-sm my-0"
                                href="{{route('users.edit',$user)}}">تعديل</a></td>
                        <td class="pt-3-half">
                            <form action="{{ route('users.destroy', $user) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <input onclick="return confirm('تاكيد حذف العضو ؟');"
                                    class="btn btn-danger btn-rounded btn-sm my-0" type="submit" value="حذف">
                            </form>
                        </td>
                        @php($i++)
                    </tr>
                    @empty
                    <th colspan="9" style="text-align:center">No users to show </th>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
<script type="text/javascript">
    $(document).ready(function () {
    $('#DBTable').DataTable(
      {
        "columnDefs": [
          
          { "orderable": false, "targets":[0, 4, 5] },
        ],
      }
    );
    $('.dataTables_length').addClass('bs-select');
  });
  
</script>
@endsection

<!-- Editable table -->