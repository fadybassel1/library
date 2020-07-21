@extends('layouts.app')

@section('content')
{{-- <div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div style="text-align:center;" class="card-header">Welcome</div>
                <div class="card-body" style="text-align:center;">

                    <div class="alert alert-success" role="alert">
                        {{Auth::user()->username }}
</div>
</div>
</div>
</div>
</div>
</div> --}}
<!--Main layout-->


<div style="text-align: center; width:40%; margin:0 auto" class="alert alert-info" role="alert">
    <strong>welcome</strong> {{Auth::user()->name}}
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>



@php
$days = [0, 0, 0, 0, 0];

foreach($daysCount as $day)
{
if ($day['day'] === date('Y-m-d')) {
$days[0] = $day['COUNT(*)'];
}
elseif ($day['day'] === date('Y-m-d',strtotime("-1 days"))) {
$days[1] = $day['COUNT(*)'];
}
elseif ($day['day'] === date('Y-m-d',strtotime("-2 days"))) {
$days[2] = $day['COUNT(*)'];
}
elseif ($day['day'] === date('Y-m-d',strtotime("-3 days"))) {
$days[3] = $day['COUNT(*)'];
}
elseif ($day['day'] === date('Y-m-d',strtotime("-4 days"))) {
$days[4] = $day['COUNT(*)'];
}
}
@endphp

<main class="mx-lg-5">

    <div class="container-fluid mt-5">
        <!--Grid row-->

        <div class="row wow fadeIn">

            <!--Grid column-->
            {{-- Attendence stat --}}

            <div class="col-md-8 mb-4">
                <!--Card-->
                <div class="card">
                    <!--Card content-->
                    <div class="card-body">
                        <canvas id="attendenceChart"></canvas>
                    </div>
                </div>
                <!--/.Card-->
                <br>
                @if (Auth::user()->role=='admin' || Auth::user()->role=='superadmin')

                <span class="badge badge-danger"><a class="dropdown-toggle mr-2" type="button" data-toggle="dropdown"
                        aria-haspopup="true"><i class="fas fa-trash fa-2x" aria-hidden="true"> سلة النفايات</i></a>
                    <div style="color: black" class="dropdown-menu">
                        <a class="dropdown-item" href="{{route('deletedbooks')}}">الكتب</a>
                        <a class="dropdown-item" href="{{route('deletedreaders')}}">الاعضاء</a>
                    </div>
                </span>
                @endif

            </div>
            <!--Grid column-->

            <!--Grid column-->
            <div class="col-md-4 mb-4">

                <!--Card-->
                <div class="card mb-4">

                    <!--Card content-->
                    <div class="card-body">

                        <!-- List group links -->
                        <div class="list-group list-group-flush text-right" style="font-size:18px;" dir="rtl">
                            <a class="list-group-item list-group-item-action waves-effect">عدد الحضور اخر 7
                                ايام
                                <span class="badge badge-dark badge-pill pull-right">{{ $last7daysCount }}</span>
                            </a>
                            <a class="list-group-item list-group-item-action waves-effect">عدد الحضور اليوم
                                <span class="badge badge-dark badge-pill pull-right">{{ $days[0] }}</span>
                            </a>
                            <a class="list-group-item list-group-item-action waves-effect">عدد الاعضاء
                                <span class="badge badge-dark badge-pill pull-right ">{{ $readersCount }}</span>
                            </a>
                            <a class="list-group-item list-group-item-action waves-effect">عدد الكتب
                                <span class="badge badge-dark badge-pill pull-right">{{ $booksCount }}</span>
                            </a>
                            @if(auth()->user()->role=='admin' || auth()->user()->role=='superadmin')
                            <a href="{{route('showreports')}}"
                                class="list-group-item list-group-item-action waves-effect">الشكاوى
                                <span class="badge badge-danger badge-pill pull-right">{{ $reportsCount }}</span>
                            </a>
                            @endif
                        </div>
                        <!-- List group links -->

                    </div>

                </div>
                <!--/.Card-->

                <!--Card-->
                <div class="card">

                    <!--Card content-->
                    <div class="card-body">
                        <h4 class="text-center">الحاضرين اليوم</h4>
                        <!-- Table  -->
                        <table id="DBTable" class="table table-hover">
                            <!-- Table head -->
                            <thead class="blue-grey lighten-4">
                                <tr>
                                    <th>#</th>
                                    <th class="text-center">الاسم</th>
                                </tr>
                            </thead>
                            <!-- Table head -->

                            <!-- Table body -->
                            <tbody>
                                @foreach ($todayUsers as $i =>$user)
                                <tr>
                                    <th scope="row">{{ ++$i }}</th>
                                    <td class="text-center">{{ $user['name'] }}</td>
                                </tr>
                                @endforeach
                            </tbody>
                            <!-- Table body -->
                        </table>
                        <!-- Table  -->

                    </div>

                </div>
                <!--/.Card-->

            </div>
            <!--Grid column-->

        </div>
    </div>
</main>
<!--Main layout-->
<script>
    $('#DBTable').DataTable();

    // Line
    var ctx = document.getElementById("attendenceChart").getContext('2d');
    var myChart = new Chart(ctx, {
      type: 'bar',
      data: {
        labels: [
                    new Date().toJSON().slice(5,10) ,
                    (function(d){ d.setDate(d.getDate()-1); return d.toJSON().slice(5,10)})(new Date),
                    (function(d){ d.setDate(d.getDate()-2); return d.toJSON().slice(5,10)})(new Date),
                    (function(d){ d.setDate(d.getDate()-3); return d.toJSON().slice(5,10)})(new Date),
                    (function(d){ d.setDate(d.getDate()-4); return d.toJSON().slice(5,10)})(new Date),
                    (function(d){ d.setDate(d.getDate()-5); return d.toJSON().slice(5,10)})(new Date),
                ],
        datasets: [{
          label: 'عدد الحضور بترتيب الايام',
          data: [
            @php
            echo $days[0];
            @endphp,
            @php
            echo $days[1];
            @endphp,
            @php
            echo $days[2];
            @endphp,
            @php
            echo $days[3];
            @endphp,
            @php
            echo $days[4];
            @endphp,
          ],
          backgroundColor: [
            'rgba(255, 99, 132, 0.2)',
            'rgba(54, 162, 235, 0.2)',
            'rgba(255, 206, 86, 0.2)',
            'rgba(75, 192, 192, 0.2)',
            'rgba(153, 102, 255, 0.2)',
            'rgba(255, 159, 64, 0.2)'
          ],
          borderColor: [
            'rgba(255,99,132,1)',
            'rgba(54, 162, 235, 1)',
            'rgba(255, 206, 86, 1)',
            'rgba(75, 192, 192, 1)',
            'rgba(153, 102, 255, 1)',
            'rgba(255, 159, 64, 1)'
          ],
          borderWidth: 1
        }]
      },
      options: {
        scales: {
          yAxes: [{
            ticks: {
              beginAtZero: true
            }
          }]
        }
      }
    });

</script>

@endsection