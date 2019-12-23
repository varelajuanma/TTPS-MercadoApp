<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class IngresoRetiro extends Model {

	protected $guarded =[];
    protected $table = 'ingreso_retiros';

    public function user(){
    	return $this->belongsTo(User::class);
    }

    public static function crearTransaccion($userid, $monto, $tipoid, $compraid) { //idealmente esto deberia ser un constructor
    	$transaccion = new ingresoRetiro();
        $transaccion->user_id = $userid;
        $transaccion->monto = $monto;
        $transaccion->tipo = $tipoid;
        $transaccion->compra_id = $compraid;
        return $transaccion;
    }

    public function compra(){
        return $this->belongsTo(Compra::class);
    }

    public function tipoFormateado () {
    	switch($this->tipo) {
        case(1):
            $tipo= '(Ingreso de fondos)';
            break;
        case(2):
            $tipo= '(Canje de puntos)';
            break;
        case(3):
            $tipo= '(Compra)';
            break;
        case(4):
            $tipo= '(Venta)';
            break;
         default:
         	$tipo= '(Retiro de fondos)';
        }
        return $tipo;
    }


}
