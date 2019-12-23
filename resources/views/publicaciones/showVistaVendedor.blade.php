@extends('layouts.vendedor')


@section('content')
<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-8">
      <div class="card">
        <div class="card-header" style="color:black">
          <img src="{{ url('image/publicacion.png') }}" alt="Mi Publicacion" height="25"/><strong> Publicación </strong>
        </div>
        <div class="card-body">
          <div id="demo" class="carousel slide" data-ride="carousel">
          <!-- Indicators -->
            <ul class="carousel-indicators">
              <li data-target="#demo" data-slide-to="0" class="active"></li>
              <li data-target="#demo" data-slide-to="1"></li>
              <li data-target="#demo" data-slide-to="2"></li>
            </ul>
           <!-- The slideshow -->
            <div class="carousel-inner">
              <div class="carousel-item active">
                <img src="{{ $publicacion->imagenMuestra()}}" alt="Los Angeles">
              </div>
           @foreach($publicacion->imagenes as $imagen)
              @if ($loop->first) @continue @endif
                <div class="carousel-item">
                  <img src="{{url('/storage/' . $imagen->path)}}" alt="Los Angeles">
                </div>
           @endforeach
           </div>
          <!-- Left and right controls -->
          <a class="carousel-control-prev" href="#demo" data-slide="prev">
            <span class="carousel-control-prev-icon"></span>
          </a>
          <a class="carousel-control-next" href="#demo" data-slide="next">
            <span class="carousel-control-next-icon"></span>
          </a>
         </div>
          <u><strong>Título:</strong></u> {{$publicacion->nombre}} <br>
          <u><strong>Descripción:</strong></u> {{$publicacion->descripcion}} <br>
          <u><strong>Vendedor:</strong></u> <a href="/perfiles/{{ $vendedor->id }}"> {{$vendedor->nombre}} {{$vendedor->apellido}} </a><br>
          <u><strong>Stock:</strong></u> {{$publicacion->stock}} unidades disponibles<br>
          <u><strong>Unidades vendidas:</strong></u> {{$publicacion->cantidadUnidadesVendidas()}}<br>
          <u><strong>Precio:</strong></u> ${{$publicacion->precioActualFormateado()}} <br><br>


          <a href="/vendedor/historialdeventas/{{$publicacion->id}}" style="color: white;" class="btn btn-primary"> Ver historial de ventas </a>
          <a href="/publicaciones/{{ $publicacion->id }}/edit" style="color: white;" class="btn btn-primary"> Editar </a>

        </div>
      </div>
      <br>
      <form form action="" method="POST">
        <button type="submit" class="btn btn-primary" disabled>Agregar al carrito</button>
        <input type="number" min="1" name="cantidad" value=1> Unidad/es
      </form>
      <br>

      <div class="card">
        <div class="card-header" style="color:black">
          <strong> Calificaciones </strong>
          <span style="float:right"><strong> Calificación promedio:</strong> {{ $publicacion->calificacionPromedioFormateada() }} </span>
        </div>
          @if($calificaciones->isEmpty())
          <div class="card-body">
                  <i> Esta publicación aun no tiene calificaciones. </i>
          </div>
          @endif
          <ul class="list-group list-group-flush">
        @foreach ($calificaciones as $calificacion)


            <li class="list-group-item">
              <u><strong>Calificador:</strong></u> {{ $calificacion->usuario()->first()->nombreCompleto() }} <br>
              <u><strong>Puntaje:</strong></u> {{ $calificacion->puntuacionFormateada() }} <br>
              <u><strong>Opinión:</strong></u> {{ $calificacion->comentario }} <br>
            </li>
        @endforeach
            <li class="list-group-item">
              <u><strong>Nube de palabras</strong></u>
            @if(count($palabrasParaNube) > 0)
                <div id="word-cloud"></div>
            @else
                <div>
                  <i>No se encontraron palabras para incluir en la nube</i>
                </div>
            @endif
            </li>
          </ul>

      </div>

    <br>
    <a class="btn btn-primary" onclick="goBack()" role="button" style="color:black">Volver</a>
    </div>
  </div>
</div>
<script>
    /*  ======================= SETUP ======================= */
    var config = {
        trace: true,
        spiralResolution: 1, //Lower = better resolution
        spiralLimit: 360 * 5,
        lineHeight: 0.8,
        xWordPadding: 0,
        yWordPadding: 3,
        font: "sans-serif"
    }

    var words = [{!! '"' . implode('", "', $palabrasParaNube) . '"'
       !!} ].map(function(word) {
        return {
            word: word,
            freq: Math.floor(Math.random() * 50) + 10
        }
    })

    words.sort(function(a, b) {
        return -1 * (a.freq - b.freq);
    });

    var cloud = document.getElementById("word-cloud");
    cloud.style.position = "relative";
    cloud.style.fontFamily = config.font;

    var traceCanvas = document.createElement("canvas");
    traceCanvas.width = cloud.offsetWidth;
    traceCanvas.height = cloud.offsetHeight;
    var traceCanvasCtx = traceCanvas.getContext("2d");
    cloud.appendChild(traceCanvas);

    var startPoint = {
        x: cloud.offsetWidth / 2,
        y: cloud.offsetHeight / 2
    };

    var wordsDown = [];
    /* ======================= END SETUP ======================= */





    /* =======================  PLACEMENT FUNCTIONS =======================  */
    function createWordObject(word, freq) {
        var wordContainer = document.createElement("div");
        wordContainer.style.position = "absolute";
        wordContainer.style.fontSize = freq + "px";
        wordContainer.style.lineHeight = config.lineHeight;
        /*    wordContainer.style.transform = "translateX(-50%) translateY(-50%)";*/
        wordContainer.appendChild(document.createTextNode(word));

        return wordContainer;
    }

    function placeWord(word, x, y) {

        cloud.appendChild(word);
        word.style.left = x - word.offsetWidth/2 + "px";
        word.style.top = y - word.offsetHeight/2 + "px";

        wordsDown.push(word.getBoundingClientRect());
    }

    function trace(x, y) {
//     traceCanvasCtx.lineTo(x, y);
//     traceCanvasCtx.stroke();
        traceCanvasCtx.fillRect(x, y, 1, 1);
    }

    function spiral(i, callback) {
        angle = config.spiralResolution * i;
        x = (1 + angle) * Math.cos(angle);
        y = (1 + angle) * Math.sin(angle);
        return callback ? callback() : null;
    }

    function intersect(word, x, y) {
        cloud.appendChild(word);

        word.style.left = x - word.offsetWidth/2 + "px";
        word.style.top = y - word.offsetHeight/2 + "px";

        var currentWord = word.getBoundingClientRect();

        cloud.removeChild(word);

        for(var i = 0; i < wordsDown.length; i+=1){
            var comparisonWord = wordsDown[i];

            if(!(currentWord.right + config.xWordPadding < comparisonWord.left - config.xWordPadding ||
                currentWord.left - config.xWordPadding > comparisonWord.right + config.wXordPadding ||
                currentWord.bottom + config.yWordPadding < comparisonWord.top - config.yWordPadding ||
                currentWord.top - config.yWordPadding > comparisonWord.bottom + config.yWordPadding)){

                return true;
            }
        }

        return false;
    }
    /* =======================  END PLACEMENT FUNCTIONS =======================  */





    /* =======================  LETS GO! =======================  */
    (function placeWords() {
        for (var i = 0; i < words.length; i += 1) {

            var word = createWordObject(words[i].word, words[i].freq);

            for (var j = 0; j < config.spiralLimit; j++) {
                //If the spiral function returns true, we've placed the word down and can break from the j loop
                if (spiral(j, function() {
                    if (!intersect(word, startPoint.x + x, startPoint.y + y)) {
                        placeWord(word, startPoint.x + x, startPoint.y + y);
                        return true;
                    }
                })) {
                    break;
                }
            }
        }
    })();
    /* ======================= WHEW. THAT WAS FUN. We should do that again sometime ... ======================= */



    /* =======================  Draw the placement spiral if trace lines is on ======================= */
    (function traceSpiral() {

        traceCanvasCtx.beginPath();

        if (config.trace) {
            var frame = 1;

            function animate() {
                spiral(frame, function() {
                    trace(startPoint.x + x, startPoint.y + y);
                });

                frame += 1;

                if (frame < config.spiralLimit) {
                    window.requestAnimationFrame(animate);
                }
            }


        }
    })();


</script>

@endsection
