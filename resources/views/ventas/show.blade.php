@extends('layouts.app')

@section('content')
    <h1>Detalles de la Venta #{{ $venta->id_venta }}</h1>
    <p><strong>Total:</strong> ${{ $venta->total }}</p>
    <p><strong>Fecha:</strong> {{ $venta->fecha }}</p>
    <a href="{{ route('ventas.edit', $venta->id_venta) }}" class="btn btn-warning">Editar Venta</a>
    <a href="{{ route('ventas.index') }}" class="btn btn-secondary">Volver a la lista</a>
@endsection