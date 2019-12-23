<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Categoria extends Model
{
    public function publicaciones(){
    	return $this->hasManyThrough(Publicacion::class, Producto::class,'categoria_id', 'producto_id');
    }
}
