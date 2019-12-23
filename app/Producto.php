<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{
    protected $guarded =[];
    public $incrementing = false;

    public function publicaciones(){
        return $this->hasMany(Publicacion::class);
    }
    public function calificaciones(){
        return $this->hasMany(CalificacionPublicacion::class);
    }

}
