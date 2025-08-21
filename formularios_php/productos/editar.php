<?php include __DIR__ . '/../includes/header.php'; include __DIR__ . '/../config/conexion.php';
$id = $_GET['id'] ?? null;
if (!$id) { die('ID requerido'); }
$errores = [];
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nombre = trim($_POST['nombre'] ?? '');
    $precio = trim($_POST['precio'] ?? '');
    $stock = trim($_POST['stock'] ?? '');
    try {
        $sql = "UPDATE productos SET nombre = :nombre, precio = :precio, stock = :stock WHERE id_producto = :id";
        $stmt = $pdo->prepare($sql);
        $stmt->bindValue(':nombre', $nombre);
        $stmt->bindValue(':precio', $precio);
        $stmt->bindValue(':stock', $stock);
        $stmt->bindValue(':id', $id);
        $stmt->execute();
        header("Location: /productos/index.php");
        exit;
    } catch (Throwable $e) {
        $errores[] = $e->getMessage();
    }
}
$stmt = $pdo->prepare("SELECT * FROM productos WHERE id_producto = :id");
$stmt->execute([':id' => $id]);
$data = $stmt->fetch();
if (!$data) { die('No encontrado'); }
?>
<h2>Editar Productos</h2>
<?php if($errores): ?><div class="small" style="color:#b91c1c;"><?='Errores: '.implode(' | ', $errores)?></div><?php endif; ?>
<form method="post">
  <div class="form-grid">
    <div class="field">
      <label>Nombre</label>
      <input type="text" name="nombre" value="<?= htmlspecialchars($data['nombre']) ?>" required>
    </div>
    <div class="field">
      <label>Precio</label>
      <input type="number" name="precio" value="<?= htmlspecialchars($data['precio']) ?>" required step="0.01">
    </div>
    <div class="field">
      <label>Stock</label>
      <input type="number" name="stock" value="<?= htmlspecialchars($data['stock']) ?>" required>
    </div>
  </div>
  <div class="actions">
    <button class="btn btn-primary" type="submit">Actualizar</button>
    <a class="btn" href="index.php">Cancelar</a>
  </div>
</form>
<?php include __DIR__ . '/../includes/footer.php'; ?>
