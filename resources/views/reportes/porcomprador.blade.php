@extends('layouts.vendedor')

@section('content')

<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-8">
      <div class="card">
        <div class="card-header" style="color:black">
          <strong> Mis reportes de ventas por comprador </strong>
        </div>
        <div class="card-body" style="color:black">
             @if (!empty($datosArray))
               <canvas id="myChart"></canvas>
             @else
                <h4> No tienes ninguna venta. </h4>
             @endif
        </div>
      </div>
      <br>
      <a class="btn btn-primary" href="{{route('vendedor.reportes')}}" role="button" style="color:black">Volver</a>
    </div>
  </div>
</div>

<script>
var ctx = document.getElementById('myChart').getContext('2d');
var chart = new Chart(ctx, {
   type: 'pie',
   data:{
 datasets: [{
   data: [{!! '"' . implode('", "', $datosArray) . '"'
       !!}],
   backgroundColor: ['#42a5f5', 'red',  'black', 'green','blue', 'orange', 'purple', 'yellow', 'lightgreen', 'violet', 'gray', 'pink', 'brown'],
   label: 'Ventas por comprador'}],
   labels: [{!! '"' . implode('", "', $compradoresArray) . '"'
       !!} ]},
   options: {responsive: true}
});
</script>

@endsection
