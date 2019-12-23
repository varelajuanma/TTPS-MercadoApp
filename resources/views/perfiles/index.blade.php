@extends('layouts.comprador')

@section('content')
<div class="container">
        <h2> Usuario: {{$user->nombre}} {{$user->apellido}} </h2>
        <u><strong>Reputación:</strong></u>  {{ $user->reputacionFormateada() }} <br>
        <u><strong>Compras Realizadas:</strong></u> {{$user->cantidadCompras()}} <br>
        <u><strong>Ventas Realizadas:</strong></u> {{$user->cantidadVentas()}}  <br>
        <div class="row pt-5">
            @foreach($user->publicaciones as $post)
             <div class="col-4 pb-4">
                 <div class="card h-100">

                    <a href="/publicaciones/{{ $post->id }}"> <img class="card-img-top imagenmuestra" src="{{ $post->imagenMuestra() }}" class="w-100 h-75"> </a>

                    <div class="card-body">
                        <a href="/publicaciones/{{ $post->id }}"> <h4 class="card-title">{{$post->nombre}}</h4> </a>
                        <p class="card-text"> {{$post->descripcion}}</p>
                        <p class="card-text"> <strong>Precio: </strong> ${{$post->precioActualFormateado()}}</p>
                        <p class="card-text"> <strong> Unidades vendidas: </strong> {{$post->cantidadUnidadesVendidas()}}</p>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
</div>
@endsection
