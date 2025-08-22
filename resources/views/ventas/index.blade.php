@extends('layouts.app')

@section('content')
    <h1>Lista de Ventas</h1>
    <a href="{{ route('ventas.create') }}" class="btn btn-primary">Crear Nueva Venta</a>
    <table class="table table-striped mt-3">
        <thead>
            <tr>
                <th>ID</th>
                <th>Total</th>
                <th>Fecha</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
        @foreach ($ventas as $venta)
            <tr>
                <td>{{ $venta->id_venta }}</td>
                <td>${{ $venta->total }}</td>
                <td>{{ $venta->fecha }}</td>
                <td>
                    <a href="{{ route('ventas.show', $venta->id_venta) }}" class="btn btn-sm btn-info">Ver Detalles</a>
                    <a href="{{ route('ventas.edit', $venta->id_venta) }}" class="btn btn-sm btn-warning">Editar</a>
                    <form action="{{ route('ventas.destroy', $venta->id_venta) }}" method="POST" class="d-inline">
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