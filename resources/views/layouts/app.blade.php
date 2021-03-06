<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    {{-- <script src="{{ asset('js/app.js') }}" defer></script> --}}

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.11.2/css/all.css">

    <link rel="stylesheet" href="{{ asset('mdb/css/bootstrap.min.css')}}">
    <!-- Material Design Bootstrap -->
    <link rel="stylesheet" href="{{ asset('mdb/css/mdb.min.css')}} ">
    <!-- Plugin file -->
    <link rel="stylesheet" href="{{ asset('mdb/css/addons/datatables.min.css') }}">
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.18/dist/css/bootstrap-select.min.css">
    <!-- Your custom styles (optional) -->
    <link rel="stylesheet" href="{{ asset('mdb/css/style.css') }}">
    <!--Jquery -->
    <script type="text/javascript" src="{{ asset('mdb/js/jquery.min.js') }}"></script>
    <!-- Bootstrap tooltips -->
    <script type="text/javascript" src="{{ asset('mdb/js/popper.min.js') }}"></script>
    <!-- Bootstrap core JavaScript -->
    <script type="text/javascript" src="{{ asset('mdb/js/bootstrap.min.js') }}"></script>
    <!-- MDB core JavaScript -->
    <script type="text/javascript" src="{{ asset('mdb/js/mdb.min.js') }}"></script>
    <!-- Latest compiled and minified JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.18/dist/js/bootstrap-select.min.js"></script>
    <!-- (Optional) Latest compiled and minified JavaScript translation files -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.18/dist/js/i18n/defaults-*.min.js"></script>
    <!-- Plugin file -->
    <script src="{{asset('mdb/js/addons/datatables.min.js')}}"></script>
    <!-- Fonts -->
    {{-- <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet"> --}}

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    <link rel="icon" href="{{ URL::asset('/img/logo.png') }}" type="image/x-icon" />
</head>

<body>
    <div id="app">
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="{{ Auth::guard('reader')->check() ? url('/reader') : url('/home') }}">
                    {{ config('app.name', 'Laravel') }}
                </a>



                <button class="navbar-toggler" type="button" data-toggle="collapse"
                    data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                    aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">

                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                        @if (Auth::guard('reader')->check())
                        <li class="nav-item dropdown">
                            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                {{Auth::user()->name}} <span class="caret"></span>
                            </a>

                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                    {{ __('Logout') }}
                                </a>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                    style="display: none;">
                                    @csrf
                                </form>
                            </div>
                        </li>
                        @elseif (Auth::user())

                        {{-- DATA ENTRY --}}
                        @if (Auth::user()->role == "dataentry")
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" id="navbarDropdownMenuLink" data-toggle="dropdown"
                                aria-haspopup="true" aria-expanded="false">{{ __('الكتب') }}</a>
                            <div class="dropdown-menu dropdown-primary" aria-labelledby="navbarDropdownMenuLink">
                                <a class="dropdown-item" href="{{route('books.index')}}">بحث</a>
                                <a class="dropdown-item" href="{{route('books.create')}}">اضافة كتاب</a>
                            </div>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{route('readers.index')}}">جميع الاعضاء</a>
                        </li>

                        {{-- MODERATOR --}}
                        @elseif (Auth::user()->role == "moderator")
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" id="navbarDropdownMenuLink" data-toggle="dropdown"
                                aria-haspopup="true" aria-expanded="false">{{ __('الكتب') }}</a>
                            <div class="dropdown-menu dropdown-primary" aria-labelledby="navbarDropdownMenuLink">
                                <a class="dropdown-item" href="{{route('books.index')}}">بحث</a>
                            </div>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" id="navbarDropdownMenuLink" data-toggle="dropdown"
                                aria-haspopup="true" aria-expanded="false">الاعضاء</a>
                            <div class="dropdown-menu dropdown-primary" aria-labelledby="navbarDropdownMenuLink">
                                <a class="dropdown-item" href="{{route('readers.index')}}">جميع الاعضاء</a>
                                <a class="dropdown-item" href="{{route('readers.takepicture')}}">استخراج كارت</a>
                                <a class="dropdown-item" href="{{route('readers.create')}}">تسجيل عضو</a>
                            </div>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link" href="{{route('attendance')}}">{{ __('تسجيل') }}</a>
                        </li>

                        {{-- ADMIN --}}
                        @elseif (Auth::user()->role == "admin")
                        <li class="nav-item">
                            <a class="nav-link" href="{{route('tags.index')}}">{{ __('Tags') }}</a>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" id="navbarDropdownMenuLink" data-toggle="dropdown"
                                aria-haspopup="true" aria-expanded="false">{{ __('الكتب') }}</a>
                            <div class="dropdown-menu dropdown-primary" aria-labelledby="navbarDropdownMenuLink">
                                <a class="dropdown-item" href="{{route('books.index')}}">بحث</a>
                                <a class="dropdown-item" href="{{route('books.create')}}">اضافة كتاب</a>
                            </div>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" id="navbarDropdownMenuLink" data-toggle="dropdown"
                                aria-haspopup="true" aria-expanded="false">الاعضاء</a>
                            <div class="dropdown-menu dropdown-primary" aria-labelledby="navbarDropdownMenuLink">
                                <a class="dropdown-item" href="{{route('readers.index')}}">جميع الاعضاء</a>
                                <a class="dropdown-item" href="{{route('readers.takepicture')}}">استخراج كارت</a>
                                <a class="dropdown-item" href="{{route('readers.create')}}">تسجيل عضو</a>
                            </div>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{route('attendance')}}">{{ __('تسجيل') }}</a>
                        </li>

                        {{-- SUPER ADMIN --}}
                        @elseif (Auth::user()->role == "superadmin")
                        <li class="nav-item">
                            <a class="nav-link" href="{{route('tags.index')}}">{{ __('Tags') }}</a>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" id="navbarDropdownMenuLink" data-toggle="dropdown"
                                aria-haspopup="true" aria-expanded="false">{{ __('الكتب') }}</a>
                            <div class="dropdown-menu dropdown-primary" aria-labelledby="navbarDropdownMenuLink">
                                <a class="dropdown-item" href="{{route('books.index')}}">بحث</a>
                                <a class="dropdown-item" href="{{route('books.create')}}">اضافة كتاب</a>
                            </div>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" id="navbarDropdownMenuLink" data-toggle="dropdown"
                                aria-haspopup="true" aria-expanded="false">الاعضاء</a>
                            <div class="dropdown-menu dropdown-primary" aria-labelledby="navbarDropdownMenuLink">
                                <a class="dropdown-item" href="{{route('readers.index')}}">جميع الاعضاء</a>
                                <a class="dropdown-item" href="{{route('readers.takepicture')}}">استخراج كارت</a>
                                <a class="dropdown-item" href="{{route('readers.create')}}">تسجيل عضو</a>
                            </div>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" id="navbarDropdownMenuLink" data-toggle="dropdown"
                                aria-haspopup="true" aria-expanded="false">المديرين</a>
                            <div class="dropdown-menu dropdown-primary" aria-labelledby="navbarDropdownMenuLink">
                                <a class="dropdown-item" href="{{route('users.index')}}">جميع المديرين</a>
                                <a class="dropdown-item" href="{{route('users.create')}}">اضافة مدير</a>
                            </div>
                        </li>


                        <li class="nav-item">
                            <a class="nav-link" href="{{route('attendance')}}">{{ __('تسجيل') }}</a>
                        </li>

                        @endif

                        {{-- FOR ALL ROLES --}}
                        <li class="nav-item">

                            <a class="nav-link" onclick="event.preventDefault();
                                                 document.getElementById('logout-form').submit();"
                                href="{{ route('logout') }}" role="button" data-toggle="dropdown" aria-haspopup="true"
                                aria-expanded="false" v-pre>
                                {{ __('logout') }} <span class="caret"></span>
                            </a>
                        </li>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>

                        {{-- GUEST --}}
                        @else
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('reader.login') }}">{{ __('Login') }}</a>
                        </li>

                        @endguest
                    </ul>
                    {{-- <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                        @guest
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                    </li>
                    @if (Route::has('register'))
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                    </li>
                    @endif
                    @else


                    @endguest
                    </ul> --}}
                </div>
            </div>
        </nav>
    </div>

    <main class="py-4">
        @yield('content')
    </main>
    </div>
</body>

</html>