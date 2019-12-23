@extends('layouts.vendedor')

@section('content')
<div class="container">

    <form action="/productos/{{$producto->id}}" enctype="multipart/form-data" method="post">
        @csrf
        @method('PATCH')

        <div class="col-8 offset-2">
            <div class="row">
                <h1>Editar producto</h1>
            </div>
            <div class="form-group row">
                <label for="nombre"
                       class="col-md-4 col-form-label ">
                    Nombre del Producto
                </label>


                <input id="nombre"
                       type="text"
                       class="form-control @error('nombre') is-invalid @enderror"
                       name="nombre"
                       value="{{ old('nombre') ?? $producto->nombre }}"
                       required autocomplete="nombre" autofocus>

                @error('nombre')
                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                @enderror

            </div>

            <div class="form-group row">
                <label for="descripcion"
                       class="col-md-4 col-form-label ">
                    Descripcion
                </label>


                <input id="descripcion"
                       type="text"
                       class="form-control @error('descripcion') is-invalid @enderror"
                       name="descripcion"
                       value="{{ old('descripcion') ?? $producto->descripcion}}"
                       required autocomplete="descripcion" autofocus>

                @error('descripcion')
                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                @enderror

            </div>
            <div class="form-group row">
                <label for="precioMinimo"
                       class="col-md-4 col-form-label ">
                    Precio Minimo
                </label>


                <input id="precio_min"
                       type="text"
                       class="form-control @error('precio_min') is-invalid @enderror"
                       name="precio_min"
                       value="{{ old('precio_min') ?? $producto->precio_min}}"
                       required autocomplete="precio_min" autofocus>

                @error('precio_min')
                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                @enderror

            </div>

            <div class="form-group row">
                <label for="precio_base"
                       class="col-md-4 col-form-label ">
                    Precio Base
                </label>


                <input id="precio_base"
                       type="text"
                       class="form-control @error('precio_base') is-invalid @enderror"
                       name="precio_base"
                       value="{{ old('precio_base') ?? $producto->precio_base }}"
                       required autocomplete="precio_base" autofocus>

                @error('precio_base')
                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                @enderror

            </div>

            <div class="form-group row">
                <label for="precio_max"
                       class="col-md-4 col-form-label ">
                    Precio Máximo
                </label>


                <input id="precio_max"
                       type="text"
                       class="form-control @error('precio_max') is-invalid @enderror"
                       name="precio_max"
                       value="{{ old('precio_max') ?? $producto->precio_max}}"
                       required autocomplete="precio_max" autofocus>

                @error('precio_max')
                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                @enderror

            </div>



            <div class="row">
                <label for="imagen" class="col-md-4 col-form-label ">Imagen</label>
                <input type="file" class="form-control-file" id="imagen" name="imagen">

                @error('imagen')

                <strong>{{ $message }}</strong>

                @enderror
            </div>

            <div class="row pt-4">
                <button class="btn btn-primary">Actualizar producto</button>
            </div>

    </form>
</div>
@endsection
