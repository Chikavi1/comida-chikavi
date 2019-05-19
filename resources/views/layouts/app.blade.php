<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>
    <!-- Scripts -->
    <script src="{{ asset('js/materialize.js') }}" defer></script>

    <!-- Fonts -->

    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet" type="text/css">

    <!-- Styles -->
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link rel="stylesheet" href="{{ asset('css/materialize.css') }}">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
     <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.7.0/animate.min.css">
     <!--
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@8"></script>-->
      <script
  src="https://code.jquery.com/jquery-3.4.0.js"
  integrity="sha256-DYZMCC8HTC+QDr5QNaIcfR7VSPtcISykd+6eSmBW5qo="
  crossorigin="anonymous"></script>

    <script>
        $(document).ready(function(){
            $(".dropdown-trigger").dropdown();
          });
        
    </script>
    <style>
        .dropdown-content{
    top:100% !important;
   }
    </style>
</head>
<body>

      <ul id="dropdown1" class="dropdown-content">
          <li><a href="#!">ver Perfil</a></li>
          <li class="divider"></li>
           <li class="deep-orange darken-4"><a class="dropdown-item white-text" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();document.getElementById('logout-form').submit();">
                                        Salir
                                    </a>
                                  
                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form></li>
    </ul>

    <nav class="color-cut">
      <div class="nav-wrapper">
        <a href="/home" class="brand-logo center">Chikavi</a>

@auth
        <ul class="right hide-on-med-and-down">
          <li><a href="{{ route('revision')}}">Carrito</a></li>
          <li><a class="dropdown-trigger" href="#!" data-target="dropdown1"><i class="material-icons right">arrow_drop_down</i> Bienvenido, {{Auth::user()->name}} {{Auth::user()->lastnameP}} </a></li>
        </ul>
@endauth
      </div>
    </nav>
            @yield('content')
    
  </body>
</html>
