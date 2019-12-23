<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/jquery-3.4.1.min.js') }}" ></script>
    <script src="{{ asset('js/scripts.js') }}" ></script>
    <script src="{{ asset('js/Chart.js') }}"></script>
    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <script src="https://kit.fontawesome.com/d40b7fc812.js" crossorigin="anonymous"></script>


    <!-- Styles -->
    <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">
    <link href="{{ asset('css/vendedor.css') }}" rel="stylesheet">

    <script>
      function goBack() {
        window.history.back();
      }
    </script>

</head>
<body>
    <div id="app">
      <!--NAVBAR-->
      <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
              <strong><a class="navbar-brand" style="color: black;" href="{{route('mispublicaciones')}}">MercadoApp</a></strong>
              <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                  <span class="navbar-toggler-icon"></span>
              </button>
              <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <form class="form-inline my-2 my-lg-0" method="">
                  <input class="form-control mr-sm-2" size="30" type="text" placeholder="Ingrese búsqueda">
                  <button class="btn btn-secondary my-2 my-sm-0" type="submit"><img src="{{ url('image/lupa.png') }}" alt="Carro de compras" height="25"/></button>
                </form>
                &nbsp&nbsp
                <a class="" href=" {{ route ('vercarrito') }} ">
                  <img src="{{ url('image/carrocompra.png') }}" alt="Carro de compras" height="25"/>
                </a>
                <!-- Left Side Of Navbar -->
                <ul class="navbar-nav mr-auto">



                </ul>
                <!-- Right Side Of Navbar -->
                <ul class="navbar-nav ml-auto">
                    <!-- Authentication Links -->
                    @guest
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('login') }}">{{ __('Iniciar Sesión') }}</a>
                        </li>
                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Registrarme') }}</a>
                                </li>
                            @endif
                        @else
                            <a class="nav-link" href="{{ route('mibilletera') }}" > ${{ Auth::user()->saldo }} </a>
                            <a class="nav-link" href="{{route('mispublicaciones')}}"> {{ __('Home Vendedor') }} </a>
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->apellido  }}, {{ Auth::user()->nombre  }} <span class="caret"></span>
                                </a>
                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ url('/miperfil') }}"><img src="{{ url('image/usuario-hombre.png') }}" alt="Usuario" height="25"/><strong> {{ __('Ver mi perfil') }}</strong></a>
                                    <a class="dropdown-item" href="/comprador"><img src="{{ url('image/volver.png') }}" alt="Volver" height="25"/><strong> {{ __('Pasar a Comprador') }}</strong></a>
                                    <a class="dropdown-item" href="{{ url('/publicaciones/create') }}"><img src="{{ url('image/publicacion.png') }}" alt="Publicacion" height="25"/><strong> {{ __('Crear publicación') }}</strong></a>
                                    <a class="dropdown-item" href="{{ url('/vendedor/mispublicaciones') }}"><img src="{{ url('image/inventario.png') }}" alt="Mis publicaciones" height="25"/><strong> {{ __('Ver mis publicaciones') }}</strong></a>
                                    <a class="dropdown-item" href="{{ url('/mibilleteravirtual') }}"><img src="{{ url('image/cartera.png') }}" alt="Cartera" height="25"/><strong> {{ __('Billetera Virtual') }}</strong></a>
                                    <a class="dropdown-item" href="{{ url('/vendedor/paneldegestiondeprecios') }}"><img src="{{ url('image/gestionarprecio.png') }}" alt="Gestionar precios" height="25"/><strong> {{ __('Gestionar precios de mis publicaciones') }}</strong></a>
                                    <a class="dropdown-item" href="{{ route ('vendedor.reportes') }}"><img src="{{ url('image/estadistica.png') }}" alt="Reporte de Ventas" height="25"/><strong> {{ __('Generar reportes de ventas') }}</strong></a>
                                    <div class="dropdown-divider"></div>
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();"><img src="{{ url('image/logout.png') }}" alt="Logout" height="25"/>
                                        <strong>{{ __('Cerrar Sesión') }}</strong>
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>

                </div>
            </div>
        </nav>

        <main class="py-4">
            @yield('content')
        </main>
    </div>

    <!-- FOOTER -->
    <footer class="card-footer text-muted position-absolute mb-0">

      <!-- Copyright -->
      <div class="footer-copyright text-center py-3">© 2019 Copyright:
        <a href="https://drive.google.com/drive/folders/1lYCnjmEXU-1zWlJRibpvkBOAG_mhnbPn"> Drive - Grupo 01</a>
      </div>
      <!-- Copyright -->

    </footer>

    <!-- JS Bootstrap -->
    <script src="https://code.jquery.com/jquery-3.2.1.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>
</html>
