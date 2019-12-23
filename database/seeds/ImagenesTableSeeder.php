<?php

use Illuminate\Database\Seeder;

class ImagenesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('imagenes')->insert([
            [
                'publicacion_id'=>1,
                'path'=>'../image/samsung.jpg'
            ],
        [
            'publicacion_id'=>2,
            'path'=>'../image/samsung2.jpg'
        ],
        [
            'publicacion_id'=>3,
            'path'=>'../image/caniches.jpg'
        ],
        [
            'publicacion_id'=>4,
            'path'=>'../image/violonchelo.jpg'
        ],
        [
            'publicacion_id'=>5,
            'path'=>'../image/piano.jpg'
        ],
        [
            'publicacion_id'=>6,
            'path'=>'../image/quilmes cristal.png'
        ],
        [
            'publicacion_id'=>7,
            'path'=>'../image/quilmes bock.jpg'
        ],
        [
            'publicacion_id'=>8,
            'path'=>'../image/imperialstout.jpg'
        ],
        [
            'publicacion_id'=>9,
            'path'=>'../image/andes roja.jpg'
        ],
        [
            'publicacion_id'=>10,
            'path'=>'../image/smartv samsung.jpg'
        ],
        [
            'publicacion_id'=>11,
            'path'=>'../image/PES 2020.jpg'
        ],
        [
            'publicacion_id'=>12,
            'path'=>'../image/Entrada Leon Gieco.jpg'
        ],
        [
            'publicacion_id'=>13,
            'path'=>'../image/Jarron ming.jpg'
        ],
        [
            'publicacion_id'=>14,
            'path'=>'../image/Intel i5.jpg'
        ],
        [
            'publicacion_id'=>15,
            'path'=>'../image/Camiseta Barcelona.jpg'
        ],
        [
            'publicacion_id'=>16,
            'path'=>'../image/Detergente.jpg'
        ],


    ]);
    }
}
