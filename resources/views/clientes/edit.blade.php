<h2>Editar Clientes</h2>
<form action="{{ route('clientes.update', $cliente->id_cliente) }}" method="POST">
    @csrf
    @method('PUT')
    <div>
        <label>Nombre</label>
        <input type="text" name="nombre" value="{{ old('nombre', $cliente->nombre) }}" required>
    </div>
    <div>
        <label>Correo</label>
        <input type="email" name="correo" value="{{ old('correo', $cliente->correo) }}" required>
    </div>
    <div>
        <label>Teléfono</label>
        <input type="text" name="telefono" value="{{ old('telefono', $cliente->telefono) }}" required>
    </div>
    <button type="submit">Actualizar</button>
    <a href="{{ route('clientes.index') }}">Cancelar</a>
</form>