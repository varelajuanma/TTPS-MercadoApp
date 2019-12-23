@extends('layouts.comprador')

@section('content')
<div class="container">
  <div class="row justify-content-center">
      @if(session('mensaje'))
      <div class ="alert alert-{{session('tipomensaje')}}"> {{session('mensaje')}}
        <button type="button" class="close" data-dismiss="alert">&times;</button>
      </div>
      @endif
    <div class="col-md-10">
      <div class="card">
          <div class="card-header" style="color:black;">
            <img src="{{ url('image/carrocompra.png') }}" alt="Carrito de compras" height="30"/><strong> Mi Carrito de compras</strong>
            @if (!$carrito->isEmpty())
            <form action="{{ route ('vaciarcarrito') }}" method="POST" >
          		@csrf
          		<button style="float:right" type="submit" class="btn btn-primary"  onclick="return confirm('¿Estás seguro que queres vaciar tu carrito?')"> Vaciar Carrito </button>
          	</form>
          	@endif
          </div>
          <div class="card-body">
                  @if ($carrito->isEmpty())
                    <div class="text-center">
                      <h3><i> Tu carrito se encuentra vacío </i></h3>
                    </div>
                  @else
                  @foreach ($carrito as $elem)
                  <div class="card">
                    <ul class="list-group list-group-flush">
                     <li class="list-group-item">
        			              <u><strong> Publicación:</strong></u> <a href="/publicaciones/{{$elem->publicacion()->first()->id}}"> {{ $elem->nombrepublicacion() }} </a> <br>
                            @if ($elem->cantidad <= $elem->stockdisponible())
        			              <u><strong> Cantidad:</strong></u> {{ $elem->cantidad }} <span style="color:green">({{ $elem->stockdisponible() }} disponibles en stock)  </span> <br>
                            @else
                            <u><strong> Cantidad:</strong></u> {{ $elem->cantidad }} <strong><span style="color:red">(Aviso! la publicacion solo cuenta con {{ $elem->stockdisponible() }} unidades disponibles)  </span></strong> <br>
                            @endif
                            <u> <strong> Precio unitario:</strong></u> ${{ $elem->publicacion()->first()->precioActual() }} <br>
    						            <u> <strong> Subtotal:</strong></u> ${{ ($elem->publicacion()->first()->precioActual()) * $elem->cantidad }} <br>
                            @if ($elem->estaInactiva())
                               <br> <div class ="alert alert-danger">  
                                  Esta publicacion se encuentra inactiva por lo cual NO puede ser comprada actualmente
                                </div>
                            @endif
                            <br>
                            <form method=POST action="{{ route('eliminardelcarrito') }}">
                              @csrf
                              <input type="hidden" name="carrito" value="{{$elem->id}}" >
                              <button type="sumbit" class="btn btn-primary" onclick="return confirm('¿Estás seguro que queres eliminar esta publicación de tu carrito?')"> Eliminar del carrito </button>
                            </form>
                      </li>
                    </ul>
                  </div>
    	            @endforeach
              <br>
                <li class="list-group-item" style="color:black">
                  <h4> <strong> Precio Total: </strong> ${{$precio}} </h4> <h5><span style="color:red"> <i> (El precio puede variar al momento de efectuarse la compra) </i> </span></h5>
                </li>
              <br>
                  @if (!$conflictos)
                  <form action="{{ route ('comprar') }}" method="POST" >
                    @csrf
                    <button type="sumbit" class="btn btn-primary"> Realizar Compra! </button>
                  </form>
                  @endif
                @endif
          </div>
        </div>
    </div>
  </div>
  <br>
  <a class="btn btn-primary" onclick="goBack()" role="button" style="color:black">Volver</a>
</div>

@endsection
