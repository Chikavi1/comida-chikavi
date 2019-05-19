version estable en php

@extends('layouts.app')
<?php  $total = 0;$cantidad = 0;
?>
<style>
  #map {
        height: 90%;
      }
      /* Optional: Makes the sample page fill the window. */
      html, body {
        height: 100%;
        margin: 0;
        padding: 0;
      }
</style>



<script
  src="https://code.jquery.com/jquery-3.4.0.js"
  integrity="sha256-DYZMCC8HTC+QDr5QNaIcfR7VSPtcISykd+6eSmBW5qo="
  crossorigin="anonymous"></script>

<script>

  $(document).ready(function(){
    $('.materialboxed').materialbox();
    $('select').formSelect();
    $('.modal').modal();
  });
</script>
@section('content')
<div class="row">
    <div class="col m3">
      <div class="card p1">
      <h5 class="center ">{{$user->name}} {{$user->lastnameP}}</h4>
        <div class="row padding-top-5">
          <div class="col center s8 ">metodo de pago</div>
          <div class="col s3 "><a href="#modalpago" class="modal-trigger">modificar</a></div>
        </div>
      <h5 class="center">{{$user->payment_method}}</h5>
      <div class="row padding-top-5">
      <div class="col s6">
        <a href="{{ URL::previous() }}" class="btn btn-block cyan">regresar</a>
      </div>
      <div class="col s6">
        @if($bandera)
        <a href="{{ route('pago') }}" class="btn btn-block green darken-4">siguiente</a>
        @endif
      </div>
    </div>
      </div>
    </div>
    <div class="col m8">
      <div class="card">
        <h4 class="center padding-top-2 ">Carrito de compras</h4>
        <div class="p5">
          
        <table>
             
              @if($bandera)
               <thead>
                <tr>
                    <th>Imagen</th>
                    <th>cantidad</th>
                    <th>nombre</th>
                    <th>precio</th>
                </tr>
              </thead>
              <tbody>
            @foreach($carrito as $carrito)
            @php 
             $cantidad += $carrito->cantidad;
               $dinero = $carrito->precio * $carrito->cantidad;
               $total += $dinero;
              @endphp
              
                  <tr>
                    <td><img src="{{ asset('img/'.$carrito->imagen) }}" width="60" class="materialboxed" alt=""></td>
                    <td>{{$carrito->cantidad}}</td>
                    <td>{{$carrito->nombre}}</td>
                    <td>{{$carrito->precio}}</td>
                    <td>
                      <a href="{{ route('delete',$carrito) }}" class="valign-wrapper" style="color:red" ><i class="material-icons">delete</i>Eliminar</a>
                        <a href="#modal{{$carrito->id}}"  class="modal-trigger valign-wrapper" style="color:blue" ><i class="material-icons">delete</i>modificar</a>
                    </td>
                  </tr>

   <div id="modal{{$carrito->id}}" class="modal" style="height: 80%;">
      <div class="modal-content">
 

            <form action="{{ url('/caca',$carrito )}}"  method="POST">
              {{ csrf_field() }}
           <input type="number" name="cantidad" value="{{ $carrito->cantidad }}">
           <input type="submit" value="Modificar carrito" class="btn  color-cut btn-block bottom">
          </form>
    </div>
            @endforeach
                    <tr>
                    <th>Total</th>
                    <th>{{ $cantidad}}</th>
                    <th></th>
                    <th>{{ $total }}</th>
                </tr>
          @else
          <center>
            
            <img src="{{asset('img/shopping.png')}}"  width="200" alt="bolsas de compra">
            <h5 class="center">¡Aun no tienes comida en el carrito de compras!</h5 >
          </center>
               @endif

              </tbody>

             
            </table>
        </div>

       <div id="map"></div>


      </div>
    </div>
</div>
<div class="row">
  <div class="col m3">
    
  </div>
</div>
<div class="container">
  


   <div id="modalpago" class="modal" style="height: 80%;">
      <div class="modal-content">
        <h4 class="center">Modificar Metodo de pago</h4>
        <p>Por favor seleccione cual es el metodo de pago que desea tener</p>

            <form action="{{ route('payment_method')}}"  method="GET">
           <div class="input-field col s12 offset-m2">
              
                            <select name="payment_method" >
                              <option value="{{$user->payment_method }}">Selecciona una opcion </option>
                              <option value="efectivo">Efectivo</option>
                              <option value="tarjeta">Tarjeta </option>
                              <option value="paypal">Paypal </option>
                              <option value="puntos">Puntos</option>
                            </select>
                            <label for="payment_method">Metodo de Pago</label>
                          </div>
                          <center>
                            
                            <input type="submit" value="aceptar" class="modal-close waves-effect waves-green btn-flat">
                          </center>
      </div>
     
      </form>
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

        displayRoute('CUTonalá, Nuevo Periférico Oriente, Tateposco, Tonalá, Jal.','Lomas de San Miguel, San Pedro Tlaquepaque, Jal.', directionsService,
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
</div>


@endsection