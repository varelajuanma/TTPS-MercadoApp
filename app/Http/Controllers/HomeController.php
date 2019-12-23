<?php

namespace App\Http\Controllers;

use App\Categoria;
use App\Publicacion;
use App\Producto;
use App\User;
use App\Carrito;
use Illuminate\Support\Facades\Auth;
use Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct() {
        $this->middleware('auth')->except('comprador', 'index');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */



    public function index() {
       return redirect()->route("home.comprador");
    }

    public function comprador(){

      $publicaciones= Publicacion::all()->where('estado_id', 1);
      $user = Auth::user();
      $sugerenciasporcategoria = false;
      
      if (!is_null($user) && !is_null($user->categoria_ultimo_producto)) {//si hay user logueado y tiene alguna compra busca las publis de esa categoria
          $categoria = Categoria::find($user->categoria_ultimo_producto);
          $temp = $categoria->publicaciones()->where('estado_id', 1)->get();
         if ($temp->count() > 0 ) { //pero solo me quedo con esas publis si la categoria tiene al menos una publicacion
            $sugerenciasporcategoria = true;
            $publicaciones = $temp;
          }
      }

      $publicaciones= $publicaciones->sortByDesc(function ($elem, $key) {
        return ($elem->cantidadVentas());
       });
   
      $publicaciones = $publicaciones->take(10);


        return view('comprador', [
          'sugerenciasporcategoria' => $sugerenciasporcategoria,
          'publicaciones'=> $publicaciones->paginate(10),
          'es_busqueda' => false,
          '']);
    }


        public function misPublicaciones(){

            $user= Auth::user();
            $publicaciones = $user->publicaciones;
            return view('vendedor.mispublicaciones', [
                'user'=>$user,
                'vista' => 'todas',
                'publicaciones'=>$publicaciones->paginate(6),
                ]);
        }

        public function misPublicacionesInactivas(){

            $user= Auth::user();
            $publicaciones = $user->publicaciones->where('estado_id', 2);
            return view('vendedor.mispublicaciones', [
                'user'=>$user,
                'vista' => 'inactivas',
                'publicaciones'=>$publicaciones->paginate(6),
                ]);
        }

        public function misPublicacionesSinStock(){

            $user= Auth::user();
            $publicaciones = $user->publicaciones->where('estado_id', 3);
            return view('vendedor.mispublicaciones', [
                'user'=>$user,
                'vista' => 'sinstock',
                'publicaciones'=>$publicaciones->paginate(6),
                ]);
        }



    public function vendedor(){

        return redirect()->route('mispublicaciones');

    }

}
