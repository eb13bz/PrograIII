@extends('layouts.app')

@section('content')
    <h1>Lista de Detalles de Venta</h1>
    <a href="{{ route('detalles_venta.create') }}" class="btn btn-primary">Crear Nuevo Detalle</a>
    <table class="table table-striped mt-3">
        <thead>
            <tr>
                <th>ID Detalle</th>
                <th>ID Venta</th>
                <th>ID Producto</th>
                <th>Cantidad</th>
                <th>Subtotal</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
        @foreach ($detalles as $detalle)
            <tr>
                <td>{{ $detalle->id_detalle }}</td>
                <td>{{ $detalle->id_venta }}</td>
                <td>{{ $detalle->id_producto }}</td>
                <td>{{ $detalle->cantidad }}</td>
                <td>${{ $detalle->subtotal }}</td>
                <td>
                    <a href="{{ route('detalles_venta.show', $detalle->id_detalle) }}" class="btn btn-sm btn-info">Ver</a>
                    <a href="{{ route('detalles_venta.edit', $detalle->id_detalle) }}" class="btn btn-sm btn-warning">Editar</a>
                    <form action="{{ route('detalles_venta.destroy', $detalle->id_detalle) }}" method="POST" class="d-inline">
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