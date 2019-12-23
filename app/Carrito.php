<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Carrito extends Model {
    protected $table= 'carritos';
    protected $guarded =[];


    /*
    public function __construct($userid, $publicacionid, $cantidad){
    	 parent::__construct();
    	 $this->user_id = $userid;
    	 $this->publicacion_id = $publicacionid;
    	 $this->cantidad = $cantidad;
    }
	*/

    public function usuario(){
        return $this->belongsTo(User::class);
    }

    public function publicacion(){
        return $this->belongsTo(Publicacion::class);
    }

    public function nombrepublicacion() {
    	return ($this->publicacion()->first()->nombre);
    }

    public function publicacionid(){
        return $this->publicacion()->first()->id;
    }
    

    public function stockdisponible(){
    	return ($this->publicacion()->first()->stock);
    }

    public function suficienteStock(){
        return ($this->cantidad <= $this->publicacion()->first()->stock);
    }

      public function precioUnitario() {
        return ($this->publicacion()->first()->precioActual()); 
    }

    public function calcularPrecio() {
    	return ($this->publicacion->precioActual() * $this->cantidad); //ESTA INVOCACION A PUBLICACION NO DEBERIA TENER PARENTESIS!!!
    }

    public function estaInactiva() {
        return ($this->publicacion()->first()->estado_id == 2);
    }

    public function vendedor(){
        return ($this->publicacion()->first()->user()->first());
    }


}
