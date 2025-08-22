@extends('layouts.app')

@section('content')
    <h1>Editar Venta #{{ $venta->id_venta }}</h1>
    <form action="{{ route('ventas.update', $venta->id_venta) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label class="form-label">Cliente:</label><br>
            <select name="id_cliente" class="form-select" required>
                @foreach ($clientes as $cliente)
                    <option value="{{ $cliente->id_cliente }}" @if($cliente->id_cliente == $venta->id_cliente) selected @endif>
                        {{ $cliente->nombre }}
                    </option>
                @endforeach
            </select>
        </div>
        <div class="mb-3">
            <label class="form-label">Usuario:</label><br>
            <select name="id_usuario" class="form-select" required>
                @foreach ($usuarios as $usuario)
                    <option value="{{ $usuario->id_usuario }}" @if($usuario->id_usuario == $venta->id_usuario) selected @endif>
                        {{ $usuario->nombre }}
                    </option>
                @endforeach
            </select>
        </div>
        <div class="mb-3">
            <label class="form-label">Total:</label><br>
            <input type="number" step="0.01" name="total" value="{{ $venta->total }}" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-primary">Actualizar Venta</button>
        <a href="{{ route('ventas.index') }}" class="btn btn-secondary">Cancelar</a>
    </form>
@endsection