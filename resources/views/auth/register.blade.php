@extends('layouts.app')
 <script
  src="https://code.jquery.com/jquery-3.4.0.js"
  integrity="sha256-DYZMCC8HTC+QDr5QNaIcfR7VSPtcISykd+6eSmBW5qo="
  crossorigin="anonymous"></script>
<script>
     $(document).ready(function(){
    $('select').formSelect();
  });
        
</script>
@section('content')
 <div class="col">
       <div class="row ">
            <div class="col offset-m4 m4 s12">
                <div class="card p5">
                  <h3>Registrate!</h3>

                    <form method="POST" action="{{ route('register') }}">
                        @csrf
                        


                        

                        <div class="row">
                            <div class="input-field col s12">
                              <input  name="name" type="text" class="validate" value="{{ old('name') }}" required >
                              <label for="name">Nombre</label>
                            </div>
                          </div>


                         <div class="row">
                            <div class="input-field col s6">
                              <input  name="lastnameP" type="text" class="validate" value="{{ old('lastnameP') }}" required >
                              <label for="lastnameP">Apellido paterno</label>
                            </div>
                        
                            <div class="input-field col s6">
                              <input  name="lastnameM" type="text" class="validate" value="{{ old('lastnameM') }}" required >
                              <label for="lastnameM">Apellido Materno</label>
                            </div>
                          </div>
                        

                         <div class="row">
                            <div class="input-field col s12">
                              <input  name="username" type="text" class="validate" value="{{ old('username') }}" required >
                              <label for="username">Nombre de usuario</label>
                            </div>
                          </div>



                         <div class="row">
                            <div class="input-field col s12">
                              <input  name="address" type="text" class="validate" value="{{ old('address') }}" required >
                              <label for="address">Dirección</label>
                            </div>
                          </div>
    
                         <div class="input-field col s12">
                            <select name="payment_method" >
                              <option >Selecciona una opcion </option>
                              <option value="efectivo">Efectivo</option>
                              <option value="tarjeta">Tarjeta </option>
                              <option value="paypal">Paypal </option>
                              <option value="puntos">Puntos</option>
                            </select>
                            <label for="payment_method">Metodo de Pago</label>
                          </div>


                         

                         <div class="row">
                            <div class="input-field col s12">
                              <input  name="email" type="email" class="validate" value="{{ old('email') }}" required >
                              <label for="email">Correo electronico</label>
                            </div>
                          </div>



                            <div class="row">
                            <div class="input-field col s6">
                              <input  name="password" type="password" class="validate" value="{{ old('password') }}" required >
                              <label for="password">Contraseña</label>
                            </div>
                       
                            <div class="input-field col s6">
                              <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                              <label for="password-confirm">Confirma contraseña</label>
                            </div>
                          </div>



                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-block color-cut">
                                    {{ __('Registrar') }}
                                </button>
                            </div>
                        </div>
                    </form>

                </div>
            </div>
        </div>
</div>s
@endsection
