<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ConfiguracionesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('configuraciones')->insert([


            'palabras' => 'bueno - buena - bien - buenisimo - buenisima - genial - excelente - perfecto - perfecta - ok - malo - mala - mal - malísimo - malisima - pésimo - pésima - regular - lindo - linda - hermoso - hermosa - feo - fea - horrible -  responsable - irresponsable - dedicado - dedicada - prolijo - desprolijo - confianza - desconfianza - amabilidad - lentitud - atencion - lento - lenta - lentisimo - rápido - rápida - rapidísimo - original - verdadero - verdadera - completo - completa - sano - sana - falso - falsa - imitación - copia - chino - chinos - roto - rota - agujereado - agujereada- abierto - abierta - vacio - vacia -  fraude - estafa - engaño - amable - atento - atenta - honesto - honesta - recomendable - mentiroso - mentirosa - estafador - estafadora - caro - cara - barato - barata - raro - rara
Trucho - chanta - ladron',
            'cantidad_palabras'=> 10,
            'cantidad_opiniones'=> 5,
            'cantidad_pesos_por_punto'=> 20,
            'porcentaje_comision'=> 5,
            'porcentaje_descuento_productos_asociados'=> 15,

        ]);
    }
}
