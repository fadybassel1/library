@extends('layouts.app')

@section('content')


@if(Session::has('status'))
<div class="container alert alert-success" role="alert">
    {{ Session::get('status') }}
</div>
@endif
<!--Card-->
<div class="card">
    <!--Card content-->
    <div class="card-body">
        <h4 class="text-center">الاعضاء المحذوفين</h4>
        <!-- Table  -->
        <table id="DBTable" class="table table-hover">
            <!-- Table head -->
            <thead class="blue-grey lighten-4">
                <tr>
                    <th>#</th>
                    <th class="text-center">الاسم</th>
                    <th class="text-center">تاريخ الحذف</th>
                    <th class="text-center">اعدادات</th>
                </tr>
            </thead>
            <!-- Table head -->

            <!-- Table body -->
            <tbody>
                @foreach ($readers as $i =>$reader)
                <tr>
                    <th scope="row">{{ ++$i }}</th>
                    <td class="text-center"><a href="">{{ $reader->name }}</a></td>
                    <td class="text-center">{{ $reader->deleted_at->diffForHumans() }}</td>
                    <td class="text-center"><a class="btn btn-success"
                            href="{{route('restorereader',$reader->id)}}">ارجاع</a>
                    </td>
                </tr>
                @endforeach
            </tbody>
            <!-- Table body -->
        </table>
        <!-- Table  -->
    </div>
</div>

<script>
    $('#DBTable').DataTable();
</script>

@endsection