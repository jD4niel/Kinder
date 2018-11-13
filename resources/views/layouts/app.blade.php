<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>{{--
    <script src="{{ asset('js/qcode-decoder.min.js') }}"></script>--}}

    <!-- Fonts -->
    <link rel="dns-prefetch" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet" type="text/css">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/TemplateStyle.css') }}" rel="stylesheet">
    {{--datatable--}}
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/dt/dt-1.10.18/datatables.min.css"/>
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.5.1/min/dropzone.min.css"/>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.4.2/css/all.css" integrity="sha384-/rXc/GQVaYpyDdyxK+ecHPVYJSN9bmVFBvjA/9eOB+pb3F2w2N6fc5qB9Ew5yIns" crossorigin="anonymous">
</head>
<body>
@guest
    <div width="100%" style="background-image: url('{{asset('bg2.jpg')}}');background-repeat: no-repeat;background-size: 100%;height: 650px;">
        <div class="container" style="margin: 0 auto;vertical-align: center;padding-top: 45px; ">
            <div class="row col-md-6 text-center align-content-center" style="padding: 10px;margin:0 auto;background-color:rgba(14,56,79,0.76);color:#fff;border-radius: 10px;">
                <div style="margin: auto;padding: 10px;">
                <h3 class="h3 text-center" style="width: 70%;margin: 0 auto; text-align: center;">Sistema de control de entradas y salidas de alumnos en jardín de niños</h3>
                </div>
                <h1 class="h1 col-md-12">Kinder time</h1>
                <hr>
                <button class="btn-log">{{ __('Login') }}</button>
            </div>
            <br>
            <div id="login_form" class="col-md-6" style="display: none;margin:0 auto;">
                {{--<h2 class="h2">{{ __('Login') }}</h2>--}}
                <div class="form_style">
                    <form method="POST" action="{{ route('login') }}" aria-label="{{ __('Login') }}">
                        @csrf
                        <div class="form-group row">
                            <label for="email" class="col-sm-4 col-form-label text-md-right">Correo electrónico</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required autofocus>

                                @if ($errors->has('email'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">Contraseña</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>

                                @if ($errors->has('password'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-md-6 offset-md-4">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                                    <label class="form-check-label" for="remember">
                                        Recuérdame
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Login') }}
                                </button>

                                <a class="btn btn-link" href="{{ route('password.request') }}">
                                    ¿Olvidó su contraseña?
                                </a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@else
    <nav class="navbar navbar-default header">
        <div class="container-fluid">
            <div class="navbar-header">
                <a class="navbar-brand" style="color: #fff" href="{{route('home')}}">KinderTime</a>
            </div>
            <ul class="nav navbar-nav">
                <li>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: block;">
                        @csrf
                        <button type="submit" class="btn-close"><i class="fas fa-power-off"></i>&nbsp;Cerrar sesión</button>
                    </form>
                </li>
            </ul>
        </div>
    </nav>
<div class="side-nav" style="position:fixed;"><br>
    <figure class="fig text-center align-content-center">
        <img class="img-fluid profil-pic" src="{{asset('images/pic.jpg')}}" alt="imgen">
        <hr>
        <figcaption>{{ Auth::user()->name }} {{ Auth::user()->last_name }}</figcaption>
        <hr>
    </figure>
        <ul>
            <li>
                <a href="{{route('student.index')}}">
                    <span><i class="fas fa-user-graduate" style="color: #4abcc2"></i></span>
                    <span>&nbsp;Alumnos</span>
                </a>
            </li>
        </ul>
        <ul>
            <li>
                <a href="{{route('tutor.index')}}">
                    <span><i class="fas fa-user-friends" style="color: #ef83ed"></i></span>
                    <span>&nbsp;Tutores</span>
                </a>
            </li>
        </ul>
        <ul>
            <li>
                <a href="">
                    <span><i class="far fa-id-card" style="color: #53f300"></i></span>
                    <span>&nbsp;Credenciales</span>
                </a>
            </li>
        </ul>
        <ul>
            <li>
                <a href="">
                    <span><i class="fas fa-user-edit" style="color: #efe127"></i></span>
                    <span>&nbsp;Personal académico</span>
                </a>
            </li>
        </ul>
    </nav>
</div>
<div class="main-content" style="padding-top: 100px;">
    @yield('content')
</div>
@endguest
  {{--  <div id="app">
        <nav class="navbar navbar-expand-md navbar-light navbar-laravel">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    Sistema web
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">

                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                        @guest
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                            </li>
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }} <span class="caret"></span>
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <main class="py-4" style="padding-top: 100px;">
            @yield('content')
        </main>
    </div>--}}
    <script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
<script type="text/javascript" src="https://cdn.datatables.net/v/dt/dt-1.10.18/datatables.min.js"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script>
    $(document).on('click','.btn-log',function(){
        $('#login_form').slideToggle(300);
    });
</script>
    @yield('script_section')
</body>
</html>
