<?php include __DIR__ . '/../includes/header.php'; include __DIR__ . '/../config/conexion.php'; ?>
<div class="actions">
  <a class="btn btn-primary" href="/usuarios/crear.php">+ Nuevo Usuario</a>
</div>
<table class="table">
  <thead>
    <tr>
      <th>ID</th>
      <th>Nombre</th>
      <th>Usuario</th>
      <th>Contraseña</th>
      <th>Acciones</th>
    </tr>
  </thead>
  <tbody>
<?php
$stmt = $pdo->query("SELECT * FROM usuarios ORDER BY 1 DESC");
while ($row = $stmt->fetch()): ?>
<tr>
  <td><?= htmlspecialchars($row[array_key_first($row)]) ?></td>
  <td><?= htmlspecialchars($row['nombre']) ?></td>
  <td><?= htmlspecialchars($row['usuario']) ?></td>
  <td><?= htmlspecialchars($row['contrasena']) ?></td>
  <td class="actions">
    <a class="btn" href="/usuarios/editar.php?id=<?= urlencode($row[array_key_first($row)]) ?>">Editar</a>
    <a class="btn btn-danger" href="/usuarios/eliminar.php?id=<?= urlencode($row[array_key_first($row)]) ?>" onclick="return confirm('¿Eliminar registro?')">Eliminar</a>
  </td>
</tr>
<?php endwhile; ?>
  </tbody>
</table>
<?php include __DIR__ . '/../includes/footer.php'; ?>
