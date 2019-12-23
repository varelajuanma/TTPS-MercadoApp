@extends('layouts.vendedor')

@section('content')
<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-10">
      <div class="card">
        <div class="card-header" style="color:black">
          <img src="{{ url('image/historialcompras.png') }}" alt="historialcompras" height="30"/><strong> Mi Historial de Ventas</strong>
          <span style="float:right"><strong> Ventas realizadas:</strong> {{$compras->count()}}</span><br>
          <span style="float:right"><strong> Calificación promedio:</strong> {{ $publicacion->calificacionPromedioFormateada() }} </span>
        </div>
        @if ($compras->count() >= 1)
	       @foreach ($compras as $compra)
         <div class="card">
           <ul class="list-group list-group-flush">
             <li class="list-group-item">
			              <u><strong> Fecha:</strong></u> {{$compra->created_at}} <br>
			              <u><strong> Comprador:</strong></u> {{$compra->usercomprador()->first()->nombreCompleto()}} <br>
			              <u><strong> Unidades vendidas:</strong></u> {{$compra->cantidad}} <br>
                    <u><strong> Precio unitario:</strong></u> ${{$compra->precio_unitario}} <br>
                    <u><strong> Precio total:</strong></u> ${{$compra->precio_unitario * $compra->cantidad}} <br>
                    {{-- <u><strong> Puntaje:</strong></u> {{$compra->puntajeDummie()} <br> --}}
                    {{-- <u><strong> Comentario:</strong></u> {{$compra->comentarioDummie()} <br> --}}
              </li>
            </ul>
         </div>
	        @endforeach
        @else
          <div class="card">
            <ul class="list-group list-group-flush">
              <li class="list-group-item">
                <h3><i> Esta publicación no tiene ventas realizadas </i></h3>
              </li>
            </ul>
          </div>
        @endif
      </div>
      <br>
      <a class="btn btn-primary" onclick="goBack()" role="button" style="color:black">Volver</a>
    </div>
  </div>
</div>

@endsection
