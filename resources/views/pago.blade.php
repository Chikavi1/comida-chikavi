@extends('layouts.app')
<?php  $total = 0;$cantidad = 0;
?>
@section('content')
	<div class="row">
		<div class="col m6 offset-m3 animated bounceInDown 4s">
			<div class="card p5 center">
				<h4 class="center">Confirma el pedido</h2>
				<p><strong>Nombre</strong></p>
				<p>{{$user->name}} {{ $user->lastnameP}} {{$user->lastnameM}} </p>
				<p><strong>Dirección del pedido</strong></p>
				<p>{{$user->address}}</p>
				<p><strong>Metodo de Pago</strong></p>
				<p>{{$user->payment_method}}</p>
				<table>
			        <thead>
			          <tr>
			              <th>cantidad</th>
			              <th>nombre</th>
			          	  <th>precio</th>
			          </tr>
			        </thead>
			        <tbody>
					@foreach($cart as $item)
					@php 
						 $cantidad += $item->cantidad;
					     $dinero =  $item->precio * $item->cantidad;
					     $total += $dinero;
					 @endphp
			          <tr>
			            <td>{{ $item->cantidad }}</td>
			            <td>{{ $item->nombre }}</td>
			            <td>{{ $item->precio }}</td>
			          </tr>
			         @endforeach  
			         <tr>
			              <th>{{ $cantidad }}</th>
			              <th></th>
			              <th>{{ $total }}</th>
			          </tr>
      			</table>
				<h3>Total <span class="green-text">  ${{$total}}</span></h3>


			<a href="{{ route('finish_payment')}}" class="btn btn-block color-cut" >Finalizar</a>
			</div>
		</div>
	</div>
@endsection



