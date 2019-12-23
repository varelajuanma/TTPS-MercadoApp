@extends('layouts.comprador')

@section('content')
<div class="container">
  <form form action="/miperfil" enctype="multipart/form-data" method="POST">
      @csrf
      @method('PUT')
    <fieldset>
      <h2>Modificación de datos personales</h2>
      <div class="form-group">
        <label for="exampleNombre"><strong>Nombre</strong></label>
        <input type="text" class="form-control" name="nombre" value="{{ Auth::user()->nombre  }}" required>
      </div>
      <div class="form-group">
        <label for="exampleNombre"><strong>Apellido</strong></label>
        <input type="text" class="form-control" name="apellido" value="{{ Auth::user()->apellido  }}" required>
      </div>
      <div class="form-group">
        <label for="exampleNombre"><strong>Fecha de Nacimiento</strong></label>
        <input type="date" class="form-control" max="2018-12-31" min="1920-01-01" name="fechadenacimiento" value="{{ Auth::user()->fechadenacimiento  }}" required>
      </div>

      <button type="submit" class="btn btn-primary">Modificar</button>
      <a class="btn btn-primary" href="{{ route('miperfil') }}" role="button" style="color:black">Volver</a>
    </fieldset>
  </form>
</div>

@endsection
