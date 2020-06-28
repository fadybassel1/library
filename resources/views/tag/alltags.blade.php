@extends('layouts.app')
@section('content')



<!-- Editable table -->
<div class="card">
  <h3 class="card-header text-center font-weight-bold text-uppercase py-4">All Tags table</h3>
  <a class="btn btn-info btn-rounded" href="{{ route('tags.create') }}">ADD</a>
  @if(Session::has('deleted'))
  <br>
  <div class="container alert alert-success" role="alert">
    {{ Session::get('deleted') }}
  </div>
  @endif
  <div class="card-body">
    <div id="table">

      <table id="tagsTable" class="table table-bordered table-responsive-lg table-striped text-center">
        <thead>
          <tr>
            <th class="text-center">#</th>
            <th class="text-center">الاسم</th>
            <th style="width:20%" style="" class="text-center">تعديل</th>
            <th style="width:20%" style="" class="text-center">حذف</th>
          </tr>
        </thead>
        <tbody>
          @foreach ($tags as $i => $tag )
          <tr>
            <td scope="row">{{ ++$i }}</td>
            <td>{{$tag->name}}</td>
            <td>
              <a href="tags/{{ $tag->id}}/edit">
                <button type="button" class="btn btn-info btn-rounded my-0" style="color: white;">تعديل</button>
              </a>
            </td>
            <td>
              <form method="POST" action="/tags/{{ $tag->id }}">
                @csrf
                @method('DELETE')
                <button type="submit" onclick="return confirm('Are you sure you want to delete this tag?');"
                  class="btn btn-danger btn-rounded my-0" name="delete">حذف
                </button>
              </form>
            </td>
          </tr>
          @endforeach
        </tbody>
      </table>
    </div>
  </div>
</div>

<script>
  $(document).ready(function () {
    $('#tagsTable').DataTable(
      {
        "columnDefs": [
          { "orderable": false, "targets":2 },
          { "orderable": false, "targets":3 },
        ],
      }
    );
    $('.dataTables_length').addClass('bs-select');
  });
</script>
@endsection