
@extends('layouts.app')

@section('content')
<div class="container">
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
</div>
@endsection
