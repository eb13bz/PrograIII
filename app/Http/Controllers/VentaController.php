<?php
namespace App\Http\Controllers;
// En app/Http/Controllers/VentaController.php

use App\Models\Venta;
use App\Models\Cliente; // Importar modelo
use App\Models\Usuario; // Importar modelo
use Illuminate\Http\Request;

class VentaController extends Controller
{
    public function index()
    {
        $ventas = Venta::all();
        return view('ventas.index', compact('ventas'));
    }

    public function create()
    {
        $clientes = Cliente::all(); // Obtener todos los clientes
        $usuarios = Usuario::all(); // Obtener todos los usuarios
        return view('ventas.create', compact('clientes', 'usuarios'));
    }

    // ... otros métodos (store, show, edit, update, destroy)
}