<?php

namespace App\Http\Controllers;

use App\Publicacion;
use App\User;
use App\Carrito;
use App\Compra;
use App\IngresoRetiro;
use App\Configuracion;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class CarritoController extends Controller {

	public function vercarrito() {
    	$id= Auth::id();
    	$conflictos = false;
    	$carrito = Carrito::where('user_id', $id)->get();
    	$precio = 0;
      foreach ($carrito as $elem) {
       	  $precio = $precio + $elem->calcularPrecio();
      }
      if (Auth::check()) {
        return view('vercarrito', [
            'id' => $id,
            'carrito' => $carrito,
            'precio' => $precio,
            'conflictos' => $conflictos,
          ]);
      }
      else {
        return redirect('/')->with(['error' => 'Debes REGISTRARTE o INICIAR SESIÓN para esta operación']);
      }
    }


    public function agregaralcarrito(Request $request) {

    	//validar que el user no se compre a si mismo (esta en el frontend, aunque deberia estar aca tambien)
    	$user = Auth::user();
      $id = Auth::id();
    	$data = $request->validate([
    		'publicacion' => 'required',
    		'cantidad' => 'required']);		//agregarle min:1|max:$stock entre comillas dobles, y sino validar en el front end y fue
    	$publicacion = Publicacion::findOrFail($data['publicacion']);
    	$stock = $publicacion->stock;

    	//si la publi ya esta en el carrito la elimino
    	$carrito = Carrito::where('user_id', $id)->where('publicacion_id', $publicacion->id)->get();
    	foreach ($carrito as $elem) {
        	$elem->delete();
      	}

      if (Auth::check()) {
       	$carrito = new Carrito();
       	$carrito->user_id = $id;
       	$carrito->publicacion_id = $publicacion->id;
       	$carrito->cantidad = $data['cantidad'];
    	  $carrito->save();
      	return redirect()->route('vercarrito');
      }
      else {
        return redirect('/')->with(['error' => 'Debes REGISTRARTE o INICIAR SESIÓN para esta operación']);
      }

    }

    public function eliminardelcarrito(Request $request) {
    	$data = $request->validate(['carrito' => 'required']);
    	$carrito = Carrito::findOrFail($data['carrito']);
    	$carrito->delete();
    	return redirect()->route('vercarrito');
    }

    public function vaciarcarrito(){
      $user = Auth::user();
      $carrito = Carrito::where('user_id', $user->id)->get();
      foreach ($carrito as $elem) {
          $elem->delete();
        }
        return redirect()->route('vercarrito');
    }




    public function comprar() {

      $configuraciones = Configuracion::findOrFail(1);
    	$user = Auth::user();
      $dueño = User::find(999);
      $carrito = Carrito::where('user_id', $user->id)->get();
      if ($carrito->count() == 0) {
        return redirect()->route('vercarrito')->with([
          'mensaje' => 'Tu carrito estaba vacio, no se realizo ninguna compra',
          'tipomensaje' => 'warning']);
      }

      $importe= 0;

      foreach ($carrito as $elem) {
          //return $elem->vendedor();

          if(!$elem->suficienteStock()) {
              return redirect()->route('vercarrito')->with([
              'mensaje' => 'Una publicacion no cuenta con suficiente stock por lo que no se pudo realizar la compra.',
              'tipomensaje' => 'danger']);
          }

          if ($elem->estaInactiva()) {
            return redirect()->route('vercarrito')->with([
              'mensaje' => 'Una publicacion en tu carrito esta inactiva por lo que no se pudo realizar la compra.',
              'tipomensaje' => 'danger']);
          }

          $importe = $importe + $elem->calcularPrecio();
          $categoriaultimo = $elem->publicacion()->first()->producto()->first()->categoria_id;
      }

      $puntajeObtenido = $importe / $configuraciones['cantidad_pesos_por_punto'];

      if($importe > $user->saldo) {
          return redirect()->route('vercarrito')->with([
              'mensaje' => 'No tenes suficiente saldo para realizar la compra.',
              'tipomensaje' => 'danger']);
      }



      DB::transaction(function()  use($user, $carrito, $configuraciones, $puntajeObtenido, $dueño){

          foreach ($carrito as $elem) {
              $precioItem = $elem->calcularPrecio();
              $comision = $precioItem * $configuraciones['porcentaje_comision'] / 100 ;
              $compra = Compra::instanciarCompra($elem, $user);
              $compra->save();
              $user->saldo = $user->saldo - $precioItem;
              $user->save();  //idealmente el save deberia estar afuera del loop
              $vendedor = $elem->vendedor();
              $vendedor->saldo = $vendedor->saldo + ($precioItem - $comision);
              $vendedor->save();
              $publicacion = $elem->publicacion()->first();
              $publicacion->stock = $publicacion->stock - $elem->cantidad;
              if ($publicacion->stock == 0){
                $publicacion->estado_id = 3;
              }
              $publicacion->save();
              $dueño->saldo = $dueño->saldo + $comision;
              $dueño->save();
              ingresoRetiro::crearTransaccion($user->id, -$precioItem, 3, $compra->id)->save(); //transaccion del comprador
              ingresoRetiro::crearTransaccion($vendedor->id, $precioItem - $comision, 4, $compra->id)->save(); //transaccion del vendedor
              ingresoRetiro::crearTransaccion(999, $comision, 1, $compra->id)->save(); //transaccion del dueño

          }

          $user->puntaje = $user->puntaje + $puntajeObtenido;
          $user->save();
          $this->vaciarcarrito();

     });


      return redirect()->route('vercarrito')->with([
        'mensaje' => 'Tu compra fue realizada exitosamente.',
        'tipomensaje' => 'success']);


    }

}
