@extends('layouts.app')
<?php  $total = 0;$cantidad = 0;
?>
<style>
    
      #map {
        height: 100%;
      }
      html, body {
        height: 100%;
        margin: 0;
        padding: 0;
      }
      #description {
        font-family: Roboto;
        font-size: 15px;
        font-weight: 300;
      }

      #infowindow-content .title {
        font-weight: bold;
      }

      #infowindow-content {
        display: none;
      }

      #map #infowindow-content {
        display: inline;
      }

      .pac-card {
        margin: 10px 10px 0 0;
        border-radius: 2px 0 0 2px;
        box-sizing: border-box;
        -moz-box-sizing: border-box;
        outline: none;
        box-shadow: 0 2px 6px rgba(0, 0, 0, 0.3);
        background-color: #fff;
        font-family: Roboto;
      }

      #pac-container {
        padding-bottom: 12px;
        margin-right: 12px;
      }

      .pac-controls {
        display: inline-block;
        padding: 5px 11px;
      }

      .pac-controls label {
        font-family: Roboto;
        font-size: 13px;
        font-weight: 300;
      }

      #address {
        background-color: #fff;
        font-family: Roboto;
        font-size: 15px;
        font-weight: 300;
        margin-left: 12px;
        padding: 0 11px 0 13px;
        text-overflow: ellipsis;
        width: 400px;
      }
       #btns {
        background-color: #fff;
        font-family: Roboto;
        font-size: 15px;
        font-weight: 300;
        margin-left: 50px;
        padding: 0 11px 0 13px;
        text-overflow: ellipsis;
        width: 30px;
      }

      #address:focus {
        border-color: #4d90fe;
      }

      #title {
        color: #fff;
        background-color: #4d90fe;
        font-size: 25px;
        font-weight: 500;
        padding: 6px 12px;
      }
      #target {
        width: 345px;
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
        <form action="{{ route('pago') }}" method="get">
           {{ csrf_field() }}
          <input type="hidden" id="oculto" name="oculto">
          <input type="submit" class="btn btn-block green darken-4" value="siguiente">
        </form>
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
             
                
             <input id="address" class="controls" type="text" placeholder="Introduce tu direccion" required>
             
    <div id="map"></div>
        </div>
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

</div>

    
    <script>
     
     
var valor=document.getElementById("address").value;
      function initAutocomplete() {
        var map = new google.maps.Map(document.getElementById('map'), {
          center: {lat: 20.6019326, lng: -103.3194292},
          zoom: 13,
          mapTypeId: 'roadmap'
        });

        // Create the search box and link it to the UI element.
        var input = document.getElementById('address');
        var searchBox = new google.maps.places.SearchBox(input);
        map.controls[google.maps.ControlPosition.TOP_LEFT].push(input);

        // Bias the SearchBox results towards current map's viewport.
        map.addListener('bounds_changed', function() {
          console.log(valor);
          searchBox.setBounds(map.getBounds());
        });

        var markers = [];
        // Listen for the event fired when the user selects a prediction and retrieve
        // more details for that place.
        searchBox.addListener('places_changed', function() {
          var places = searchBox.getPlaces();

          if (places.length == 0) {
            return;
          }

          // Clear out the old markers.
          markers.forEach(function(marker) {
            marker.setMap(null);
          });
          markers = [];

          // For each place, get the icon, name and location.
          var bounds = new google.maps.LatLngBounds();
          places.forEach(function(place) {
            if (!place.geometry) {
              console.log("Returned place contains no geometry");
              return;
            }
            var icon = {
              url: place.icon,
              size: new google.maps.Size(71, 71),
              origin: new google.maps.Point(0, 0),
              anchor: new google.maps.Point(17, 34),
              scaledSize: new google.maps.Size(25, 25)
            };

            // Create a marker for each place.
            markers.push(new google.maps.Marker({
              map: map,
              icon: icon,
              title: place.name,
              position: place.geometry.location
            }));

            if (place.geometry.viewport) {
              // Only geocodes have viewport.
              
              document.getElementById("oculto").value = document.getElementById("address").value;
              console.log(document.getElementById("oculto").value)
              bounds.union(place.geometry.viewport);
            } else {
              bounds.extend(place.geometry.location);
            }
          });
          map.fitBounds(bounds);
        });
      }

    </script>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAOlpW1fYkGXKr6K4ZzU7j1VTO4DCcrueI&libraries=places&callback=initAutocomplete"
         async defer></script>
  </body>
</html>

@endsection