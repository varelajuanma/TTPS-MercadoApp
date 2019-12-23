<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PublicacionesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('publicaciones')->insert([
            ['producto_id' => 6,
                'user_id' => 3,
                'nombre' => 'Celular 100% original, sellado, ensamblado en tierra del fuego. Varios colores, poseeo mucho stock',
                'descripcion' => 'excelente estado etc',
                'estado_id' => 1,   //aclaracion: 1 = activo 2 = inactivo,  3= sin stock

                'precio_base' => 10000,
                'precio_min' => 8500,
                'precio_max' => 15000,
                'stock' => 24
            ],
            ['producto_id' => 6,
                'user_id' => 6,
                'nombre' => 'celular condicionado, ningun detalle ensamblado en estados unidos. Compra hoy de regalo una micro sd 32 gb',
                'descripcion' => 'buen estado',
                'estado_id' => 3,

                'precio_base' => 8000,
                'precio_min' => 6500,
                'precio_max' => 12000,
                'stock' => 0
            ],
            ['producto_id' => 14,
                'user_id' => 1,
                'nombre' => 'Desparasitados,vacunados y listo para retirar',
                'descripcion' => 'Todos muy mimosos son',
                'estado_id' => 1,

                'precio_base' => 9200,
                'precio_min' => 9000,
                'precio_max' => 9500,
                'stock' => 9
            ],
            ['producto_id' => 21,
                'user_id' => 2,
                'nombre' => 'Violonchelo excelente estado año 2006 tenemos stock. Estilo clasico con microafinador ',
                'descripcion' => '',
                'estado_id' => 2,

                'precio_base' => 50000,
                'precio_min' => 48000,
                'precio_max' => 52000,
                'stock' => 1
            ],
            ['producto_id' => 17,
                'user_id' => 2,
                'nombre' => 'Piano Ideal Estudio ¼ de cola de contado hacemos un 5% de descuento, tengo stock tambien en acabado marron',
                'descripcion' => '',

                'estado_id' => 1,

                'precio_base' => 15100,
                'precio_min' => 9500,
                'precio_max' => 18100,
                'stock' => 1
            ],
            ['producto_id' => 26,
                'user_id' => 7,
                'nombre' => 'Quilmes cristal fria hasta las 4 am. Precio de costo hasta las 22:00',
                'descripcion' => 'con pizza...',

                'estado_id' => 1,

                'precio_base' => 220,
                'precio_min' => 220,
                'precio_max' => 260,
                'stock' => 125
            ],
            ['producto_id' => 26,
                'user_id' => 7,
                'nombre' => 'Quilmes Bock',
                'descripcion' => 'muy buena...',

                'estado_id' => 1,

                'precio_base' => 250,
                'precio_min' => 250,
                'precio_max' => 310,
                'stock' => 63
            ],
            ['producto_id' => 26,
                'user_id' => 7,
                'nombre' => 'Imperial Stout',
                'descripcion' => 'ideal para el sabado! ',

                'estado_id' => 2,

                'precio_base' => 280,
                'precio_min' => 280,
                'precio_max' => 345,
                'stock' => 45
            ],
            ['producto_id' => 26,
                'user_id' => 7,
                'nombre' => 'Cerveza Andes roja artesanal bien dulce ',
                'descripcion' => 'rica.. ',

                'estado_id' => 3,
                'precio_base' => 300,
                'precio_min' => 350,
                'precio_max' => 400,
                'stock' => 0
            ],
            ['producto_id' => 32,   //(HABIA ERROR EN LA BASE 0 CONFIRMAR DESPUES QUE COINCIDA)
                'user_id' => 4,
                'nombre' => 'Sumergite en la pantalla. Comprando el televisor tenes un 5% de descuento si lo compras en los últimos días del mes y de contando te llevas de regalo un decodificador flow. ',
                'descripcion' => 'Con el Smart TV Samsung UN50MU6100, viví una nueva experiencia visual con la resolución 4K, que te presentará imágenes con gran detalle y de alta calidad',

                'estado_id' => 1,
                'precio_base' => 39900,
                'precio_min' => 28000,
                'precio_max' => 65000,
                'stock' => 10
            ],


            //publicaciones extras (no pedidas en la base 0), la idea es poder mostrar claramente el home del comprador con las 10 publis mas vendidas (asi q hay que tener mas de 10 publis activas para que se note)

            ['producto_id' => 40,
                'user_id' => 7,
                'nombre' => 'Pro Evolution Soccer 2020',
                'descripcion' => 'Sentite Messi desde el sillon de tu casa con PES 2020',
                'estado_id' => 1,
                'precio_base' => 1200,
                'precio_min' => 1100,
                'precio_max' => 1800,
                'stock' => 7
            ],

            ['producto_id' => 41,
                'user_id' => 7,
                'nombre' => 'Entrada Leon Gieco',
                'descripcion' => 'Veni a ver a Leon! un show para toda la familia',
                'estado_id' => 1,
                'precio_base' => 50,
                'precio_min' => 20,
                'precio_max' => 80,
                'stock' => 7
            ],
            ['producto_id' => 42,
                'user_id' => 7,
                'nombre' => 'Jarron de la dinastia ming',
                'descripcion' => 'Jarron de la dinastia ming, unico en el mundo 100% Original, NO fake',
                'estado_id' => 1,
                'precio_base' => 15000,
                'precio_min' => 14500,
                'precio_max' => 21400,
                'stock' => 142
            ],
            ['producto_id' => 43,
                'user_id' => 6,
                'nombre' => 'Intel Core i5',
                'descripcion' => 'Intel Core i5 5400',
                'estado_id' => 1,
                'precio_base' => 12000,
                'precio_min' => 11500,
                'precio_max' => 14000,
                'stock' => 8
            ],
            ['producto_id' => 44,
                'user_id' => 6,
                'nombre' => 'Camiseta del Barcelona 2018 Suplente',
                'descripcion' => 'Camiseta del FC Barcelona 2018 Amarilla 100% original',
                'estado_id' => 1,
                'precio_base' => 4000,
                'precio_min' => 3500,
                'precio_max' => 4600,
                'stock' => 5
            ],
            ['producto_id' => 45,
                'user_id' => 6,
                'nombre' => 'Detergente magistral',
                'descripcion' => 'Detergente magistral: para cuando esa grasa no se quita!',
                'estado_id' => 1,
                'precio_base' => 200,
                'precio_min' => 150,
                'precio_max' => 250,
                'stock' => 14
            ],

        ]);
    }
}
