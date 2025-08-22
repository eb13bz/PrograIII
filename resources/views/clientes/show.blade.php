<h2>Detalles del Cliente</h2>
<p><strong>ID:</strong> {{ $cliente->id_cliente }}</p>
<p><strong>Nombre:</strong> {{ $cliente->nombre }}</p>
<p><strong>Correo:</strong> {{ $cliente->correo }}</p>
<p><strong>Teléfono:</strong> {{ $cliente->telefono }}</p>
<a href="{{ route('clientes.edit', $cliente->id_cliente) }}">Editar Cliente</a>
<a href="{{ route('clientes.index') }}">Volver a la lista</a>