@extends('layouts.app')

@section('content')

   <div class="col">
       <div class="row ">
            <div class="col offset-m4 m4 s12">
                <div class="card p5">
                    <center>
                        <img src="{{ asset('img/logo.png') }}" class="center" width="100" alt="">
                    </center>
                    <h2 class="center ">Chikavi</h2>
                    <form method="POST" action="{{ route('login') }}">
                        @csrf


                        <div class="row">
                            <div class="input-field col s12">
                              <input  name="email" type="email" class="validate" value="{{ old('email') }}" required autofocus>
                              <label for="email">Correo electronico</label>
                            </div>
                          </div>


                         <div class="row">
                            <div class="input-field col s12">
                              <input  name="password" type="password" class="validate" value="{{ old('password') }}" required autofocus>
                              <label for="password">Contraseña</label>
                            </div>
                          </div>

                      
                            <div class="center-align p1">
                                <a href="{{ route('register') }}" >No tengo cuenta</a>
                            </div>
                 
                        
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" class="btn btn-block  color-cut">
                                   Ingresar
                                </button>

                            </div>
                      
                    </form>
                </div>
            </div>
       </div>
   </div>
                
@endsection
