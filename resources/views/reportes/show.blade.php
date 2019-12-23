@extends('layouts.vendedor')

@section('content')
<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-8">
      <div class="card">
        <div class="card-header" style="color:black">
          <img src="{{ url('image/estadistica.png') }}" alt="Reportes de venta" height="30"/><strong> Reportes de ventas </strong>
        </div>
        <div class="card-body" style="color:black">
      	     <h5><i><u>Genere el reporte de venta que desee</u></i></h5>
             <a href=" {{ route('reportes.porpublicacion') }}" style="margin: 10px" class="btn btn-primary"> Por publicación </a>
             <a href=" {{ route('reportes.porcomprador') }}" style="margin: 10px" class="btn btn-primary"> Por comprador </a>
             <a href=" {{ route('reportes.porcategoria') }}" style="margin: 10px" class="btn btn-primary" > Por categoría </a>
        </div>
      </div>
      <br>
      <a class="btn btn-primary" href="{{route('mispublicaciones')}}" role="button" style="color:black">Volver</a>
    </div>
  </div>
</div>
@endsection
