<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Noto+Serif&display=swap" rel="stylesheet">
    <script src="https://kit.fontawesome.com/d40b7fc812.js" crossorigin="anonymous"></script>

    <!-- Scripts -->
    <script src="{{ asset('js/jquery-3.4.1.min.js') }}" ></script>
    <script src="{{ asset('js/scripts.js') }}" ></script>


    <!-- Styles -->
    <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">
    <link href="{{ asset('css/comprador.css') }}" rel="stylesheet">

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
              <strong><a class="navbar-brand" style="color: black;" href="{{ url('/comprador') }}">MercadoApp</a></strong>
              <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                  <span class="navbar-toggler-icon"></span>
              </button>
              <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <form action="{{ url('/buscar') }}" class="form-inline my-2 my-lg-0" method="GET">
                  <input name="busqueda" class="form-control mr-sm-2" size="30" type="text" value="{{$str_busqueda ?? ' ' }}" placeholder="Ingrese búsqueda">
                  <button class="btn btn-secondary my-2 my-sm-0" type="submit"><img src="{{ url('image/lupa.png') }}" alt="Carro de compras" height="25"/></button>
                </form>
                &nbsp&nbsp
                <a class="" href=" {{ route ('vercarrito') }} ">
                  <img src="{{ url('image/carrocompra.png') }}" alt="Carro de compras" height="25"/>
                </a>
                  <!--DROPDOWN FILTROS-->
                      <ul class="navbar-nav mr-1">
                          <!-- Level one dropdown -->
                          <li class="nav-item dropdown">
                            <a id="dropdownMenu1" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="nav-link dropdown-toggle"><i class="fas fa-filter"></i> Filtros</a>
                              <ul aria-labelledby="dropdownMenu1" class="dropdown-menu border-0 shadow">

                                  <!-- Level two dropdown-->
                                  <li class="dropdown-submenu">
                                      <a id="dropdownMenu2" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="dropdown-item dropdown-toggle">Categorías</a>
                                      <ul aria-labelledby="dropdownMenu2" class="dropdown-menu border-0 shadow">
                                          @foreach($categorias as $categoria)

                                              <li>

                                                      <a class="dropdown-item" href="/filtrar?str={{$str_busqueda ?? '' }}&cat={{$categoria->id}}">{{$categoria->nombre}}</a>

                                              </li>
                                      @endforeach
                                      </ul>
                                  </li>
                                  <!-- End Level two -->
                                  <!-- Level two dropdown-->
                                  <li class="dropdown-submenu">
                                      <a id="dropdownMenu2" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="dropdown-item dropdown-toggle">Rango de precios</a>
                                      <ul aria-labelledby="dropdownMenu2" class="dropdown-menu border-0 shadow">
                                          <li>
                                              <a class="dropdown-item" href="/filtrar?str={{$str_busqueda ?? '' }}&min=0&max=500">Hasta $500</a>
                                          </li>
                                          <li>
                                              <a class="dropdown-item" href="/filtrar?str={{$str_busqueda ?? '' }}&min=500&max=1500">De $500 a $1500</a>
                                          </li>
                                          <li>
                                              <a class="dropdown-item" href="/filtrar?str={{$str_busqueda ?? '' }}&min=1500&max=3000">$1500 a $3000</a>
                                          </li>
                                          <li>
                                              <a class="dropdown-item" href="/filtrar?str={{$str_busqueda ?? '' }}&min=3000&max=5000">$3000 a $5000</a>
                                          </li>
                                          <li>
                                              <a class="dropdown-item" href="/filtrar?str={{$str_busqueda ?? '' }}&min=5000&max=999999">Más de $5000</a>
                                          </li>
                                      </ul>
                                  </li>
                                  <!-- End Level two -->
                              </ul>
                          </li>
                          <!-- End Level one -->
                      </ul>

          <!--DROPDOWN ORDENAR-->
          <ul class="navbar-nav mr-auto">
              <!-- Level one dropdown -->
              <li class="nav-item dropdown">
                  <a id="dropdownMenu1" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="nav-link dropdown-toggle"><i class="fas fa-sort"></i> Ordenar</a>
                  <ul aria-labelledby="dropdownMenu1" class="dropdown-menu border-0 shadow">

                      <!-- Level two dropdown-->
                      <li class="dropdown-submenu">
                          <a id="dropdownMenu2" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="dropdown-item dropdown-toggle">Por precio</a>
                          <ul aria-labelledby="dropdownMenu2" class="dropdown-menu border-0 shadow">

                              <li>
                                  <a tabindex="-1" href="/ordenar?str={{$str_busqueda ?? '' }}&criterio=menor_mayor" class="dropdown-item">De menor a mayor</a>
                              </li>
                              <li>
                                  <a tabindex="-1" href="/ordenar?str={{$str_busqueda ?? '' }}&criterio=mayor_menor" class="dropdown-item">De mayor a menor</a>
                              </li>
                          </ul>
                      </li>
                      <!-- End Level two -->
                  </ul>
              </li>
              <!-- End Level one -->
          </ul>
              </div>
                <!-- Left Side Of Navbar -->
                <ul class="navbar-nav mr-auto"></ul>
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
                            <a class="nav-link" href="{{ url('/comprador') }}"> {{ __('Home Comprador') }} </a>
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->apellido  }}, {{ Auth::user()->nombre  }} <span class="caret"></span>
                                </a>
                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ url('/miperfil') }}"><img src="{{ url('image/usuario-hombre.png') }}" alt="Usuario" height="25"/><strong> {{ __('Ver mi perfil') }}</strong></a>
                                    <a class="dropdown-item" href="{{route('mispublicaciones')}}"><img src="{{ url('image/volver.png') }}" alt="Volver" height="25"/><strong> {{ __('Pasar a Vendedor') }}</strong></a>
                                    <a class="dropdown-item" href="{{ url('/mibilleteravirtual') }}"><img src="{{ url('image/cartera.png') }}" alt="Cartera" height="25"/><strong> {{ __('Billetera Virtual') }}</strong></a>
                                    <a class="dropdown-item" href="{{ url('/comprador/historialdecompras') }}"><img src="{{ url('image/historialcompras.png') }}" alt="Logout" height="25"/><strong> {{ __('Historial de Compras') }}</strong></a>
                                    <a class="dropdown-item" href="{{ route('billetera.canjearpuntos') }}"><img src="{{ url('image/canjearpuntaje.png') }}" alt="Logout" height="25"/><strong> {{ __('Canjear Puntaje') }}</strong></a>
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
    <footer class="card-footer text-muted">

      <!-- Copyright -->
      <div class="footer-copyright text-center py-3">© 2019 Copyright:
        <a href="https://drive.google.com/drive/folders/1lYCnjmEXU-1zWlJRibpvkBOAG_mhnbPn"> Drive - Grupo 01 </a>
      </div>
      <!-- Copyright -->

    </footer>

    <!-- JS Bootstrap -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>
</html>
