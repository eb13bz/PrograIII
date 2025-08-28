<?php include __DIR__ . '/../includes/header.php'; include __DIR__ . '/../config/conexion.php'; ?>
<div class="actions">
  <a class="btn btn-primary" href="/ventas/crear.php">+ Nueva Venta</a>
</div>
<table class="table">
  <thead>
    <tr><th>ID</th><th>Cliente</th><th>Usuario</th><th>Fecha</th><th>Total</th><th>Acciones</th></tr>
  </thead>
  <tbody>
<?php
$sql = "SELECT v.id_venta, c.nombre AS cliente, u.usuario AS usuario, v.fecha, v.total
        FROM ventas v
        JOIN clientes c ON c.id_cliente = v.id_cliente
        JOIN usuarios u ON u.id_usuario = v.id_usuario
        ORDER BY v.id_venta DESC";
foreach ($pdo->query($sql) as $row): ?>
<tr>
  <td><?= $row['id_venta'] ?></td>
  <td><?= htmlspecialchars($row['cliente']) ?></td>
  <td><?= htmlspecialchars($row['usuario']) ?></td>
  <td><?= htmlspecialchars($row['fecha']) ?></td>
  <td><span class="badge">Bs <?= number_format($row['total'], 2) ?></span></td>
  <td class="actions">
    <a class="btn" href="/ventas/ver.php?id=<?= $row['id_venta'] ?>">Ver</a>
    <a class="btn" href="/ventas/editar.php?id=<?= $row['id_venta'] ?>">Editar</a>
    <a class="btn btn-danger" href="/ventas/eliminar.php?id=<?= $row['id_venta'] ?>" onclick="return confirm('¿Eliminar venta?')">Eliminar</a>
  </td>
</tr>
<?php endforeach; ?>
  </tbody>
</table>
<?php include __DIR__ . '/../includes/footer.php'; ?>
