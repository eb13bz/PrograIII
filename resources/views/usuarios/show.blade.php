@extends('layouts.app')

@section('content')
    <h2>Detalles del Usuario</h2>
    <p><strong>ID:</strong> {{ $usuario->id_usuario }}</p>
    <p><strong>Nombre:</strong> {{ $usuario->nombre }}</p>
    <p><strong>Usuario:</strong> {{ $usuario->usuario }}</p>
    <a href="{{ route('usuarios.edit', $usuario->id_usuario) }}" class="btn btn-warning">Editar Usuario</a>
    <a href="{{ route('usuarios.index') }}" class="btn btn-secondary">Volver a la lista</a>
@endsection