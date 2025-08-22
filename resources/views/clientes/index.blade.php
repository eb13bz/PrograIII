@extends('layouts.app')

@section('content')
    <h1>Lista de Clientes</h1>
    <a href="{{ route('clientes.create') }}" class="btn btn-primary">Crear Nuevo Cliente</a>
    
    <table class="table table-striped mt-3">
        <thead>
            <tr>
              <th>ID</th>
              <th>Nombre</th>
              <th>Correo</th>
              <th>Teléfono</th>
              <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
        @foreach ($clientes as $cliente)
          <tr>
            <td>{{ $cliente->id_cliente }}</td>
            <td>{{ $cliente->nombre }}</td>
            <td>{{ $cliente->correo }}</td>
            <td>{{ $cliente->telefono }}</td>
            <td class="actions">
              <a href="{{ route('clientes.show', $cliente->id_cliente) }}" class="btn btn-sm btn-info">Ver</a>
              <a href="{{ route('clientes.edit', $cliente->id_cliente) }}" class="btn btn-sm btn-warning">Editar</a>
              <form action="{{ route('clientes.destroy', $cliente->id_cliente) }}" method="POST" class="d-inline">
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