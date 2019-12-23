<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Imagen extends Model
{
    protected $table = 'imagenes';
    protected $guarded =[];

    public function publicacion(){
        return $this->belongsTo(Publicacion::class);
    }

}
