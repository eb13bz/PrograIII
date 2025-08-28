<?php include __DIR__ . '/../includes/header.php'; include __DIR__ . '/../config/conexion.php';
$id = $_GET['id'] ?? null;
if (!$id) { die('ID requerido'); }
$sql = "SELECT v.*, c.nombre AS cliente, u.usuario AS usuario
        FROM ventas v
        JOIN clientes c ON c.id_cliente = v.id_cliente
        JOIN usuarios u ON u.id_usuario = v.id_usuario
        WHERE v.id_venta = :id";
$stmt = $pdo->prepare($sql);
$stmt->execute([':id'=>$id]);
$v = $stmt->fetch();
if (!$v) { die('No encontrado'); }
$det = $pdo->prepare("SELECT d.*, p.nombre FROM detalles_venta d JOIN productos p ON p.id_producto = d.id_producto WHERE d.id_venta = :id");
$det->execute([':id'=>$id]);
$items = $det->fetchAll();
?>
<h2>Venta #<?= $v['id_venta'] ?></h2>
<p><b>Cliente:</b> <?= htmlspecialchars($v['cliente']) ?> | <b>Usuario:</b> <?= htmlspecialchars($v['usuario']) ?> | <b>Fecha:</b> <?= $v['fecha'] ?></p>
<p><b>Total:</b> <span class="badge">Bs <?= number_format($v['total'],2) ?></span></p>
<table class="table">
  <thead><tr><th>Producto</th><th>Cantidad</th><th>Precio Unitario</th><th>Subtotal</th></tr></thead>
  <tbody>
  <?php foreach($items as $it): ?>
    <tr>
      <td><?= htmlspecialchars($it['nombre']) ?></td>
      <td><?= $it['cantidad'] ?></td>
      <td>Bs <?= number_format($it['precio_unitario'],2) ?></td>
      <td>Bs <?= number_format($it['cantidad']*$it['precio_unitario'],2) ?></td>
    </tr>
  <?php endforeach; ?>
  </tbody>
</table>
<div class="actions">
  <a class="btn" href="/ventas/index.php">Volver</a>
</div>
<?php include __DIR__ . '/../includes/footer.php'; ?>
