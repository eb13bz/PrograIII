@extends('layouts.app')

@section('content')
    <h2>Editar Usuarios</h2>
    <form action="{{ route('usuarios.update', $usuario->id_usuario) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label class="form-label">Nombre</label>
            <input type="text" name="nombre" value="{{ old('nombre', $usuario->nombre) }}" class="form-control" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Usuario</label>
            <input type="text" name="usuario" value="{{ old('usuario', $usuario->usuario) }}" class="form-control" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Contraseña (dejar en blanco para no cambiar)</label>
            <input type="password" name="contrasena" class="form-control">
        </div>
        <button type="submit" class="btn btn-primary">Actualizar</button>
        <a href="{{ route('usuarios.index') }}" class="btn btn-secondary">Cancelar</a>
    </form>
@endsection