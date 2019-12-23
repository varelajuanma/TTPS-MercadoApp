<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PerfilesController extends Controller{


    public function __construct() {
        $this->middleware('auth')->except('index');
    }



    public function index($userId){
        $user= User::findOrFail($userId);
        $userLogueado = Auth::user();   //si no hay logueado retorna null sin provocar error
        if ($userLogueado != null && $userLogueado->id == $user->id) {
        	return redirect()->route('miperfil');
        }

        return view('perfiles.index', [
            'user'=> $user]);
    }


    public function miperfil(){
      $user= Auth::user();

      return view('perfiles/miperfil', ['user'=>$user
         ]);
    }

    public function editarmiperfil(){
      $user= Auth::user();

      return view('perfiles/editarmiperfil', ['user'=>$user

          ]);
    }


    public function guardarmodificacion(){

        $data = request()->validate([
            'nombre'=>'required',
            'apellido'=>'required',
            'fechadenacimiento'=>'required',
            ]);

        Auth::user()->update([
            'nombre'=>$data['nombre'],
            'apellido'=>$data['apellido'],
            'fechadenacimiento'=>$data['fechadenacimiento'],
        ]);

      return redirect("/miperfil")->with([
        'mensaje' => 'Se modificaron los datos correctamente',
        'tipoMensaje' => 'success']);
    }




}
