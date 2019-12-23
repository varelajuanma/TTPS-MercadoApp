<?php

namespace App\Http\Controllers;

use App\User;
use App\Producto;
use Illuminate\Http\Request;

class ProductosController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function create(){
        return view('productos.create');
    }

    public function store(){
        $data = request()->validate([
                'nombre'=>'required',
                'descripcion'=>'required',
                'precio_min'=>'required',
                'precio_base'=>'required',
                'precio_max'=>'required',
                'imagen'=>['required','image'],
            ]);

        $imagePath = request('imagen')->store('uploads', 'public');

        auth()->user()->productos()->create([
                'nombre'=>$data['nombre'],
                'descripcion'=>$data['descripcion'],
                'precio_min'=>$data['precio_min'],
                'precio_base'=>$data['precio_base'],
                'precio_max'=>$data['precio_max'],
                'imagen'=>$imagePath,
            ]

        );

        return redirect('/perfiles/vendedor');

    }

    public function edit($productoId)
    { $producto= Producto::findOrFail($productoId);

        return view('productos.edit', [
            'producto'=> $producto]);

    }
    public function update($productoId){
        $producto= Producto::findOrFail($productoId);
        $data = request()->validate([
            'nombre'=>'required',
            'descripcion'=>'required',
            'precio_min'=>'required',
            'precio_base'=>'required',
            'precio_max'=>'required',
            'imagen'=>['required','image'],
        ]);
        $imagePath = request('imagen')->store('uploads', 'public');

        $producto->update([
            'nombre'=>$data['nombre'],
            'descripcion'=>$data['descripcion'],
            'precio_min'=>$data['precio_min'],
            'precio_base'=>$data['precio_base'],
            'precio_max'=>$data['precio_max'],
            'imagen'=>$imagePath,
        ]);

        return redirect("/perfiles/{$producto->user_id}");

    }

    public function destroy($productoId){
        $producto = Producto::find($productoId);

        $destroy = Producto::destroy($productoId);

        return redirect("/perfiles/{$producto->user_id}");

    }
}
