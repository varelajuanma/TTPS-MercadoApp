<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CalificacionProducto extends Model
{
    protected $table= 'calificaciones_productos';
    protected $guarded =[];

    public function producto(){
        return $this->belongsTo(Producto::class);
    }
}
