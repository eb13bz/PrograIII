@extends('layouts.app')

@section('content')
    <h1>Lista de Usuarios</h1>
    <a href="{{ route('usuarios.create') }}" class="btn btn-primary">Crear Nuevo Usuario</a>

    <table class="table table-striped mt-3">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Usuario</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
        @foreach ($usuarios as $usuario)
            <tr>
                <td>{{ $usuario->id_usuario }}</td>
                <td>{{ $usuario->nombre }}</td>
                <td>{{ $usuario->usuario }}</td>
                <td>
                    <a href="{{ route('usuarios.show', $usuario->id_usuario) }}" class="btn btn-sm btn-info">Ver</a>
                    <a href="{{ route('usuarios.edit', $usuario->id_usuario) }}" class="btn btn-sm btn-warning">Editar</a>
                    <form action="{{ route('usuarios.destroy', $usuario->id_usuario) }}" method="POST" class="d-inline">
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