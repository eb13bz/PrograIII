<?php include __DIR__ . '/../includes/header.php'; include __DIR__ . '/../config/conexion.php'; ?>
<div class="actions">
  <a class="btn btn-primary" href="/clientes/crear.php">+ Nuevo Cliente</a>
</div>
<table class="table">
  <thead>
    <tr>
      <th>ID</th>
      <th>Nombre</th>
      <th>Correo</th>
      <th>Teléfono</th>
      <th>Acciones</th>
    </tr>
  </thead>
  <tbody>
<?php
$stmt = $pdo->query("SELECT * FROM clientes ORDER BY 1 DESC");
while ($row = $stmt->fetch()): ?>
<tr>
  <td><?= htmlspecialchars($row[array_key_first($row)]) ?></td>
  <td><?= htmlspecialchars($row['nombre']) ?></td>
  <td><?= htmlspecialchars($row['correo']) ?></td>
  <td><?= htmlspecialchars($row['telefono']) ?></td>
  <td class="actions">
    <a class="btn" href="/clientes/editar.php?id=<?= urlencode($row[array_key_first($row)]) ?>">Editar</a>
    <a class="btn btn-danger" href="/clientes/eliminar.php?id=<?= urlencode($row[array_key_first($row)]) ?>" onclick="return confirm('¿Eliminar registro?')">Eliminar</a>
  </td>
</tr>
<?php endwhile; ?>
  </tbody>
</table>
<?php include __DIR__ . '/../includes/footer.php'; ?>
