@extends('layouts.vendedor')

@section('content')
<div class="container">
    <form action="/publicaciones" enctype="multipart/form-data" method="post">
        @csrf

            <div class="col-8 offset-2">
                <div class="row">
                    <h1>Crear publicación</h1>
                </div>
                @if(session('mensaje'))
                  <div class ="alert alert-danger"> {{session('mensaje')}}
                    <button type="button" class="close" data-dismiss="alert">&times;</button>
                  </div>
                @endif
                <div class="form-group row">
                    <label for="nombre"
                           class="col-md-4 col-form-label ">
                        Nombre de la publicación
                    </label>


                    <input id="nombre"
                           type="text"
                           class="form-control @error('nombre') is-invalid @enderror"
                           name="nombre"
                           value="{{ old('nombre') }}"
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
                        Descripción
                    </label>


                    <input id="descripcion"
                           type="text"
                           class="form-control @error('descripcion') is-invalid @enderror"
                           name="descripcion"
                           value="{{ old('descripcion') }}"
                           required autocomplete="descripcion" autofocus>

                    @error('descripcion')
                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                    @enderror

                </div>
                <div class="form-group row">
                    <label for="producto"
                           class="col-md-4 col-form-label ">
                        Producto
                    </label>


                    <select id="producto" style="border: 1px solid #ced4da"
                            class="form-control selectpicker @error('producto') is-invalid @enderror"
                            name="producto" data-size="7" data-live-search="true" data-title="Elegir producto" id="state_list" data-width="100%">
                    @foreach($productos as $producto)
                        <option value="{{$producto->id}}">{{$producto->nombre}}</option>
                    @endforeach
                    </select>

                    @error('producto')
                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                    @enderror

                </div>

                <div class="form-group row">
                    <label for="estado"
                           class="col-md-4 col-form-label ">
                        Estado
                    </label>


                    <select id="estado"
                            class="form-control @error('estado') is-invalid @enderror"
                            name="estado">
                        <option value=1>Activo</option>
                        <option value=2>Inactivo</option>
                    </select>

                    @error('estado')
                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                    @enderror

                </div>
                <div class="form-group row">
                    <label for="stock"
                           class="col-md-4 col-form-label ">
                        Stock
                    </label>


                    <input type="number" name="stock" min="0" class="form-control @error('stock') is-invalid @enderror">

                    @error('stock')
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
                           type="number"
                           class="form-control @error('precio_min') is-invalid @enderror"
                           name="precio_min"
                           value="{{ old('precio_min') }}"
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
                           type="number"
                           class="form-control @error('precio_base') is-invalid @enderror"
                           name="precio_base"
                           value="{{ old('precio_base') }}"
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
                           type="number"
                           class="form-control @error('precio_max') is-invalid @enderror"
                           name="precio_max"
                           value="{{ old('precio_max') }}"
                           required autocomplete="precio_max" autofocus>

                    @error('precio_max')
                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                    @enderror

                </div>



        <div class="row col-12">
            <label for="imageUpload" class="col-md-4 col-form-label ">Imágenes (se debe ingresar al menos una)</label>
           <div class="container justify-content-center">
                @for($i = 1; $i <= 5; $i++)
                <div class="avatar-upload d-inline-flex" >
                    <div class="avatar-edit">
                        <input type='file' name="imagen{{$i}}" class="imageUpload" id="imageUpload{{$i}}" accept=".png, .jpg, .jpeg" />
                        <label for="imageUpload{{$i}}"></label>
                    </div>
                    <div class="avatar-preview">
                        <div id="imagePreview{{$i}}" style="background-image: url({{url('image/nodisponible.jpg')}});">
                        </div>
                    </div>
                </div>
                @endfor
            </div>
            @error('imagen1')
<div class="alert alert-danger justify-content-center">
                                        <strong> Debe ingresar al menos una imagen!</strong>
</div>
            @enderror
        </div>

        <div class="row pt-4">
            <button class="btn btn-primary">Agregar publicación</button>

        </div>
        <br>
        <a class="btn btn-primary" href="{{ route('home.vendedor') }}" role="button" style="color:black">Volver</a>

            </div>
    </form>
</div>
   <script>
        function readURL(input, nro) {

            if (input.files && input.files[0]) {
                var reader = new FileReader();
                console.log(nro);
                reader.onload = function(e) {
                    $("#imagePreview" + nro).css('background-image', 'url('+e.target.result +')');
                    $('#imagePreview' + nro).hide();
                    $('#imagePreview' + nro).fadeIn(650);
                }
                reader.readAsDataURL(input.files[0]);
            }
        }
        $(".imageUpload").change(function() {

            var nro = this.id[11];
            readURL(this, nro);
        });

    </script>
@endsection
