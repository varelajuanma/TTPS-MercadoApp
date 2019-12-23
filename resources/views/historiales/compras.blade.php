@extends('layouts.comprador')

@section('content')
<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-8">
      <div class="card">
        <div class="card-header" style="color:black">
          <img src="{{ url('image/historialcompras.png') }}" alt="historialcompras" height="30"/><strong> Mi Historial de Compras</strong>
          <span style="float:right"><strong> Compras realizadas:</strong> {{$compras->count()}}</span>
        </div>

	       @foreach ($compras as $compra)
         <div class="card">
           <ul class="list-group list-group-flush">
             <li class="list-group-item">
			              <u><strong> Fecha:</strong></u> {{$compra->created_at}} <br>
                    <u><strong> Publicación:</strong></u> <a href="/publicaciones/{{$compra->publicacion()->first()->id}}"> {{$compra->publicacion()->first()->nombre}} </a> <br>
			              <u><strong> Vendedor:</strong></u> <a href="/perfiles/{{$compra->uservendedor()->first()->id}}"> {{$compra->uservendedor()->first()->nombreCompleto()}} </a> <br>
                    <u><strong> Informacion de contacto:</strong></u> {{$compra->uservendedor()->first()->email}}  <br>
			              <u><strong> Unidades compradas:</strong></u> {{$compra->cantidad}} <br>
                    <u><strong> Precio unitario:</strong></u> ${{$compra->precio_unitario}} <br>
                    <u><strong> Precio total:</strong></u> ${{$compra->precio_unitario * $compra->cantidad}} <br>
                    <br>
                    <div class="form-group">
                    @if ($compra->publicacion()->first()->calificacion(Auth::user()) == null )
                      <a  href="/publicaciones/{{ $compra->publicacion_id }}/calificar" class="btn btn-primary"> Calificar publicación </a>
                    @else
                      <a  href="/publicaciones/{{ $compra->publicacion_id }}/calificar" class="btn btn-primary"> Ver calificación </a>
                    @endif
                    </div>
            </li>
          </ul>
      </div>
	     @endforeach
      </div>
      <br>
      <a class="btn btn-primary" href={{route('home.comprador')}} role="button" style="color:black">Volver</a>
    </div>
  </div>
</div>

@endsection
