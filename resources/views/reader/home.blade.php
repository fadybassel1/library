{{-- @extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Reader :: Dashboard</div>

                <div class="card-body">
                    @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
</div>
@endif

You are logged in!
</div>
</div>
Book read
@foreach (Auth::guard('reader')->user()->books as $book)
<div>{{ $book->book_name }}, {{ $book->pivot->date_read }}</div>
@endforeach
</div>
</div>
</div>
@endsection --}}


@extends('layouts.app')

@section('content')
<div style="text-align: center; width:40%; margin:0 auto" class="alert alert-info" role="alert">
    <strong>welcome</strong>  {{auth()->user()->name}}
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>


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
                        <!-- Table  -->
                        <table id="DBTable" class="table table-hover">
                            <!-- Table head -->
                            <thead class="blue-grey lighten-4">
                                <tr>
                                    <th style="font-size: 18px;" class="text-center">الكتب</th>
                                </tr>
                            </thead>
                            <!-- Table head -->

                            <!-- Table body -->
                            <tbody dir="rtl">
                                @foreach (Auth::guard('reader')->user()->books as $i => $book)
                                <tr dir="rtl" style="text-align: right;">
                                    <td>
                                        <a href="/books/{{ $book->id }}">
                                            <h5>{{ $book->book_name }}</h5>
                                            <p>{{ $book['book_description'] }}</p>
                                        </a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                            <!-- Table body -->
                        </table>
                        <!-- Table  -->
                    </div>
                </div>
                <!--/.Card-->
                <br>
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
                            <a class="list-group-item list-group-item-action waves-effect">اخر تسجيل دخول
                                <span class="float-left">{{ Session::get('lastLogin') }}</span>
                            </a>
                        </div>
                        <!-- List group links -->

                    </div>

                </div>
                <!--/.Card-->

                <!--Card-->
                <div class="card">

                    <!--Card content-->
                    <div class="card-body">
                        <h4 class="text-center">اخر 5 كلمات تم البحث عنها</h4>
                        <!-- Table  -->
                        <table id="DBTable" class="table table-hover">
                            <!-- Table body -->
                            <tbody>
                                @foreach ($keywords as $keyword)
                                <tr>
                                    <td style="text-align: right;"><a href="">{{ $keyword->keyword }}</a></td>
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
        <!--Grid row-->
    </div>
</main>
<!--Main layout-->

<script>
    // $('#DBTable').DataTable();
</script>

@endsection