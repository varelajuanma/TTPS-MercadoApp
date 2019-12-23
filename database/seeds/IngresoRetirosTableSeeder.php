<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;

class IngresoRetirosTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(){
      
      	DB::table('ingreso_retiros')->insert([
            ['user_id'=> 1,
            'monto' => 2500,
            'tipo' => 1 ,
            'created_at' => Carbon::now()],
            ['user_id'=> 1,
            'monto' =>  -1100,
            'tipo' => 5 ,
            'created_at' => Carbon::now()],
            ['user_id'=> 1,
            'monto' =>  100,
            'tipo' => 2 ,
            'created_at' => Carbon::now()],
            ['user_id'=> 1,
            'monto' => -1000 ,
            'tipo' => 5 ,
            'created_at' => Carbon::now()],
            ['user_id'=> 1,
            'monto' =>  -500,
            'tipo' => 5 ,
            'created_at' => Carbon::now()],
            ['user_id'=> 1,
            'monto' =>  550,
            'tipo' => 1 ,
            'created_at' => Carbon::now()], #queda en 550
            ['user_id'=> 2,
            'monto' =>  3000,
            'tipo' => 1 ,
            'created_at' => Carbon::now()],
            ['user_id'=> 2,
            'monto' =>  -1700,
            'tipo' => 5 ,
            'created_at' => Carbon::now()], 
            ['user_id'=> 2,
            'monto' =>  -300,
            'tipo' => 5 ,
            'created_at' => Carbon::now()], #queda en 1000
            ['user_id'=> 3,
            'monto' =>  2050,
            'tipo' => 1 ,
            'created_at' => Carbon::now()],
            ['user_id'=> 3,
            'monto' =>  -50,
            'tipo' => 5 ,
            'created_at' => Carbon::now()], #queda en 2000
            ['user_id'=> 4,
            'monto' =>  4000,
            'tipo' => 1 ,
            'created_at' => Carbon::now()],
            ['user_id'=> 4,
            'monto' =>  -750,
            'tipo' => 5 ,
            'created_at' => Carbon::now()],
            ['user_id'=> 4,
            'monto' =>  -250,
            'tipo' => 5 ,
            'created_at' => Carbon::now()], #queda en 3000
            ['user_id'=> 5,
            'monto' =>  4000,
            'tipo' => 1 ,
            'created_at' => Carbon::now()], #queda en 4000
            ['user_id'=> 6,
            'monto' =>  5000,
            'tipo' => 1 ,
            'created_at' => Carbon::now()], #queda en 5000
            ['user_id'=> 7,
            'monto' =>  6000,
            'tipo' => 1 ,
            'created_at' => Carbon::now()], #queda en 6000
        ]);	

    }
}
