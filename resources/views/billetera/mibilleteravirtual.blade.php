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
          <img src="{{ url('image/cartera.png') }}" alt="Cartera" height="30"/><strong> Mi billetera virtual </strong>
        </div>
        <div class="card-body">
            @if (session('status'))
                <div class="alert alert-success" role="alert">
                    {{ session('status') }}
                </div>
            @endif

            <u><strong style="font-size: 150%;">Saldo:</u> ${{ Auth::user()->saldo  }} </strong><br>
            <u><strong style="font-size: 150%;">Puntaje obtenido:</u> {{ Auth::user()->puntaje }} puntos </strong><br>


        </div>
      </div>
      <a href="#ingresarModal" data-toggle="modal" style="margin: 10px" class="btn btn-primary" type="submit" title="Ingresar"> Ingresar dinero </a>
      <a href="#retirarModal" data-toggle="modal" style="margin: 10px" class="btn btn-primary" type="submit" title="Retirar"> Retirar dinero </a>
      <br>
      <a href="{{route('billetera.canjearpuntos')}}" style="margin: 10px" class="btn btn-primary" type="submit"> Canjear puntaje </a>
      <a href="{{route('historialdetransacciones')}}" style="margin: 10px" class="btn btn-primary" type="submit"> Historial de Transacciones </a>
      <br>
      <a class="btn btn-primary" href="{{ route('home.comprador') }}" role="button" style="color:black">Volver</a>
    </div>
  </div>
</div>

<div id="ingresarModal" class="modal fade">
  <div class="modal-dialog modal-login">
    <div class="modal-content">
      <form form action="{{ route('saldo.ingresar') }}" enctype="multipart/form-data" method="POST">
        @csrf
        @method('PUT')
        <div class="modal-header">
          <h4 class="modal-title">Ingresar Dinero</h4>
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times</button>
        </div>
        <div class="modal-body">
          <div class="form-group">
            <label>¿Cuanto dinero desea ingresar?</label>
            <input type="number" class="form-control" name="saldo" aria-describedby="emailHelp" placeholder="Ingrese cantidad" required>
          </div>
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-primary pull-right">Ingresar</button>
        </div>
      </form>
    </div>
  </div>
</div>

<div id="retirarModal" class="modal fade">
  <div class="modal-dialog modal-login">
    <div class="modal-content">
      <form form action="{{ route('saldo.retirar') }}" method="POST">
        @csrf
        @method('PUT')
        <div class="modal-header">
          <h4 class="modal-title">Retirar Dinero</h4>
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times</button>
        </div>
        <div class="modal-body">
          <div class="form-group">
            <label>¿Cuanto dinero desea retirar?</label>
            <input type="number" class="form-control" name="saldo" aria-describedby="emailHelp" placeholder="Ingrese cantidad" required>
          </div>
        </div>
        <div class="modal-footer">
          <!-- <label class="checkbox-inline pull-left"><input type="checkbox"> Remember me</label> -->
          <button type="submit" class="btn btn-primary pull-right">Retirar</button>
        </div>
      </form>
    </div>
  </div>
</div>
@endsection
