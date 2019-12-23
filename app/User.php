<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'nombre', 'email', 'fechadenacimiento', 'apellido', 'password', 'saldo',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function publicaciones(){
        return $this->hasMany(Publicacion::class);
    }

    public function ingresoRetiro(){
        return $this->hasMany(IngresoRetiro::class);
    }


    /*
    public function calificacionesPublicaciones(){
        return $this->hasMany(CalificacionPublicacion::class);  //linkea con el comprador NO con el vendedor (asi q no se puede usar para obtener directo la reputacion)
    }*/

    public function calificacionesPublicaciones(){
        return $this->hasManyThrough(CalificacionPublicacion::class, Publicacion::class, 'user_id', 'publicacion_id');
   }


    public function compras(){
        return $this->hasMany(Compra::class, 'user_comprador_id');
    }

    public function ventas(){
        return $this->hasMany(Compra::class, 'user_vendedor_id');
    }

    public function cantidadCompras() {
        return $this->compras()->count();
    }

    public function cantidadVentas() {
        return $this->ventas()->count();
    }

    public function transacciones() {
        return $this->hasMany(IngresoRetiro::class);
    }



    public function precioAsignado () {
        switch($this->precio_asignado) {
        case(1):
            $precio= 'precio base';
            break;
        case(2):
            $precio= 'precio maximo';
            break;
        default:
            $precio= 'precio minimo';
        }
        return $precio;
    }


    public function actualizarReputacion(){
        $cant = $this->calificacionesPublicaciones()->count();
        $sum = $this->calificacionesPublicaciones()->sum('puntuacion');
        if ($cant == 0) {
            $this->reputacion = 0;
        }
        else {
            $this->reputacion = $sum / $cant;
        }
        $this->save();
    }

    //version rehaciendo el calculo en cada consulta (deberia ser reemplazada por la que usa el atributo user->reputacion)

    public function reputacionFormateada(){
        $publicaciones = $this->publicaciones()->get();

        $cant = $this->calificacionesPublicaciones()->count();
        $sum = $this->calificacionesPublicaciones()->sum('puntuacion');
        if ($cant == 0) {
            return ('(Sin calificaciones)');
        }
        else {
            $reputacion = $sum / $cant;
            $reputacionFormateada = (number_format($reputacion, 2, '.', ''));
            return ($reputacionFormateada . ' de 5.00');
        }
    }


    //version usando el atributo user->reputacion ()
    /*
    public function reputacionFormateada(){
        if ($this->reputacion ==null) {
            return ('(Sin calificaciones)');
        }
        else {
            $reputacionFormateada = (number_format($this->reputacion, 2, '.', ''));
            return ($reputacionFormateada . ' de 5.00');
        }

    }
    */

    public function nombreCompleto() {
        return ($this->nombre . ' ' . $this->apellido);
    }


}
