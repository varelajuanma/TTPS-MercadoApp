<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\User;
use App\IngresoRetiro;
use App\Configuracion;

class BilleteraController extends Controller {

    public function __construct() {
        $this->middleware('auth');
    }


    public function mibilleteravirtual(){
        $user= Auth::user();
        return view('billetera.mibilleteravirtual', [
            'user'=> $user,
            ]);

    }

    public function ingresar(){
        $data= request()->validate(['saldo'=>'required']);
        if($data['saldo'] < 0) {
          return back()->with([
            'mensaje' => 'El numero ingresado debe ser positivo',
            'tipoMensaje' => 'warning']);
        }

        $user= Auth::user();
        $user->saldo = $user->saldo + $data['saldo'];
        $transaccion = new IngresoRetiro();
        $transaccion->user_id = $user->id;
        $transaccion->monto = $data['saldo'];
        $transaccion->tipo = 1;

        DB::transaction(function()  use($user, $transaccion){
          $user->save();
          $transaccion->save();
        });

        return back()->with([
          'mensaje' => 'Se ingresó el dinero correctamente',
          'tipoMensaje' => 'success']);
    }

     public function retirar(){
        $data= request()->validate(['saldo'=>'required']);
        $user= Auth::user();
        if($data['saldo'] < 0) {
          return back()->with([
            'mensaje' => 'El numero ingresado debe ser positivo',
            'tipoMensaje' => 'warning']);
        }

        if($user->saldo - $data['saldo'] < 0) {
          return back()->with([
            'mensaje' => 'No puede retirar esa cantidad ingresada ya que supera su saldo total',
            'tipoMensaje' => 'warning']);
        }
        else {
          $user->saldo = $user->saldo - $data['saldo'];
          $transaccion = new ingresoRetiro();
          $transaccion->user_id = $user->id;
          $transaccion->monto = - $data['saldo'];
          $transaccion->tipo = 5;

         DB::transaction(function()  use($user, $transaccion){
            $user->save();
            $transaccion->save();
         });

          return back()->with([
            'mensaje' => 'Se retiró el dinero correctamente',
            'tipoMensaje' => 'success']);
        }
    }



    public function canjearpuntos() {
      $user= Auth::user();
      $configuraciones = Configuracion::findOrFail(1);
      $proporcion = $configuraciones->cantidad_pesos_por_punto;
      return view('billetera.canjearpuntos', ['user' => $user, 'proporcion' => $proporcion ]);
    }

    public function efectuarcanje(){
      $data= request()->validate(['puntos'=>'required']);
      $user= Auth::user();
      $configuraciones = Configuracion::findOrFail(1);
      $proporcion = $configuraciones->cantidad_pesos_por_punto;

      if($data['puntos'] % $proporcion != 0 ) {
        return back()->with(['mensaje' => "La cantidad de puntos a canjear debe ser multiplo de $proporcion.",
        'tipomensaje' => 'warning']);
      }

      if ($data['puntos'] > $user->puntaje) {
        return back()->with(['mensaje' => 'No tenes suficientes puntos para realizar el canje.',
          'tipomensaje' => 'warning']);
      }
      $dineroobtenido = $data['puntos'] / $proporcion;
      $user->saldo= $user->saldo + $dineroobtenido;
      $user->puntaje = $user->puntaje - $data['puntos'];
      $transaccion = new ingresoRetiro();
      $transaccion->user_id = $user->id;
      $transaccion->monto = $dineroobtenido;
      $transaccion->tipo = 2; //indica que es un canje

      DB::transaction(function()  use($user, $transaccion){
          $user->save();
          $transaccion->save();
      });
      return back()->with(['mensaje' => "Se han canjeado tus puntos exitosamente. Disfruta tus nuevos  \${$dineroobtenido}",
        'tipomensaje' => 'success']);
    }

}
