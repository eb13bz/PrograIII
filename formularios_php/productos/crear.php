<?php include __DIR__ . '/../includes/header.php'; include __DIR__ . '/../config/conexion.php';
$errores = [];
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nombre = trim($_POST['nombre'] ?? '');
    $precio = trim($_POST['precio'] ?? '');
    $stock = trim($_POST['stock'] ?? '');
    try {
        $sql = "INSERT INTO productos (nombre, precio, stock) VALUES (:nombre, :precio, :stock)";
        $stmt = $pdo->prepare($sql);
        $stmt->bindValue(':nombre', $nombre);
        $stmt->bindValue(':precio', $precio);
        $stmt->bindValue(':stock', $stock);
        $stmt->execute();
        header("Location: /productos/index.php");
        exit;
    } catch (Throwable $e) {
        $errores[] = $e->getMessage();
    }
}
?>
<h2>Crear Productos</h2>
<?php if($errores): ?><div class="small" style="color:#b91c1c;"><?='Errores: '.implode(' | ', $errores)?></div><?php endif; ?>
<form method="post">
  <div class="form-grid">
    <div class="field">
      <label>Nombre</label>
      <input type="text" name="nombre" required>
    </div>
    <div class="field">
      <label>Precio</label>
      <input type="number" name="precio" required step="0.01">
    </div>
    <div class="field">
      <label>Stock</label>
      <input type="number" name="stock" required>
    </div>
  </div>
  <div class="actions">
    <button class="btn btn-primary" type="submit">Guardar</button>
    <a class="btn" href="index.php">Cancelar</a>
  </div>
</form>
<?php include __DIR__ . '/../includes/footer.php'; ?>
