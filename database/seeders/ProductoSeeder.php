<?php

namespace Database\Seeders;

use App\Models\Categoria;
use App\Models\Producto;
use Illuminate\Database\Seeder;

class ProductoSeeder extends Seeder
{

    public function run(): void
    {
        $electronica = Categoria::where('nombre', 'Electrónica')->first();
        $hogar = Categoria::where('nombre', 'Hogar')->first();

        Producto::create([
            'codigo_unico' => 'LAP-123',
            'nombre' => 'Laptop Gamer',
            'precio_unitario' => 1200.50,
            'stock_actual' => 10,
            'id_categoria' => $electronica->id
        ]);

        Producto::create([
            'codigo_unico' => 'MOUSE-456',
            'nombre' => 'Mouse Inalámbrico',
            'precio_unitario' => 25.00,
            'stock_actual' => 50,
            'id_categoria' => $electronica->id
        ]);

        Producto::create([
            'codigo_unico' => 'ASP-789',
            'nombre' => 'Aspiradora Robótica',
            'precio_unitario' => 350.00,
            'stock_actual' => 5,
            'id_categoria' => $hogar->id
        ]);
    }
}