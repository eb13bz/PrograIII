<?php
namespace App\Http\Controllers;
use App\Models\DetalleVenta;
use App\Models\Producto; // Importar modelo
use Illuminate\Http\Request;

class DetalleVentaController extends Controller
{
    public function index()
    {
        $detalles = DetalleVenta::all();
        return view('detalles_venta.index', compact('detalles'));
    }

    public function create()
    {
        $productos = Producto::all(); // Obtener todos los productos
        return view('detalles_venta.create', compact('productos'));
    }

    // ... otros métodos
}