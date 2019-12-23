@extends('layouts.vendedor')

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
          <img src="{{ url('image/gestionarprecio.png') }}" alt="Gestionar precios" height="30"/><strong> Panel de gestion de precios </strong>
        </div>
        <div class="card-body" style="color:black">
      	     <h5><i><u>Cambia el precio a todas tus publicaciones</u></i></h5>
             Actualmente tus publicaciones estan configuradas en el valor de <strong>{{$user->precioAsignado()}}</strong>


  	        <form action= {{ route('vendedor.setearprecios') }} method="POST">
              <br>
      	    	@csrf
      	  		<button type="submit" name="precio" value=1 class="btn btn-primary" onclick="return confirm('Estas llevando todos tus precios al base, ¿estas seguro?')"> Llevar a Precio Base </button>
      	  		<button type="submit" name="precio" value=2 class="btn btn-primary" onclick="return confirm('Estas llevando todos tus precios al máximo, ¿estas seguro?')"> Llevar a Precio Máximo </button>
      	  		<button type="submit" name="precio" value=3 class="btn btn-primary" onclick="return confirm('Estas llevando todos tus precios al mínimo, ¿estas seguro?')"> Llevar a Precio Mínimo </button>
        		</form>
        </div>

        <br>

      	<div class="card-body" style="color:black">
  	    	<h5><i><u>Aumentá o disminuí el precio de tus publicaciones en un porcentaje</u></i></h5>
          <form action= {{ route('vendedor.aumentarprecios') }} method="POST">
            @csrf
    	  		Aumentar precios en un: <input type="number" name="aumento" step="any" min="0"> %
    	  		<button type="text" class="btn btn-primary" onclick="return confirm('¿Estas seguro de aumentar tus precios en ese porcentaje?')"> Aumentar </button>
    	  	</form>
          <br>
    	  	<form action= {{ route('vendedor.disminuirprecios') }} method="POST">
    	    	@csrf
    	  		Disminuir precios en un: <input type="number" name="descuento" step="any" min="0"> %
    	  		<button type="submit" class="btn btn-primary" onclick="return confirm('¿Estas seguro de disminuir tus precios en ese porcentaje?')"> Disminuir </button>
    	  	</form>
        </div>
	   </div>
     <br>
     <a class="btn btn-primary" href="{{route('mispublicaciones')}}" role="button" style="color:black">Volver</a>
   </div>
 </div>
</div>

@endsection
