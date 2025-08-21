<?php include __DIR__ . '/../includes/header.php'; include __DIR__ . '/../config/conexion.php';
$errores = [];
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nombre = trim($_POST['nombre'] ?? '');
    $usuario = trim($_POST['usuario'] ?? '');
    $contrasena = trim($_POST['contrasena'] ?? '');
    try {
        $sql = "INSERT INTO usuarios (nombre, usuario, contrasena) VALUES (:nombre, :usuario, :contrasena)";
        $stmt = $pdo->prepare($sql);
        $stmt->bindValue(':nombre', $nombre);
        $stmt->bindValue(':usuario', $usuario);
        $stmt->bindValue(':contrasena', $contrasena);
        $stmt->execute();
        header("Location: /usuarios/index.php");
        exit;
    } catch (Throwable $e) {
        $errores[] = $e->getMessage();
    }
}
?>
<h2>Crear Usuarios</h2>
<?php if($errores): ?><div class="small" style="color:#b91c1c;"><?='Errores: '.implode(' | ', $errores)?></div><?php endif; ?>
<form method="post">
  <div class="form-grid">
    <div class="field">
      <label>Nombre</label>
      <input type="text" name="nombre" required>
    </div>
    <div class="field">
      <label>Usuario</label>
      <input type="text" name="usuario" required>
    </div>
    <div class="field">
      <label>Contraseña</label>
      <input type="text" name="contrasena" required>
    </div>
  </div>
  <div class="actions">
    <button class="btn btn-primary" type="submit">Guardar</button>
    <a class="btn" href="index.php">Cancelar</a>
  </div>
</form>
<?php include __DIR__ . '/../includes/footer.php'; ?>
