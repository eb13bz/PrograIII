<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Venta extends Model
{
    use HasFactory;

    protected $primaryKey = 'id_venta';
    protected $fillable = [
        'id_cliente',
        'id_usuario',
        'total'
    ];

    public function detalles()
    {
        return $this->hasMany(DetalleVenta::class, 'id_venta');
    }
}