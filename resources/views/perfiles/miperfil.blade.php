@extends('layouts.comprador')

@section('content')
<div class="container">
  @if(session('mensaje'))
    <div class ="alert alert-{{session('tipoMensaje')}}">	{{session('mensaje')}}
      <button type="button" class="close" data-dismiss="alert">&times;</button>
    </div>
  @endif
  <div class="row justify-content-center">
    <div class="col-md-8">
      <div class="card">
        <div class="card-header" style="color:black">
          <img src="{{ url('image/usuario-hombre.png') }}" alt="Usuario" height="25"/><strong> Información personal </strong>
        </div>
        <div class="card-body">
            @if (session('status'))
                <div class="alert alert-success" role="alert">
                    {{ session('status') }}
                </div>
            @endif

            <u><strong>Nombre:</strong></u> {{ Auth::user()->nombre  }} <br>
            <u><strong>Apellido:</strong></u> {{ Auth::user()->apellido  }} <br>
            <u><strong>Fecha de Nacimiento:</strong></u> {{ Auth::user()->fechadenacimiento  }} <br>
            <u><strong>Dirección de email:</strong></u> {{ Auth::user()->email  }} <br>
            <u><strong>Compras realizadas:</strong></u> {{Auth::user()->cantidadCompras()}} <br>
            <u><strong>Ventas realizadas:</strong></u> {{Auth::user()->cantidadVentas()}} <br>
            <u><strong>Puntos:</strong></u> {{Auth::user()->puntaje}} <br>
            <u><strong>Reputación como vendedor:</strong></u> {{Auth::user()->reputacionFormateada() }}

        </div>
      </div>
      <a href="/miperfil/edit" style="margin: 10px" class="btn btn-primary" type="submit" title="Editar mis datos"> Editar mis datos </a>
      <a class="btn btn-primary" href="{{ route('home.comprador') }}" role="button" style="color:black">Volver</a>
    </div>

  </div>
</div>
@endsection
