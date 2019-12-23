<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductosTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('productos')->insert([
            [
                'id' => 5,
                'nombre' => 'Memoria Micro Sd Hc 16 Gb Kingston Clase 10 Tienda',
                'descripcion' => 'Siendo la tarjeta SD más pequeña disponible, la microSD Clase 10 es la opción de almacenamiento expandible estándar para muchas tablets, teléfonos inteligentes y cámaras de acción.',
                'categoria_id' => 3,
                'marca_id' => 10,
                'modelo_id'=>null

            ],
            [
                'id' => 6,
                'nombre' => 'Celular samsung j6 plus, linea galaxy J',
                'descripcion' => 'Modelo j6 posee memoria interna de 32 gb uno de los mejores celulares de gama media,pantalla vibrante infinity display.',
                'categoria_id' => 3,
                'marca_id' => 1,
                'modelo_id'=>null

            ],
            [
                'id' => 14,
                'nombre' => 'Perros Cachorros Caniche Toy',
                'descripcion' => 'Cachorritos caniche toy., a partir de los 45 días para la venta. ',
                'categoria_id' => 4,
                'marca_id' => null,
                'modelo_id'=>null

            ],
            [
                'id' => 17,
                'nombre' => 'Piano cola steinway essex egp 155 negro nuevo',
                'descripcion' => 'Piano de cola steinway essex. Modelo nuevo 155 egp. ',
                'categoria_id' => 8,
                'marca_id' => null,
                'modelo_id'=>null

            ],
            [
                'id' => 21,
                'nombre' => 'Violonchelo cello 4/4 custom parquer ce900',
                'descripcion' => 'Violonchelos de diferente tipo ',
                'categoria_id' => 8,
                'marca_id' => 8,
                'modelo_id' => 8
            ],
            [
                'id' => 26,
                'nombre' => 'Cerveza porroncito 340 ml envase no retornable ',
                'descripcion' => 'Cervezas de todo tipo',
                'categoria_id' => 14,
                'marca_id' => 11,
                'modelo_id'=>null

            ],
            [
                'id' => 32,
                'nombre' => 'Smart TV Samsung 32” UN32J4290AGXZD',
                'descripcion' => 'Sumergite en la pantalla con el Smart TV Samsung UN32J4290, viví una nueva experiencia visual con la resolución HD, que te presentará imágenes con gran detalle y de alta calidad. Ahora todo lo que veas cobrará vida con brillo y colores más reales. Gracias a su tamaño de 32", podrás transformar tu espacio en una sala de cine y transportarte a donde quieras.',
                'categoria_id' => 1,
                'marca_id' => 1,
                'modelo_id'=>null
            ],

            //aca arrancan los extras (que no son pedidos en la base 0)

            [   'id' => 40,
                'nombre' => 'Pro Evolution Soccer 2020',
                'descripcion' => 'Sentite Messi desde el sillon de tu casa con PES 2020',
                'categoria_id' => 6,
                'marca_id' => null,
                'modelo_id'=>null
            ],

            [   'id' => 41,
                'nombre' => 'Entrada Leon Gieco',
                'descripcion' => 'Veni a ver a Leon Gieco, Un show para toda la familia!',
                'categoria_id' => 23,
                'marca_id' => null,
                'modelo_id'=>null
            ],

            [   'id' => 42,
                'nombre' => 'Jarron de la dinastia Ming',
                'descripcion' => 'Jarron de la dinastia Ming',
                'categoria_id' => 11,
                'marca_id' => null,
                'modelo_id'=>null
            ],

            [   'id' => 43,
                'nombre' => 'Procesador Intel Core I5',
                'descripcion' => 'Procesador Intel Core I5',
                'categoria_id' => 20,
                'marca_id' => null,
                'modelo_id'=>null
            ],

           [   'id' => 44,
                'nombre' => 'Camisetas de futbol',
                'descripcion' => 'Camisetas de futbol de todo tipo',
                'categoria_id' => 15,
                'marca_id' => null,
                'modelo_id'=>null
            ],

            [   'id' => 45,
                'nombre' => 'Detergente',
                'descripcion' => 'Detergentes de todo tipo',
                'categoria_id' => 19,
                'marca_id' => null,
                'modelo_id'=>null
            ],


        ]);
    }
}
