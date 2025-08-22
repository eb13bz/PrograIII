<?php

namespace App\Http\Controllers;

use App\Models\Producto;
use App\Models\Categoria;
use Illuminate\Http\Request;

class ProductoController extends Controller
{
    public function index()
    {
        $productos = Producto::all();
        return view('productos.index', compact('productos'));
    }

    public function create()
    {
        $categorias = Categoria::all();
        return view('productos.create', compact('categorias'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'codigo_unico' => 'required|unique:productos,codigo_unico',
            'nombre' => 'required',
            'precio_unitario' => 'required|numeric|min:0',
            'stock_actual' => 'required|integer|min:0',
            'id_categoria' => 'required|exists:categorias,id'
        ]);
        Producto::create($request->all());
        return redirect()->route('productos.index');
    }

    public function show(Producto $producto)
    {
        return view('productos.show', compact('producto'));
    }

    public function edit(Producto $producto)
    {
        $categorias = Categoria::all();
        return view('productos.edit', compact('producto', 'categorias'));
    }

    public function update(Request $request, Producto $producto)
    {
        $request->validate([
            'codigo_unico' => 'required|unique:productos,codigo_unico,' . $producto->id . ',id',
            'nombre' => 'required',
            'precio_unitario' => 'required|numeric|min:0',
            'stock_actual' => 'required|integer|min:0',
            'id_categoria' => 'required|exists:categorias,id'
        ]);
        $producto->update($request->all());
        return redirect()->route('productos.index');
    }

    public function destroy(Producto $producto)
    {
        $producto->delete();
        return redirect()->route('productos.index');
    }
}