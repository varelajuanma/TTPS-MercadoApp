@extends('layouts.comprador')

@section('content')
<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-8">
      <div class="card">
        <div class="card-header" style="color:black">
          <img src="{{ url('image/presupuesto.png') }}" alt="Cartera" height="30"/><strong> Mi historial de Transacciones</strong>
          <span style="float:right"><strong> Transacciones realizadas:</strong> {{$transacciones->count()}}</span>
        </div>

  	     @foreach ($transacciones as $transaccion)
  		    <div class="card">
            <ul class="list-group list-group-flush">
              <li class="list-group-item">
                <u><strong> Fecha de transacción:</u> </strong> {{$transaccion->created_at}} <br>
        			  @if ($transaccion->monto < 0)
        				  <u><strong> <font color="red"> Monto:</u> </strong>${{$transaccion->monto}} </font>
        			  @else
        				  <u><strong> <font color="green"> Monto:</u> </strong>${{$transaccion->monto}} </font>
        			  @endif
                <strong> {{$transaccion->tipoFormateado()}} </strong> <br>
                @if ($transaccion->tipo == 3 || $transaccion->tipo == 4)
                  <u> <strong> Publicacion:</strong></u> {{$transaccion->compra()->first()->publicacionNombre()}} <br>
                  <u> <strong> Precio Unitario:</strong></u> ${{$transaccion->compra()->first()->precio_unitario}} 
                  <strong> (x {{$transaccion->compra()->first()->cantidad}} unidades) </strong> <br>
                  <u> <strong> Comprador:</strong></u> {{$transaccion->compra()->first()->userCompradorNombreCompleto()}} <br>
                  <u> <strong> Vendedor:</strong></u> {{$transaccion->compra()->first()->userVendedorNombreCompleto()}} <br>
                @endif
              </li>
            </ul>
  		    </div>

  	@endforeach
      </div> <br>


  <div class="row justify-content-center">
    <div class="col-md-12">
      <div class="card">
        <div class="card-header" style="color:black">
          <strong> Saldo actual: </strong>
        </div>
        <div class="card-body">
            <strong style="font-size: 150%;"> ${{ Auth::user()->saldo  }} </strong><br>
        </div>
      </div>
    </div>
  </div>


      <br>
      <a class="btn btn-primary" href="{{ url('/mibilleteravirtual') }}" role="button" style="color:black">Volver</a>
    </div>
  </div>
</div>
@endsection
