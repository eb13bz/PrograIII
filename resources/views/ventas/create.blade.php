@extends('layouts.app')

@section('content')
    <h1>Crear Nueva Venta</h1>
    <form action="{{ route('ventas.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label class="form-label">Cliente:</label><br>
            <select name="id_cliente" class="form-select" required>
                @foreach ($clientes as $cliente)
                    <option value="{{ $cliente->id_cliente }}">{{ $cliente->nombre }}</option>
                @endforeach
            </select>
        </div>
        <div class="mb-3">
            <label class="form-label">Usuario:</label><br>
            <select name="id_usuario" class="form-select" required>
                @foreach ($usuarios as $usuario)
                    <option value="{{ $usuario->id_usuario }}">{{ $usuario->nombre }}</option>
                @endforeach
            </select>
        </div>
        <div class="mb-3">
            <label class="form-label">Total:</label><br>
            <input type="number" step="0.01" name="total" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-primary">Guardar Venta</button>
        <a href="{{ route('ventas.index') }}" class="btn btn-secondary">Cancelar</a>
    </form>
@endsection