<?php

namespace App\Http\Controllers;


use App\Categoria;
use App\Publicacion;
use App\Compra;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ReportesController extends Controller {

	public function __construct() {
        $this->middleware('auth');
    }

    public function show(){

    	$user = Auth::user();
    	return view('reportes/show', [
    	    'user' => $user]);
    }


    public function porpublicacion(){
		    $user = Auth::user();
			//$datosCol= Compra::where('user_vendedor_id', $user->id)->groupBy('publicacion_id')->get();	//casi logrado con eloquent
		
			$publicacionesArray = [];
			$datosArray = [];
			$datos = DB::table('compras')
             ->select('publicacion_id', DB::raw('sum(precio_unitario * cantidad) as total, count(*) as cantidadVentas '))
             ->where('user_vendedor_id', $user->id)
             ->groupBy('publicacion_id')
             ->orderBy('total', 'desc')
             ->get();

			foreach ($datos as $venta){
				$publicacion = Publicacion::find($venta->publicacion_id);
				array_push($datosArray, $venta->total);
				array_push($publicacionesArray, "$publicacion->nombre ($venta->cantidadVentas ventas)" );
			}
		
	        
	    	return view('reportes/porpublicacion', [
				'user' => $user,
				'publicacionesArray' => $publicacionesArray,
				'datosArray' => $datosArray
			]);
    }

    public function porcomprador(){
	    	
	  		$user = Auth::user();
			$compradoresArray = [];
			$datosArray = [];
			$datos = DB::table('compras')
	        ->select('user_comprador_id', DB::raw('sum(precio_unitario * cantidad) as total, count(*) as cantidadVentas '))
	        ->where('user_vendedor_id', $user->id)
            ->groupBy('user_comprador_id')
            ->orderBy('total', 'desc')
            ->get();

      		foreach ($datos as $venta){
				$comprador = User::find($venta->user_comprador_id);
				array_push($datosArray, $venta->total);
				array_push($compradoresArray, "$comprador->nombre $comprador->apellido ($venta->cantidadVentas ventas)" );
			}
		
	    	return view('reportes/porcomprador', [
	            'user' => $user,
				'compradoresArray' => $compradoresArray,
				'datosArray' => $datosArray
			]);
    }

	public function porcategoria(){
		$user = Auth::user();
		$categoriasArray = [];
		$datosArray = [];

		$datos = DB::table('compras')
		->join('publicaciones', 'compras.publicacion_id', '=', 'publicaciones.id')
		->join('productos', 'publicaciones.producto_id', '=', 'productos.id')
		->join('categorias', 'productos.categoria_id', '=', 'categorias.id')
		->select('categorias.nombre', DB::raw('sum(precio_unitario * cantidad) as total, count(*) as cantidadVentas '))
		->where('user_vendedor_id', $user->id)
        ->groupBy('categorias.nombre')
        ->orderBy('total', 'desc')
		->get();

		foreach ($datos as $venta){
			array_push($datosArray, "$venta->total");
			array_push($categoriasArray, "$venta->nombre ($venta->cantidadVentas ventas)" );
		}


	    return view('reportes/porcategoria', [
	        'user' => $user,
	        'categoriasArray' => $categoriasArray,
			'datosArray' => $datosArray
	    ]);
    }

}
