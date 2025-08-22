<?php

namespace Database\Seeders;

use App\Models\Venta;
use Illuminate\Database\Seeder;

class VentaSeeder extends Seeder
{
  
    public function run(): void
    {
        Venta::create([
            'id_cliente' => 1,
            'id_usuario' => 1,
            'total' => 1225.50
        ]);
        
        Venta::create([
            'id_cliente' => 2,
            'id_usuario' => 1,
            'total' => 25.00
        ]);
    }
}