@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card-header text-center"><a href="/login">Admin ?</a></div>
            <br>
            <div class="card">
                <div class="card-header">{{ __('Login') }}</div>

                @if(Session::has('status'))
                <div class="container alert alert-danger" role="alert">
                    {{ Session::get('status') }}
                </div>
                @endif
                <div class="card-body">
                    <form method="POST" action="{{ route('reader.login') }}" aria-label="{{ __('Login') }}">
                        @csrf

                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Name') }}</label>

                            <div class="col-md-6">
                                <input onfocus="show(this.id)" onblur="hide(this.id)" id="name" type="text"
                                    class="form-control @error('name') is-invalid @enderror" name="name"
                                    value="{{ old('name') }}" data-toggle="popover" data-placement="right"
                                    title="اول اسم فقط"
                                    data-content='<img src="{{asset('nameguide.png')}}" width="200">' required
                                    autocomplete="off" placeholder="اول اسم فقط">

                                @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="id" class="col-md-4 col-form-label text-md-right">{{ __('ID') }}</label>

                            <div class="col-md-6">
                                <input onfocus="show(this.id)" onblur="hide(this.id)" id="id" type="number"
                                    class="form-control @error('id') is-invalid @enderror" name="id"
                                    value="{{ old('id') }}" data-toggle="popover" data-placement="right"
                                    title="موقعه على الكارت"
                                    data-content='<img src="{{asset('idguide.png')}}" width="200">' required
                                    autocomplete="off">

                                @error('id')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Login') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>


            </div>
        </div>
    </div>
</div>

<script>
    window.onload = function () {
        $('#id').popover({html:true});
        $('#name').popover({html:true});
    }
    function show(id){$('#'+id).popover('show');}
    function hide(id){$('#'+id).popover('hide');}
</script>
@endsection