<?php

namespace App\Http\Controllers;

use App\Categoria;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\User;
use App\Publicacion;

class HistorialesController extends Controller{


   public function __construct() {
        $this->middleware('auth');
    }

  public function showhistorialdecompras(){

      $user= Auth::user();
      $categorias= Categoria::all();
      $compras = $user->compras()->get();

      return view('historiales.compras', [
        'user'=> $user,
        'compras' => $compras,
        'categorias' => $categorias]);

  }

  public function showhistorialdeventas($publicacion_id){
  
    $publicacion= Publicacion::findOrFail($publicacion_id);
    if (Auth::user()->id != $publicacion->user_id) {//evito acceso sin permisos (si intenta editando la URL a mano)
      return redirect()->route('mispublicaciones');
    } 
    
    $compras= $publicacion->compras()
        ->orderBy('created_at', 'desc')
        ->get();

    return view('historiales.ventas', ['publicacion' => $publicacion, 'compras' => $compras]);
  
  }


  public function showhistorialdetransacciones(){
      $user= Auth::user();
      $transacciones = $user->transacciones()->get();
      return view('historiales.transacciones', [
        'user'=> $user,
        'transacciones' => $transacciones]);

  }



}

