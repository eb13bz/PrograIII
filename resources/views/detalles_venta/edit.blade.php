@extends('layouts.app')

@section('content')
    <h1>Editar Detalle de Venta #{{ $detalle->id_detalle }}</h1>
    <form action="{{ route('detalles_venta.update', $detalle->id_detalle) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label class="form-label">ID de Venta:</label><br>
            <input type="number" name="id_venta" value="{{ $detalle->id_venta }}" class="form-control" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Producto:</label><br>
            <select name="id_producto" class="form-select" required>
                @foreach ($productos as $producto)
                    <option value="{{ $producto->id }}" @if($producto->id == $detalle->id_producto) selected @endif>
                        {{ $producto->nombre }}
                    </option>
                @endforeach
            </select>
        </div>
        <div class="mb-3">
            <label class="form-label">Cantidad:</label><br>
            <input type="number" name="cantidad" value="{{ $detalle->cantidad }}" class="form-control" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Precio Unitario:</label><br>
            <input type="number" step="0.01" name="precio_unitario" value="{{ $detalle->precio_unitario }}" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-primary">Actualizar</button>
        <a href="{{ route('detalles_venta.index') }}" class="btn btn-secondary">Cancelar</a>
    </form>
@endsection