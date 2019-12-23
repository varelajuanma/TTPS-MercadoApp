@extends('layouts.comprador')

@section('content')
<div class="container">
    @if (session('error'))
        <div class="alert alert-warning"> {{session('error')}}
          <button type="button" class="close" data-dismiss="alert">&times;</button>
        </div>
    @endif
    <div class="row pt-5">

        @if ($publicaciones->isEmpty())
            <h2 style="color:red; font-family: 'Noto Serif', serif;">Lamentablemente no hemos encontrado ninguna publicacion :(</h2>
        @endif
        @if ($sugerenciasporcategoria)
          <h2 class="text-center" style="color: black;font-family: 'Noto Serif', serif;"> Basándonos en tus compras anteriores, te recomendamos las siguientes publicaciones </h2>
        @endif

        @foreach($publicaciones as $post)
            <div class="col-lg-4 pb-4 col-sm-10">
                <div class="card h-100 text-center">

                    <a href="/publicaciones/{{ $post->id }}"> <img class="card-img-top imagenmuestra" src="{{ $post->imagenMuestra() }}" class="w-100 "> </a>

                    <div class="card-body">
                        <a href="/publicaciones/{{ $post->id }}"> <h5 class="card-title">{{$post->nombre}}</h5> </a>
                        <p class="card-text"> {{$post->descripcion}}</p>
                        <p class="card-text"> <strong>Precio: </strong> ${{$post->precioActualFormateado()}}</p>
                        <p class="card-text"> <strong>Cantidad de ventas: </strong> {{$post->cantidadVentas()}} </p>


                    </div>
                </div>
            </div>
        @endforeach
        <div class="row justify-content-center col-12">
            <div class="col-2">
                {{$publicaciones->links()}}
            </div>
        </div>
    </div>
</div>
@endsection
