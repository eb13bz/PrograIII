@extends('layouts.app')

@section('content')
    <h1>Detalles del Detalle de Venta #{{ $detalle->id_detalle }}</h1>
    <p><strong>ID Venta:</strong> {{ $detalle->id_venta }}</p>
    <p><strong>Producto:</strong> {{ $detalle->producto->nombre }}</p>
    <p><strong>Cantidad:</strong> {{ $detalle->cantidad }}</p>
    <p><strong>Subtotal:</strong> ${{ $detalle->subtotal }}</p>
    <a href="{{ route('detalles_venta.edit', $detalle->id_detalle) }}" class="btn btn-warning">Editar Detalle</a>
    <a href="{{ route('detalles_venta.index') }}" class="btn btn-secondary">Volver a la lista</a>
@endsection