<?php

namespace App\Http\Controllers;

use App\Producto;
use App\Publicacion;
use App\Imagen;
use App\User;
use App\Configuracion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class PublicacionController extends Controller
{
        public function __construct() {

            $this->middleware('auth')->except('show', 'buscar', 'filtrar', 'ordenar');
        }

        public function palabrasParaNube($calificaciones){
            $listadoPalabras = Configuracion::first()->palabras;
            $listadoPalabras= explode(" - ",$listadoPalabras);

            $comentarios= [];
            foreach ($calificaciones as $calificacion){
                $palabrascomentario = $calificacion->comentario;
                $palabrascomentario = str_ireplace(".", "", $palabrascomentario);
                $palabrascomentario = str_ireplace(",", "", $palabrascomentario);
                $palabrascomentario = str_ireplace(";", "", $palabrascomentario);
                $palabrascomentario = explode(" ",$palabrascomentario);
                foreach ($palabrascomentario as $palabra){
                    array_push($comentarios, $palabra);
                }

            }


            return array_intersect($listadoPalabras, $comentarios);
        }
        public function show($id){
            $publicacion= Publicacion::findOrFail($id);
            $vendedor= User::findOrFail($publicacion->user_id);
            $configuraciones = Configuracion::findOrFail(1);
            $calificaciones = $publicacion->calificaciones()->take($configuraciones->cantidad_opiniones)->get();
            $userLogueado = Auth::user();


            if ($userLogueado != null && $userLogueado->id == $vendedor->id) {  //si el vendedor visita su publicacion en vista comprador lo paso directo a vista vendedor de su publicacion.
            //esto podria llegar a evitarse si se impidiera al momento de efectuar una compra que un user se compre a si mismo
                return redirect("/vendedor/publicaciones/$id");
            }
            else {
                if($publicacion->estado_id == 2) {//si esta inactiva y no es el dueño lo redirecciono
                    return redirect('/comprador')->with(['error' => 'La publicación que intentas acceder fue desactivada por su vendedor']);
                }
            }

            return view('publicaciones.show', [
                'publicacion'=> $publicacion,
                'vendedor' => $vendedor,
                'calificaciones' => $calificaciones,
                'palabrasParaNube' => $this->palabrasParaNube($calificaciones)]);
        }


        public function showVistaVendedor($id){
            $publicacion= Publicacion::findOrFail($id);
            $vendedor= User::findOrFail($publicacion->user_id);

            if (Auth::user()->id != $vendedor->id) {
                return redirect("/home");
            }

            $configuraciones = Configuracion::findOrFail(1);
            $calificaciones = $publicacion->calificaciones()->take($configuraciones->cantidad_opiniones)->get();
            $listadoPalabras = Configuracion::first()->palabras;
            $listadoPalabras= explode(" - ",$listadoPalabras);
            $comentarios= [];
            foreach ($calificaciones as $calificacion){
                $palabrascomentario = explode(" ",$calificacion->comentario);
                foreach ($palabrascomentario as $palabra){
                    array_push($comentarios, $palabra);
                }

            }

            $palabrasParaNube = array_intersect($listadoPalabras, $comentarios);
            return view('publicaciones.showVistaVendedor',[
                'publicacion'=> $publicacion,
                'vendedor' => $vendedor,
                'calificaciones' => $calificaciones,
                'palabrasParaNube' => $this->palabrasParaNube($calificaciones)
                ]);
        }


        public function create(){
            $productos = Producto::all();
            return view('publicaciones.create',[
            'productos'=> $productos]);
        }

        public function edit($publicacionId) {

         $publicacion= publicacion::findOrFail($publicacionId);
         $vendedor = $publicacion->user;


        if (Auth::user()->id != $vendedor->id) {
            return redirect("/home");
        }

         $productos= Producto::all();

            return view('publicaciones.edit', [
                'publicacion'=> $publicacion,
                'productos' => $productos]);
        }



        public function validarInput (){

            $data = request()->validate([
                    'nombre'=>'required',
                    'descripcion'=>'required',
                    'estado'=>'required',
                    'stock'=>'required',
                    'producto'=>'required',
                    'precio_min'=>'required',
                    'precio_base'=>'required',
                    'precio_max'=>'required',
                    'imagen1'=>['required_without_all:imagen2, imagen3, imagen4, imagen5','image'],
                    'imagen2'=>['nullable', 'image'],
                'imagen3'=>['nullable', 'image'],
                'imagen4'=>['nullable', 'image'],
                'imagen5'=>['nullable', 'image'],

                ]);
            return $data;
        }

    public function validarInputUpdate (){

        $data = request()->validate([
            'nombre'=>'required',
            'descripcion'=>'required',
            'estado'=>'required',
            'stock'=>'required',
            'producto'=>'required',
            'precio_min'=>'required',
            'precio_base'=>'required',
            'precio_max'=>'required',
            'imagen1'=>['nullable','image'],
            'imagen2'=>['nullable', 'image'],
            'imagen3'=>['nullable', 'image'],
            'imagen4'=>['nullable', 'image'],
            'imagen5'=>['nullable', 'image'],

        ]);
        return $data;
    }






        public function store(){

            $data = $this->validarInput();

            if ($data['precio_min'] > $data['precio_base']) {
                return back()->with('mensaje', 'El precio minimo debe ser menor o igual al precio base');
            }
            if ($data['precio_max'] < $data['precio_base']) {
                return back()->with('mensaje', 'el precio maximo debe ser mayor o igual al precio base');
            }


            $anterioresPublicaciones = Auth::user()->publicaciones()->get();
            foreach ($anterioresPublicaciones as $anterior) {
               if (strcmp($anterior->nombre, $data['nombre'] ) == 0) {
                    return back()->with('mensaje', 'No podes tener 2 publicaciones con el mismo nombre, cambia el nombre de alguna de ellas');
                }
                if ($anterior->producto_id == $data['producto']) {
                    return back()->with('mensaje', 'No podes tener 2 publicaciones asociadas al mismo producto. Si tenes un producto que no se encuentra en nuestra base de datos de productos ponete en contacto con nosotros');
                }
            }


            if ($data['stock'] == 0 && $data['estado'] == 1 ) { //si la quiere dejar activa pero no hay stock, se registra con estado= sin stock
                    $data['estado'] = 3;
            }







            $publicacion = Publicacion::create([
                    'user_id'=>Auth::user()->id,
                    'nombre'=>$data['nombre'],
                    'descripcion'=>$data['descripcion'],
                    'estado_id'=>$data['estado'],
                    'producto_id'=>$data['producto'],
                    'stock'=>$data['stock'],
                    'precio_min'=>$data['precio_min'],
                    'precio_base'=>$data['precio_base'],
                    'precio_max'=>$data['precio_max'],
                ]);

            for ($i = 1; $i <= 5; $i++){
                if (request('imagen'.$i) != null ){
                    $imagen= new Imagen([
                        'path'=>request('imagen'.$i)->store('uploads', 'public'),
                    ]);
                $publicacion->imagenes()->save($imagen);}

            }



            return redirect()->route('mispublicaciones');

        }


        public function update(Request $request, $publicacionId){



            $publicacion= publicacion::findOrFail($publicacionId);

            $data = $this->validarInputUpdate();


            if ($data['precio_min'] > $data['precio_base']) {
                return back()->with('mensaje', 'El precio minimo debe ser menor o igual al precio base');
            }
            if ($data['precio_max'] < $data['precio_base']) {
                return back()->with('mensaje', 'el precio maximo debe ser mayor o igual al precio base');
            }


            if ($data['stock'] == 0 && $data['estado'] == 1 ) { //si la quiere dejar activa pero no hay stock el estado es sin stock
                $data['estado'] = 3;
            }

            //faltaria hacer el chequeo para q no se repita nombre o producto aca. pero es mas complicado que en el store.

            $publicacion->update([
                'nombre'=>$data['nombre'],
                'descripcion'=>$data['descripcion'],
                'producto_id'=>$data['producto'],
                'stock'=>$data['stock'],
                'precio_min'=>$data['precio_min'],
                'precio_base'=>$data['precio_base'],
                'precio_max'=>$data['precio_max'],
                'estado_id'=>$data['estado']
            ]);

            for ($i = 1; $i <= 5; $i++) {
                if (request('imagen' . $i) != null) {
                    $imagenNueva = new Imagen(['path' => request('imagen' . $i)->store('uploads', 'public')]);
                    if ((request('idImagen' . $i)) != null) {
                        $imagen = Imagen::findOrFail(request('idImagen' . $i));
                        $imagen->path = $imagenNueva->path;
                        $imagen->save();
                    } else {

                        $imagen = new Imagen([
                            'path' => request('imagen' . ($i))->store('uploads', 'public'),
                        ]);
                        $publicacion->imagenes()->save($imagen);

                    }


                }

            }

            return redirect()->route('mispublicaciones')->with([
                'mensaje' => 'Se ha modificado tu publicación exitosamente.',
                'tipoMensaje' => 'success']);

        }


        public function habilitar($id){

            $publicacion= publicacion::findOrFail($id);
            if ($publicacion->stock > 0) {
                $publicacion->estado_id = 1;
            }
            else {
                $publicacion->estado_id = 3;
            }
            $publicacion->save();
            return redirect()->route('mispublicaciones')->with([
                'mensaje' => 'Hemos activado tu publicación, mientras cuente con stock sera visible para todos los demas usuarios.',
                'tipoMensaje' => 'success']);
        }


        public function deshabilitar($id){

            $publicacion= publicacion::findOrFail($id);
            $publicacion->estado_id = 2;
            $publicacion->save();
            return redirect()->route('mispublicaciones')->with([
                'mensaje' => 'Hemos desactivado tu publicación, ya no se podran realizar compras de ella ni sera visible para otros usuarios.',
                'tipoMensaje' => 'warning']);
        }



        public function buscar(){
         $str = request('busqueda');
         if ($str == '') {
            return redirect()->route('home.comprador')->with('error', 'Tenes que ingresar algun termino para poder realizar una busqueda');
         }
         $publicaciones = Publicacion::buscar($str);
         return view('comprador', [
             'publicaciones'=>$publicaciones->paginate(12),
             'str_busqueda'=>$str,
             'sugerenciasporcategoria' => false,
             'es_busqueda' => true
             ]);
        }

        public function filtrar(){
            $str_busqueda = request('str');
        if(request('cat') != null){

        $categoria_id = request('cat');

        $publicaciones = Publicacion::buscarxcategoria($str_busqueda, $categoria_id);

        }
        elseif (request('min') != null && request('max') != null){
            $rango_min = request('min');
            $rango_max = request('max');
            $publicaciones = Publicacion::buscarxrango($str_busqueda, $rango_min, $rango_max);
        }
            return view('comprador', [
                'publicaciones'=>$publicaciones->paginate(12),
                'str_busqueda'=>$str_busqueda,
                'sugerenciasporcategoria' => false,
                'es_busqueda' => true]);
        }
        public function ordenar(){
            $str_busqueda = request('str');
            $criterio = request('criterio');
            $publicaciones = Publicacion::buscar($str_busqueda);
            if($criterio == 'menor_mayor'){
            $publicaciones= $publicaciones->sortBy(function ($product, $key) {
                return ($product->precioActual());
            });

            }
            else{
                $publicaciones= $publicaciones->sortByDesc(function ($product, $key) {
                    return ($product->precioActual());
            });}
            return view('comprador', [
                'publicaciones'=>$publicaciones->paginate(12),
                'str_busqueda'=>$str_busqueda,
                'sugerenciasporcategoria' => false,
                'es_busqueda' => true]);
        }

        //este metodo funciona. pero se suponia que habia que hacer un borrado logico nomas
        public function destroy($publicacionId){
            $publicacion = publicacion::find($publicacionId);
            $destroy = publicacion::destroy($publicacionId);
            return redirect()->route('mispublicaciones');
        }

}
