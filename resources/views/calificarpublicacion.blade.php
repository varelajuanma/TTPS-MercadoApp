@extends('layouts.comprador')

@section('content')
<div class="container">
  @if(session('mensaje'))
    <div class ="alert alert-{{session('tipoMensaje')}}">	{{session('mensaje')}}
      <button type="button" class="close" data-dismiss="alert">&times;</button>
    </div>
  @endif
  <div class="row justify-content-center">
    <div class="col-md-6">
      <div class="card">
        <div class="card-header" style="color:black">
          <strong> Calificar publicación </strong>
        </div>
        <div class="card-body">
            <u><strong>Publicación:</strong></u> <a href="/publicaciones/{{$publicacion->id}}"> {{$publicacion->nombre }} </a> <br> <br>
						@if ($calificacion == null)
						<form action= '/publicaciones/{{$publicacion->id }}/storecalificacion' method="POST">
							@csrf
							<u><strong>Puntaje</strong></u> &nbsp<input type="number" name="puntuacion" min="1" max="5" value="5" required> <br>
				    	<u><strong>Comentario</strong></u> <br>
							<textarea name="comentario" cols="50" rows="4" required></textarea>  <br>
							<button type="submit" name="confirmar" class="btn btn-primary">Enviar Calificación</button>
				    </form>
						@else
							<h3><i> Ya has calificado esta publicación </i></h3>
							<br>
							<u><strong>Calificación:</strong></u> {{ $calificacion->puntuacionFormateada() }} <br>
							<u><strong>Comentario:</strong></u> {{ $calificacion->comentario}} <br>
						@endif
	       </div>
      </div>
			<br>
      <a class="btn btn-primary" href="{{ route('historialdecompras') }}" role="button" style="color:black">Volver</a>
    </div>

  </div>
</div>
@endsection
