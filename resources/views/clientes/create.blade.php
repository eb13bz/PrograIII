<h2>Crear Clientes</h2>
<form action="{{ route('clientes.store') }}" method="POST">
    @csrf
    <div>
        <label>Nombre</label>
        <input type="text" name="nombre" required>
    </div>
    <div>
        <label>Correo</label>
        <input type="email" name="correo" required>
    </div>
    <div>
        <label>Teléfono</label>
        <input type="text" name="telefono" required>
    </div>
    <button type="submit">Guardar</button>
    <a href="{{ route('clientes.index') }}">Cancelar</a>
</form>