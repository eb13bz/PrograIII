@extends('layouts.app')

@section('content')
    <h2>Detalles del Producto</h2>
    <p><strong>ID:</strong> {{ $producto->id }}</p>
    <p><strong>Código Único:</strong> {{ $producto->codigo_unico }}</p>
    <p><strong>Nombre:</strong> {{ $producto->nombre }}</p>
    <p><strong>Precio:</strong> {{ $producto->precio_unitario }}</p>
    <p><strong>Stock:</strong> {{ $producto->stock_actual }}</p>
    <p><strong>Categoría:</strong> {{ $producto->categoria->nombre }}</p>
    <a href="{{ route('productos.edit', $producto->id) }}" class="btn btn-warning">Editar Producto</a>
    <a href="{{ route('productos.index') }}" class="btn btn-secondary">Volver a la lista</a>
@endsection