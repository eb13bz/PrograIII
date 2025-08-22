@extends('layouts.app')

@section('content')
    <h1>Lista de Categorías</h1>
    <a href="{{ url('/categorias/create') }}" class="btn btn-primary">Crear Nueva Categoría</a>

    <table class="table table-striped mt-3">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Descripción</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($categorias as $categoria)
                <tr>
                    <td>{{ $categoria->id }}</td>
                    <td>{{ $categoria->nombre }}</td>
                    <td>{{ $categoria->descripcion }}</td>
                    <td>
                        <a href="{{ url('categorias/' . $categoria->id . '/edit') }}" class="btn btn-sm btn-warning">Editar</a>
                        <form action="{{ url('categorias/' . $categoria->id) }}" method="POST" class="d-inline">
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