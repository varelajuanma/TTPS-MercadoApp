<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\User;
use App\Publicacion;


class PreciosController extends Controller {
	

	public function __construct() {
        $this->middleware('auth');
    }

	public function paneldegestiondeprecios(){
    	$user= Auth::user();	
		return view('vendedor.paneldegestiondeprecios', ['user'=>$user]);
	}


	public function setearTipoDePrecio (Request $request) {
		$user= Auth::user();
		$data = request()->validate(['precio'=>'required']);
		
		if($data['precio'] == $user->precio_asignado) {
			return back()->with([
				'mensaje' => 'El precio ingresado ya estaba actualmente seleccionado. No se realizaron modificaciones',
				'tipoMensaje' => 'warning']);
		}
		else {
			$user->precio_asignado = $data['precio'];
			$user->save();
			return back()->with([
				'mensaje' => 'Los precios de tus publicaciones fueron modificados',
				'tipoMensaje' => 'success']);
		}
	}
	

	public function aumentarPrecios (Request $request) {

	
		$data= request()->validate(['aumento'=>'required']);
		$aumento= $data['aumento']; 
	
		if($aumento < 0) {
			return back()->with([
			'mensaje' =>  "El numero ingresado debe ser positivo" ,
			'tipoMensaje' => 'danger']);
		}

		$user= Auth::user();
		$publicaciones= Publicacion::where('user_id', $user->id)->get(); 

		foreach ($publicaciones as $publicacion) {
			$publicacion->precio_base = $publicacion->precio_base + $publicacion->precio_base * $aumento / 100;
			$publicacion->precio_max = $publicacion->precio_max + $publicacion->precio_max * $aumento / 100;
			$publicacion->precio_min = $publicacion->precio_min + $publicacion->precio_min * $aumento / 100;
			$publicacion->save();
		}

		return back()->with([
			'mensaje' =>  "Se aumentaron los precios de tus publicaciones en un {$aumento}%" ,
			'tipoMensaje' => 'info']);
		
	}



	public function disminuirPrecios (Request $request) {

		$data= request()->validate(['descuento'=>'required']);
		$descuento= $data['descuento']; 

		if($descuento < 0) {
			return back()->with([
			'mensaje' =>  "El numero ingresado debe ser positivo" ,
			'tipoMensaje' => 'danger']);
		}

		$user= Auth::user();
		$publicaciones= Publicacion::where('user_id', $user->id)->get(); 

		foreach ($publicaciones as $publicacion) {
			$publicacion->precio_base = $publicacion->precio_base - $publicacion->precio_base * $descuento / 100;
			$publicacion->precio_max = $publicacion->precio_max - $publicacion->precio_max * $descuento / 100;
			$publicacion->precio_min = $publicacion->precio_min - $publicacion->precio_min * $descuento / 100;
			$publicacion->save();
		}

		return back()->with([
			'mensaje' =>  "Se disminuyeron los precios de tus publicaciones en un {$descuento}%" ,
			'tipoMensaje' => 'info']);
		
	}

}
