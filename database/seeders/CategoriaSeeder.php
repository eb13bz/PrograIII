<?php

namespace Database\Seeders;

use App\Models\Categoria;
use Illuminate\Database\Seeder;

class CategoriaSeeder extends Seeder
{
   
    public function run(): void
    {
        Categoria::create(['nombre' => 'Electrónica', 'descripcion' => 'Dispositivos electrónicos.']);
        Categoria::create(['nombre' => 'Hogar', 'descripcion' => 'Artículos para el hogar.']);
    }
}