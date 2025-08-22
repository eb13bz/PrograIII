<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistema de Ventas</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="{{ url('/') }}">Mi App</a>
            <div class="collapse navbar-collapse">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ url('/categorias') }}">Categorías</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ url('/productos') }}">Productos</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ url('/clientes') }}">Clientes</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ url('/usuarios') }}">Usuarios</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ url('/ventas') }}">Ventas</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container mt-4">
        @yield('content')
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>