<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ModelosTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('modelos')->insert([
            ['codigo'=>'A10'],
            ['codigo'=>'A11'],
            ['codigo'=>'E6'],
            ['codigo'=>'G7 Play'],
            ['codigo'=>'AMD E2500'],
            ['codigo'=>'B500'],
            ['codigo'=>'CDB-304'],
            ['codigo'=>'CE900'],
            ['codigo'=>'CE700']

        ]);
    }
}
