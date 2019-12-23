<?php

namespace App;

use Illuminate\Database\Eloquent\Model;



class CalificacionPublicacion extends Model {

    protected $table= 'calificaciones_publicaciones';
    protected $guarded =[];

    public function publicacion(){
        return $this->belongsTo(Publicacion::class);
    }

    public function usuario(){
        return $this->belongsTo(User::class, 'user_id');
    }

    public function puntuacionFormateada(){
        if ($this->puntuacion != null) {
            $puntuacionFormateada = (number_format($this->puntuacion, 2, '.', ''));
            return ($puntuacionFormateada . ' de 5.00');
        }
        else {
            return ('Sin calificacion');
        }
    }


    /*
    public function calificacion($publicacion, $user) {

    	//la idea seria definir una funcion que si existe calificacion del user para esa publi la retorne, sino retorne algo vacio (accesible con la misma interfaz asi evitamos las validaciones afuera de esta clase)
    	//aunque tener esto cambiaria un poco el calculo del promedio, dejo la idea porque podria ser util.
    	//if () {

    	//}
    	else{
    		$vacia = new CalificacionPublicacion();
    		$vacia->$user;
    		$vacia->puntuacion=0;
    		$vacia->comentario='SIN CALIFICAR';
    		return $vacia;
    	}


    } 	*/

}
