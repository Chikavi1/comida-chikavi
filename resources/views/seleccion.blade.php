@extends('layouts.app')

@section('content')

<div class="container ">
	
<h1 class="center animated 3s tada">{{$title}}</h1>

<div class="row animated 4s bounceIn">
	@foreach($products as $product)
	<div class="col s12 m4">
		  <div class="card">
		    <div class="card-image waves-effect waves-block waves-light">
		      <img class="activator"  style="max-height: 11em;" src="{{ asset('img/'.$product->imagen) }}" >
		    </div>
		    <div class="card-content">
		      <span class="card-title center activator grey-text text-darken-4">{{$product->nombre}}<i class="material-icons right">more_vert</i></span>
		    </div>
		    <div class="card-reveal">
		      <span class="card-title grey-text text-darken-4">{{$product->nombre}}<i class="material-icons right">close</i></span>
		      <p>Por favor seleccione la cantidad deseada</p>
		     

		     <!-- <a href="{{ route('revision') }}" class="btn btn-block">Agregar al carrito</a>
-->
			<center>
				

		      <form action="{{ url('/caca',$product)}}" method="POST">
				{{ csrf_field() }}
				<input type="number" name="cantidad">
				<input type="submit" value="Añadir al carrito" class="btn  color-cut btn-block bottom">
				</form>
			</center>


		    </div>
		  </div>
	</div>
	@endforeach

	</div>
</div>
</div>
@endsection