<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Compra extends Model {

    protected $guarded =[];

    public function publicacion(){
        return $this->belongsTo(Publicacion::class);
    }

	
    public function uservendedor(){
        return $this->belongsTo(User::class,'user_vendedor_id');
    }
    
	public function usercomprador(){
        return $this->belongsTo(User::class,'user_comprador_id');
    }

    public function calificacionpublicacion(){
        return $this->belongsTo(CalificacionPublicacion::class); 
    }

    public function publicacionNombre(){
        return $this->publicacion()->first()->nombre;
    }

    public function userVendedorNombreCompleto(){
        $vendedor = $this->uservendedor()->first();
        return ($vendedor->nombre . " " . $vendedor->apellido);
    }
    
    public function userCompradorNombreCompleto(){
        $comprador = $this->usercomprador()->first();
        return ($comprador->nombre . " " . $comprador->apellido);
    }


    public static function instanciarCompra ($elem, $user) { //idealmente habria que usar un constructor
        $compra = new Compra(); 
        $compra->publicacion_id = $elem->publicacionid();
        $compra->cantidad = $elem->cantidad;
        $compra->precio_unitario = $elem->precioUnitario();
        $compra->user_comprador_id = $user->id;
        $compra->user_vendedor_id = $elem->vendedor()->id;
        return $compra;
    }


}
