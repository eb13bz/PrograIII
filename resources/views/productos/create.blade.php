@extends('layouts.app')

@section('content')
    <h2>Crear Nuevo Producto</h2>
    <form action="{{ route('productos.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label class="form-label">Código Único</label>
            <input type="text" name="codigo_unico" class="form-control" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Nombre</label>
            <input type="text" name="nombre" class="form-control" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Precio Unitario</label>
            <input type="number" step="0.01" name="precio_unitario" class="form-control" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Stock Actual</label>
            <input type="number" name="stock_actual" class="form-control" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Categoría</label>
            <select name="id_categoria" class="form-select" required>
                @foreach ($categorias as $categoria)
                    <option value="{{ $categoria->id }}">{{ $categoria->nombre }}</option>
                @endforeach
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Guardar Producto</button>
        <a href="{{ route('productos.index') }}" class="btn btn-secondary">Cancelar</a>
    </form>
@endsection