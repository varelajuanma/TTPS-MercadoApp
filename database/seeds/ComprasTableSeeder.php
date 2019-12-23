<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class ComprasTableSeeder extends Seeder {
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
   {
        DB::table('compras')->insert([
            ['user_comprador_id'=> 1,
            'user_vendedor_id' => 3,
            'publicacion_id' => 1,
        	'cantidad' => 1,
            'precio_unitario' => 9000,
            'created_at' => Carbon::now()],
       		['user_comprador_id'=> 4,
            'user_vendedor_id' => 1,
            'publicacion_id' => 3,
        	'cantidad' => 3,
            'precio_unitario' => 2000,
            'created_at' => Carbon::now()],
        	['user_comprador_id'=> 1,
            'user_vendedor_id' => 7,
            'publicacion_id' => 7,
        	'cantidad' => 5,
            'precio_unitario' => 320,
            'created_at' => Carbon::now()],
        	['user_comprador_id'=> 2,
            'user_vendedor_id' => 7,
            'publicacion_id' => 8,
        	'cantidad' => 10,
            'precio_unitario' => 800,
            'created_at' => Carbon::now()],
        	['user_comprador_id'=> 3,
            'user_vendedor_id' => 4,
            'publicacion_id' => 10,
        	'cantidad' => 1,
            'precio_unitario' => 250,
            'created_at' => Carbon::now()],
        	['user_comprador_id'=> 3,
            'user_vendedor_id' => 7,
            'publicacion_id' => 8,
        	'cantidad' => 3,
            'precio_unitario' => 270,
            'created_at' => Carbon::now()],
        	['user_comprador_id'=> 5,
            'user_vendedor_id' => 3,
            'publicacion_id' => 1,
        	'cantidad' => 5,
            'precio_unitario' => 500,
            'created_at' => Carbon::now()],
        	['user_comprador_id'=> 4,
            'user_vendedor_id' => 7,
            'publicacion_id' => 9,
        	'cantidad' => 1,
            'precio_unitario' => 280,
            'created_at' => Carbon::now()],
        ]);
    }
}
