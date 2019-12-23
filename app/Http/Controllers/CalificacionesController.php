<?php

namespace App\Http\Controllers;

use App\Publicacion;
use App\CalificacionPublicacion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CalificacionesController extends Controller {
       
	public function __construct() {
        $this->middleware('auth');
    }

    public function calificarpublicacion ($id){
    	$user = Auth::user();
    	$publicacion = Publicacion::findOrFail($id);
    	$calificacion = $publicacion->calificacion($user);
    	
    	return view('calificarpublicacion', [
        	'publicacion'=> $publicacion,
            'calificacion' => $calificacion //puede ser Null
         ]);
    }

    

    public function store ($publicacionid) {
    	$publicacion = Publicacion::findOrFail($publicacionid);
    	$user = Auth::user();
    	if ($publicacion->calificacion($user) != null) {
    		return back()->with([
    		'mensaje' => 'Ya calificaste esta publicación',
    		'tipoMensaje' => 'warning']);
    	}
    	$data = request()->validate(['puntuacion'=>'required', 'comentario' => 'required']);
    	$calificacion = new CalificacionPublicacion();
    	$calificacion->user_id = $user->id;
    	$calificacion->publicacion_id = $publicacionid;
    	$calificacion->puntuacion = $data['puntuacion'];
    	$calificacion->comentario = $data['comentario'];
    	$calificacion->save();
    	$publicacion->user()->first()->actualizarReputacion();
    	return back()->with([
    		'mensaje' => 'Tu calificación fue registrada correctamente',
    		'tipoMensaje' => 'success']);
    }
    


}
