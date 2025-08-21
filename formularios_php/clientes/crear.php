<?php include __DIR__ . '/../includes/header.php'; include __DIR__ . '/../config/conexion.php';
$errores = [];
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nombre = trim($_POST['nombre'] ?? '');
    $correo = trim($_POST['correo'] ?? '');
    $telefono = trim($_POST['telefono'] ?? '');
    try {
        $sql = "INSERT INTO clientes (nombre, correo, telefono) VALUES (:nombre, :correo, :telefono)";
        $stmt = $pdo->prepare($sql);
        $stmt->bindValue(':nombre', $nombre);
        $stmt->bindValue(':correo', $correo);
        $stmt->bindValue(':telefono', $telefono);
        $stmt->execute();
        header("Location: /clientes/index.php");
        exit;
    } catch (Throwable $e) {
        $errores[] = $e->getMessage();
    }
}
?>
<h2>Crear Clientes</h2>
<?php if($errores): ?><div class="small" style="color:#b91c1c;"><?='Errores: '.implode(' | ', $errores)?></div><?php endif; ?>
<form method="post">
  <div class="form-grid">
    <div class="field">
      <label>Nombre</label>
      <input type="text" name="nombre" required>
    </div>
    <div class="field">
      <label>Correo</label>
      <input type="email" name="correo" required>
    </div>
    <div class="field">
      <label>Teléfono</label>
      <input type="text" name="telefono" required>
    </div>
  </div>
  <div class="actions">
    <button class="btn btn-primary" type="submit">Guardar</button>
    <a class="btn" href="index.php">Cancelar</a>
  </div>
</form>
<?php include __DIR__ . '/../includes/footer.php'; ?>
