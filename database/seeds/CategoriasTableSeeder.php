<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategoriasTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('categorias')->insert([
            ['codigo'=>'MLA1000',
                'nombre'=>'Electrónica, Audio y Video'],
            ['codigo'=>'MLA1039',
                'nombre'=>'Cámaras y Accesorios'],
            ['codigo'=>'MLA1051',
                'nombre'=>'Celulares y Teléfonos'],
            ['codigo'=>'MLA1071',
                'nombre'=>'Animales y Mascotas'],
            ['codigo'=>'MLA1132',
                'nombre'=>'Juegos y Juguetes'],
            ['codigo'=>'MLA1144',
                'nombre'=>'Consolas y Videojuegos'],
            ['codigo'=>'MLA1168',
                'nombre'=>'Música, Películas y Series'],
            ['codigo'=>'MLA1182',
                'nombre'=>'Instrumentos Musicales'],
            ['codigo'=>'MLA1246',
                'nombre'=>'Belleza y Cuidado Personal'],
            ['codigo'=>'MLA1276',
                'nombre'=>'Deportes y Fitness'],
            ['codigo'=>'MLA1367',
                'nombre'=>'Antiguedades y Colecciones'],
            ['codigo'=>'MLA1368',
                'nombre'=>'Arte, Librería y Mercería'],
            ['codigo'=>'MLA1384',
                'nombre'=>'Bebés'],
            ['codigo'=>'MLA1403',
                'nombre'=>'Alimentos y Bebidas'],
            ['codigo'=>'MLA1430',
                'nombre'=>'Ropa y Accesorios'],
            ['codigo'=>'MLA1459',
                'nombre'=>'Inmuebles'],
            ['codigo'=>'MLA1499',
                'nombre'=>'Industrias y Oficinas'],
            ['codigo'=>'MLA1540',
                'nombre'=>'Servicios'],
            ['codigo'=>'MLA1574',
                'nombre'=>'Hogar, Muebles y Jardín'],
            ['codigo'=>'MLA1648',
                'nombre'=>'Computación'],
            ['codigo'=>'MLA1743',
                'nombre'=>'Autos, Motos y Otros'],
            ['codigo'=>'MLA1953',
                'nombre'=>'Otras Categorías'],
            ['codigo'=>'MLA2547',
                'nombre'=>'Entradas para eventos'],
            ['codigo'=>'MLA3025',
                'nombre'=>'libros, Revistas y Comics'],
            ['codigo'=>'MLA3937',
                'nombre'=>'Joyas y Relojes'],
            ['codigo'=>'MLA407134',
                'nombre'=>'Herramientas y Construcción'],
            ['codigo'=>'MLA409431',
                'nombre'=>'Salud y Equipamiento Médico'],
        ]);
    }
}
