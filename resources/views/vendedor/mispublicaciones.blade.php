@extends('layouts.vendedor')

@section('content')
<div class="container">
    <h2><u> {{$user->nombre}} {{$user->apellido}}, estas son tus publicaciones</u></h2>

    @if(session('mensaje'))
    <div class ="alert alert-{{session('tipoMensaje')}}">   {{session('mensaje')}}
        <button type="button" class="close" data-dismiss="alert">&times;</button>
    </div>
    @endif
    <a href="{{route('mispublicaciones')}}" class="btn btn-primary"> Todas mis publicaciones </a>
    <a href="{{route('mispublicacionesinactivas')}}" class="btn btn-primary"> Mis publicaciones Inactivas </a>
    <a href="{{route('mispublicacionessinstock')}}" class="btn btn-primary"> Mis publicaciones Sin stock </a>

  <div class="row pt-5">
    @if (count($publicaciones) >= 1)
    @foreach($publicaciones as $post)
      <div class="col-md-4 col-sm-10">
          <div class="card ml-5 text-center col-md-100">
            <a href="/vendedor/publicaciones/{{ $post->id }}"><img class="card-img-top imagenmuestra" src="{{ $post->imagenMuestra() }}" alt="Imagen"></a>
            <div class="card-body">
                <a href="/vendedor/publicaciones/{{ $post->id }}"><h5 class="card-title">{{$post->nombre}}</h5></a>
                <p class="card-text"> {{$post->descripcion}}</p>
                <p class="card-text"> <strong>Precio: </strong> ${{$post->precioActualFormateado()}}</p>
                @if( $post->estadoActual() == 'Activo')
                  <p class="card-text"> <strong>Estado: <span style="color:lightgreen"> {{$post->estadoActual()}} </span> </strong> </p>
                @else
                  <p class="card-text"> <strong>Estado: <span style="color:red"> {{$post->estadoActual()}} </span> </strong> </p>
                @endif
                <p class="card-text"> <strong>Stock disponible: </strong> {{$post->stock}} unidad/es</p>
                <p class="card-text"> <strong>Cantidad de ventas: </strong> {{$post->cantidadVentas()}}  ({{$post->cantidadUnidadesVendidas()}} unidad/es)</p>
                <a href="/publicaciones/{{ $post->id }}/edit" class="btn btn-primary"> Editar</a>
                <br>
                <br>
                @if($post->estado_id == 2)
                    <form action="/publicaciones/{{ $post->id }}/habilitar" method="post">
                     @method('PUT')
                     @csrf
                      <button class="btn btn-primary"> Pasar a estado activo</button>
                    </form>
                @else
                    <form action="/publicaciones/{{ $post->id }}/deshabilitar" method="post">
                      @method('PUT')
                      @csrf
                        <button class="btn btn-primary"> Pasar a estado Inactivo</button>
                    </form>
                @endif
              </div>
            </div>
            <br>
          </div>

    @endforeach
            <div class="row justify-content-center col-12">
                <div class="col-2">
                    {{$publicaciones->links()}}
                </div>
            </div>
    @else
        @if($vista == 'todas')
          <h4> Aun no tenes ninguna publicación. Animate y creá la primera! </h4>
        @else
           <h4> No tenes ninguna publicación que cumpla con los filtros especificados. </h4>
          <h4> <a href="{{route('mispublicaciones')}}"> Volver a mis publicaciones </a>  </h4>
        @endif

    @endif
    </div>
  <br>
  <a href="{{ route ('publicacion.create') }}" class="btn btn-primary" style="width:400px;"> Crear nueva publicación </a>
</div>
@endsection
