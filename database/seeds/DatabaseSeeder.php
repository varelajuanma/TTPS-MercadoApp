<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
        	ConfiguracionesTableSeeder::class, 
        	ProductosTableSeeder::class, 
        	CategoriasTableSeeder::class, 
        	MarcasTableSeeder::class, 
        	ModelosTableSeeder::class, 
        	PublicacionesTableSeeder::class, 
        	UserTableSeeder::class, 
        	ImagenesTableSeeder::class, 
        	ComprasTableSeeder::class,
            CalificacionesPublicacionesTableSeeder::class,
            CalificacionesProductosTableSeeder::class,
        	IngresoRetirosTableSeeder::class]);
    }
}
