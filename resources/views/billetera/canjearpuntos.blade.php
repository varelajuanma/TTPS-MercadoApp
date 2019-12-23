@extends('layouts.comprador')

@section('content')
<div class="container">
	<div class="row justify-content-center">
    	<div class="col-md-8">
     		<div class="card">
       			<div class="card-header" style="color:black">
          			  <img src="{{ url('image/canjearpuntaje.png') }}" alt="Cartera" height="30"/><strong> Canjear mis puntos </strong>
        		</div>
        		<div class="card-body">
            		@if(session('mensaje'))
                		<div class ="alert alert-{{ session('tipomensaje') }}">	{{session('mensaje')}}
      						<button type="button" class="close" data-dismiss="alert">&times;</button>
    					</div>
            		@endif

					<h5><i>Podes canjear tus puntos por dinero para tu billetera.<br>Por cada {{$proporcion}} puntos canjeados obtendras $1 de saldo.</i></h5>
					<u><strong style="font-size: 150%;">Saldo:</u> ${{ Auth::user()->saldo  }} </strong><br>
            		<u><strong style="font-size: 150%;">Puntaje obtenido:</u> {{ Auth::user()->puntaje }} puntos </strong><br><br>
            		<form action=" {{ route('billetera.canjearpuntos') }} " method="POST">
            			@csrf
    	  				Canjear <input type="number" name="puntos" min="{{$proporcion}}" value="{{$proporcion}}" step="{{$proporcion}}"> puntos
    	  				<button type="text" class="btn btn-primary"> Canjear </button>
    	  			</form>
        		</div>
			</div>
			<br>
			<a class="btn btn-primary"  href="{{ url('/mibilleteravirtual') }}" role="button" style="color:black">Volver</a>
		</div>
	</div>
</div>


@endsection
