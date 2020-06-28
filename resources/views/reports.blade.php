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
        <h4 class="text-center">الكتب المحذوفة</h4>
        <!-- Table  -->
        <table id="DBTable" class="table table-hover">
            <!-- Table head -->
            <thead class="blue-grey lighten-4">
                <tr>
                    <th>#</th>
                    <th class="text-center">عن</th>
                    <th class="text-center">تاريخ</th>
                    <th class="text-center">تفاصيل</th>
                    <th colspan="2" class="text-center">اعدادات</th>
                </tr>
            </thead>
            <!-- Table head -->

            <!-- Table body -->
            <tbody>
                @foreach ($reports as $i =>$report)
                <tr>
                    <th scope="row">{{ ++$i }}</th>
                    <td class="text-center" > {{ $report->about }}</td>
                                                      
                    <td class="text-center">{{ $report->created_at->diffForHumans() }}</td>
                    <td class="text-center">{{ $report->details }}</td>
                    <td class="text-center"><a class="btn btn-success" href="{{route("$report->target.show",$report->targetid)}}">اظهار</a>
                    </td>
                    <td class="text-center"><a class="btn btn-danger" href="{{route('deletereport',$report)}}">مسح</a>
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