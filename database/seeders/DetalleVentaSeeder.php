<?php

namespace Database\Seeders;

use App\Models\DetalleVenta;
use App\Models\Venta;
use App\Models\Producto;
use Illuminate\Database\Seeder;

class DetalleVentaSeeder extends Seeder
{
    public function run(): void
    {
        $venta1 = Venta::first();
        $producto1 = Producto::first();
        $producto2 = Producto::skip(1)->first();

        if ($venta1 && $producto1) {
            DetalleVenta::create([
                'id_venta' => $venta1->id_venta,
                'id_producto' => $producto1->id,
                'cantidad' => 1,
                'precio_unitario' => $producto1->precio_unitario
            ]);
        }

        if ($venta1 && $producto2) {
            DetalleVenta::create([
                'id_venta' => $venta1->id_venta,
                'id_producto' => $producto2->id,
                'cantidad' => 10,
                'precio_unitario' => $producto2->precio_unitario
            ]);
        }
    }
}