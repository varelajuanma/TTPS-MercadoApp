<?php

use App\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $mytime = Carbon\Carbon::now();

        DB::table('users')->insert([
            ['nombre' => 'Test',    //user_id= 1
            'apellido' => 'User',
            'fechadenacimiento' => $mytime->toDateTimeString(),
            'email' => 'test@test.com',
            'password' => Hash::make('12345678'),
            'saldo' => 550,
            'puntaje' => 20,
            'reputacion' => 1,
            'categoria_ultimo_producto' => '14',
            'precio_asignado' => 3], //aclaracion: 1= base; 2= maximo; 3= minimo
            ['nombre' => 'Juan',    //user_id= 2
            'apellido' => 'Comprador1',
            'fechadenacimiento' => $mytime->toDateTimeString(),
            'email' => 'JuanComprador1@gmail.com',
            'password' => Hash::make('12345678'),
            'saldo' => 1000,
            'puntaje' => 40,
            'reputacion' => null,
            'categoria_ultimo_producto' => null,
            'precio_asignado' => 2],
            ['nombre' => 'Maria',   //user_id= 3
            'apellido' => 'Comprador2',
            'fechadenacimiento' => $mytime->toDateTimeString(),
            'email' => 'MariaComprador2@gmail.com',
            'password' => Hash::make('12345678'),
            'saldo' => 2000,
            'puntaje' => 25,
            'reputacion' => 4.5,
            'categoria_ultimo_producto' => null,
            'precio_asignado' => 1],
            ['nombre' => 'Josefina',    //user_id= 4
            'apellido' => 'Vendedor1',
            'fechadenacimiento' => $mytime->toDateTimeString(),
            'email' => 'JosefinaVendedor1@gmail.com',
            'password' => Hash::make('12345678'),
            'saldo' => 3000,
            'puntaje' => 800,
            'reputacion' => 5,
            'categoria_ultimo_producto' => null,
            'precio_asignado' => 1],
            ['nombre' => 'Julian',  //user_id= 5
            'apellido' => 'Vendedor2',
            'fechadenacimiento' => $mytime->toDateTimeString(),
            'email' => 'JulianVendedor2@gmail.com',
            'password' => Hash::make('12345678'),
            'saldo' => 4000,
            'puntaje' => 400,
            'reputacion' => null,
            'categoria_ultimo_producto' => '8',
            'precio_asignado' => 1],
            ['nombre' => 'Usuario6',  //user_id= 6
            'apellido' => 'DePrueba',
            'fechadenacimiento' => $mytime->toDateTimeString(),
            'email' => 'usuario6@gmail.com',
            'password' => Hash::make('12345678'),
            'saldo' => 5000,
            'puntaje' => 80,
            'reputacion' => null,
            'categoria_ultimo_producto' => null,
            'precio_asignado' => 1],
            ['nombre' => 'Usuario7',  //user_id= 7
            'apellido' => 'DePrueba',
            'fechadenacimiento' => $mytime->toDateTimeString(),
            'email' => 'usuario7@gmail.com',
            'password' => Hash::make('12345678'),
            'saldo' => 6000,
            'puntaje' => 100,
            'reputacion' => 2.25,
            'categoria_ultimo_producto' => '1',
            'precio_asignado' => 1],
        ]);

        DB::table('users')->insert([
            ['id' => 999,
            'nombre' => 'El dueño', 
            'apellido' => 'del sitio',
            'fechadenacimiento' => $mytime->toDateTimeString(),
            'email' => 'productowner@gmail.com',
            'password' => Hash::make('12345678'),
            'saldo' => 0,
            'puntaje' => 0,
            'reputacion' => null,
            'categoria_ultimo_producto' => null,
            'precio_asignado' => 1],

        ]);
    }
}
