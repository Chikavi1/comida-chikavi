@extends('layouts.app')
<?php  $total = 0;$cantidad = 0;
?>
@section('content')
<script>
	 $(document).ready(function(){
    $('.modal').modal();
  });
</script>
	<div class="row">
		<div class="col m6 offset-m3 animated bounceInDown 4s">
			<div class="card p5 center">
				<h4 class="center">Confirma el pedido</h2>
				<p><strong>Nombre</strong></p>
				<p>{{$user->name}} {{ $user->lastnameP}} {{$user->lastnameM}} </p>
				<p><strong>Dirección del pedido</strong></p>
				<p  style="text-align:center !important;">
					<a  href="#modalmapa" class="modal-trigger"> {{$direccion}} </a>
				</p>
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


 <div id="modalmapa" class="modal" style="height: 80%;">
      <div class="modal-content">
 	 <div id="map"></div>
    <div id="right-panel">
      <p>Distancia a recorrer: <span id="total"></span></p>
    </div>
    </div>
</div>

<script>
      function initMap() {
        var map = new google.maps.Map(document.getElementById('map'), {
          zoom: 4,
          center: {lat: 23.3134142, lng: -111.6559662}  // mexico.
        });

        var directionsService = new google.maps.DirectionsService;
        var directionsDisplay = new google.maps.DirectionsRenderer({
          draggable: true,
          map: map,
          panel: document.getElementById('right-panel')
        });

        directionsDisplay.addListener('directions_changed', function() {
          computeTotalDistance(directionsDisplay.getDirections());
        });

        displayRoute('CUTonalá, Nuevo Periférico Oriente, Tateposco, Tonalá, Jal.',
        	'{{$direccion}}', directionsService,
            directionsDisplay);
      }

      function displayRoute(origin, destination, service, display) {
        service.route({
          origin: origin,
          destination: destination,
        
          travelMode: 'DRIVING',
          avoidTolls: true
        }, function(response, status) {
          if (status === 'OK') {
            display.setDirections(response);
          } else {
            alert('Could not display directions due to: ' + status);
          }
        });
      }

      function computeTotalDistance(result) {
        var total = 0;
        var myroute = result.routes[0];
        for (var i = 0; i < myroute.legs.length; i++) {
          total += myroute.legs[i].distance.value;
        }
        total = total / 1000;
        document.getElementById('total').innerHTML = total + ' km';
      }
    </script>
    <script async defer
    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAOlpW1fYkGXKr6K4ZzU7j1VTO4DCcrueI&callback=initMap">
    </script>
@endsection



