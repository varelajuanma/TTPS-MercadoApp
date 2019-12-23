<?php

use Illuminate\Database\Seeder;

class CalificacionesProductosTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
       
     	DB::table('calificaciones_productos')->insert([
	        ['producto_id' => 6,
	        'user_id' => 1,
	    	'puntuacion' => 4,
	    	'comentario' => 'Esta buenisimo el producto'],
	    	['producto_id' => 14,
	        'user_id' => 1,
	    	'puntuacion' => 3,
	    	'comentario' => 'El producto zafa'],
	    	['producto_id' => 26,
	        'user_id' => 1,
	    	'puntuacion' => 2,
	    	'comentario' => 'Viene fallado el condensador de flujo'],
	    	['producto_id' => 26,
	        'user_id' => 2,
	    	'puntuacion' => 3,
	    	'comentario' => 'No esta mal'],
	    	['producto_id' => 45,
	        'user_id' => 3,
	    	'puntuacion' => 5,
	    	'comentario' => 'Excelente producto'],
	    	['producto_id' => 26,
	        'user_id' => 3,
	    	'puntuacion' => 1,
	    	'comentario' => 'Se me rompio cuando sali del local'],
	    	['producto_id' => 6,
	        'user_id' => 3,
	    	'puntuacion' => 5,
	    	'comentario' => 'El producto esta bueno'],
	    	['producto_id' => 26,
	        'user_id' => 4,
	    	'puntuacion' => 3,
	    	'comentario' => 'Deberian fabricarlos tambien en verde'],
   
      
     	]);
    }
}
