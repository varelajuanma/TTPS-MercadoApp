<?php

use Illuminate\Database\Seeder;

class CalificacionesPublicacionesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
       
     	DB::table('calificaciones_publicaciones')->insert([
	        ['publicacion_id'=> 1,
	        'user_id' => 1,
	    	'puntuacion' => 5,
	    	'comentario' => 'Muy buena atencion'],
	    	['publicacion_id'=> 3,
	        'user_id' => 4,
	    	'puntuacion' => 1,
	    	'comentario' => 'Muy mala onda el que atiende'],
	    	['publicacion_id'=> 7,
	        'user_id' => 1,
	    	'puntuacion' => 2,
	    	'comentario' => 'Me lo vendio con el condesador de flujo fallado'],
	    	['publicacion_id'=> 8,
	        'user_id' => 2,
	    	'puntuacion' => 3,
	    	'comentario' => 'No esta mal'],
	    	['publicacion_id'=> 10,
	        'user_id' => 3,
	    	'puntuacion' => 5,
	    	'comentario' => 'El mejor vendedor de todos'],
	    	['publicacion_id'=> 8,
	        'user_id' => 3,
	    	'puntuacion' => 1,
	    	'comentario' => 'No le compro nunca mas'],
	    	['publicacion_id'=> 1,
	        'user_id' => 5,
	    	'puntuacion' => 4,
	    	'comentario' => 'Buena atencion'],
	    	['publicacion_id'=> 9,
	        'user_id' => 4,
	    	'puntuacion' => 3,
	    	'comentario' => 'Me hubiese gustado mas si lo tenia en verde'],
   
      
     	]);
    }
}
