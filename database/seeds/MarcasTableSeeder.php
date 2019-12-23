<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MarcasTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('marcas')->insert([
           ['nombre'=>'Samsung'],
            ['nombre'=>'Motorola'],
            ['nombre'=>'Sony'],
            ['nombre'=>'Intel/AMD'],
            ['nombre'=>'Nikon'],
            ['nombre'=>'Case Logic'],
            ['nombre'=>'Yamaha'],
            ['nombre'=>'Parquer'],
            ['nombre'=>'Planeta'],
            ['nombre'=>'Kingston'],
            ['nombre'=>'Quilmes'],
            ]);
    }
}
