@extends('layouts.app')

@section('content')

@if ($message = Session::get('success'))
<div class="color-cut">
  <h5 class="center white-text" style="margin-top: 0 !important;padding: 1em;"><strong>{{ $message }}</strong></h5>
</div>

@endif

<div class="container">
    <div class="card p5">
        <h3 class="center">Bienvenido</h3>
        <p class="center">Por favor Selecciona una categoria.</p>
        
        <div class="row">
            @foreach($categories as $category)
            <div class="col s12 m4">
               <div class="card" >
                    <div class="card-image waves-effect waves-block waves-light">
                      <img class="activator img-height" src="{{ asset('img/'. $category->imagen ) }}" >
                    </div>
                    <div class="card-content">
                      <span class="card-title center-align activator grey-text text-darken-4">{{$category->titulo}}<i class="material-icons right">more_vert</i></span>
                    </div>
                    <div class="card-reveal">
                      <span class="card-title grey-text text-darken-4">{{$category->titulo}}<i class="material-icons right">close</i></span>
                      <p>¡Mira mas sobre esta categoria!</p>
                      <a href="{{ route('seleccion',$category->titulo) }}" class="btn btn-block color-cut bottom">ver más</a>
                    </div>
                </div>
            </div>
            @endforeach
            


        </div>
    </div>
</div>
@endsection
