@extends('layouts.app')

@section('content')
    <h1>Lista de Productos</h1>
    <a href="{{ route('productos.create') }}" class="btn btn-primary">Crear Nuevo Producto</a>
    <table class="table table-striped mt-3">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Código</th>
                <th>Categoría</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
        @foreach ($productos as $producto)
            <tr>
                <td>{{ $producto->id }}</td>
                <td>{{ $producto->nombre }}</td>
                <td>{{ $producto->codigo_unico }}</td>
                <td>{{ $producto->categoria->nombre }}</td>
                <td>
                    <a href="{{ route('productos.show', $producto->id) }}" class="btn btn-sm btn-info">Ver</a>
                    <a href="{{ route('productos.edit', $producto->id) }}" class="btn btn-sm btn-warning">Editar</a>
                    <form action="{{ route('productos.destroy', $producto->id) }}" method="POST" class="d-inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('¿Eliminar registro?')">Eliminar</button>
                    </form>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
@endsection