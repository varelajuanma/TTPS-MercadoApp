<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Publicacion extends Model
{
    protected $guarded =[];
    protected $table = 'publicaciones';
    public function user(){
        return $this->belongsTo(User::class);
    }
    public function producto(){
        return $this->belongsTo(Producto::class);
    }
    public function imagenes(){
        return $this->hasMany(Imagen::class);
    }
    public function calificaciones(){
        return $this->hasMany(CalificacionPublicacion::class);
    }

    public function calificacionPromedio(){
        return $this->calificaciones()->avg('puntuacion');
    }

    public function calificacionPromedioFormateada(){
        $promedio = $this->calificacionPromedio();
        if ($promedio == 0) {
            return 'Sin Calificaciones';
        }
        else {
            $promedioFormateado = (number_format($promedio, 2, '.', ''));
            return ("$promedioFormateado" . " de 5.00");
        }
    }


    public function calificacion($user){
        return  $this->calificaciones()->where('user_id', $user->id)->where('publicacion_id', $this->id)->first();
    }



    public function compras(){
        return $this->hasMany(Compra::class);
    }
    public function imagenMuestra(){

        $imagenMuestra = $this->imagenes()->first();
        if ($imagenMuestra == null){
            return "/image/nodisponible.jpg";
        }

        $fullPath = '/storage/' .  $imagenMuestra->path;
        return $fullPath;
    }


    public function cantidadUnidadesVendidas(){
        return $this->compras()->sum('cantidad');

    }

    public function cantidadVentas(){
        return $this->compras()->count('cantidad');

    }


    public function precioActual () {
        switch($this->user()->first()->precio_asignado) {
        case(1):
            $precio= $this->precio_base;
            break;
        case(2):
            $precio= $this->precio_max;
            break;
        default:
            $precio= $this->precio_min;
        }
        return $precio;
    }

    public function precioActualFormateado() {
        return (number_format($this->precioActual(), 2, '.', ''));
    }


    public function estadoActual () {
        switch($this->estado_id) {
        case(1):
            $estado= 'Activo';
            break;
        case(2):
            $estado= 'Inactivo';
            break;
        default:
            $estado= 'Sin Stock';
        }
        return $estado;
    }


    public static function buscar($str){

    $resultado = DB::select("SELECT pu.id AS publiId, pr.id AS prodId, pu.nombre AS publiNombre, pr.nombre AS prNombre, pu.descripcion AS puDescripcion, pr.descripcion AS prDescripcion FROM publicaciones pu LEFT JOIN productos pr ON pu.producto_id = pr.id WHERE (pr. nombre LIKE '%$str%' OR pr.descripcion LIKE '%$str%' OR pu.nombre LIKE '%$str%' OR pu.descripcion LIKE '%$str%') AND pu.estado_id = 1
");
    $resultado= collect($resultado);

    $resultado->transform(function ($item, $key) {
        return Publicacion::find($item->publiId);
    });

    return $resultado;


}
    public static function buscarxcategoria($str, $cat){

        $resultado = DB::select("SELECT pu.id AS publiId, pr.id AS prodId, pu.nombre AS publiNombre, pr.nombre AS prNombre, pu.descripcion AS puDescripcion, pr.descripcion AS prDescripcion FROM publicaciones pu LEFT JOIN productos pr ON pu.producto_id = pr.id WHERE (pr. nombre LIKE '%$str%' OR pr.descripcion LIKE '%$str%' OR pu.nombre LIKE '%$str%' OR pu.descripcion LIKE '%$str%') AND pr.categoria_id = '$cat' AND pu.estado_id = 1
");
        $resultado= collect($resultado);

        $resultado->transform(function ($item, $key) {
            return Publicacion::find($item->publiId);
        });

        return $resultado;


    }
    public static function buscarxrango($str, $min, $max)
    {

        $busqueda = Publicacion::buscar($str);
        $filtro = $busqueda->filter(function ($value, $key) use($min, $max) {
            return $value->precioActual() >= $min && $value->precioActual() <= $max;
        });
        return $filtro;






    }

}
