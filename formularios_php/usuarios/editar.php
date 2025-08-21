<?php include __DIR__ . '/../includes/header.php'; include __DIR__ . '/../config/conexion.php';
$id = $_GET['id'] ?? null;
if (!$id) { die('ID requerido'); }
$errores = [];
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nombre = trim($_POST['nombre'] ?? '');
    $usuario = trim($_POST['usuario'] ?? '');
    $contrasena = trim($_POST['contrasena'] ?? '');
    try {
        $sql = "UPDATE usuarios SET nombre = :nombre, usuario = :usuario, contrasena = :contrasena WHERE id_usuario = :id";
        $stmt = $pdo->prepare($sql);
        $stmt->bindValue(':nombre', $nombre);
        $stmt->bindValue(':usuario', $usuario);
        $stmt->bindValue(':contrasena', $contrasena);
        $stmt->bindValue(':id', $id);
        $stmt->execute();
        header("Location: /usuarios/index.php");
        exit;
    } catch (Throwable $e) {
        $errores[] = $e->getMessage();
    }
}
$stmt = $pdo->prepare("SELECT * FROM usuarios WHERE id_usuario = :id");
$stmt->execute([':id' => $id]);
$data = $stmt->fetch();
if (!$data) { die('No encontrado'); }
?>
<h2>Editar Usuarios</h2>
<?php if($errores): ?><div class="small" style="color:#b91c1c;"><?='Errores: '.implode(' | ', $errores)?></div><?php endif; ?>
<form method="post">
  <div class="form-grid">
    <div class="field">
      <label>Nombre</label>
      <input type="text" name="nombre" value="<?= htmlspecialchars($data['nombre']) ?>" required>
    </div>
    <div class="field">
      <label>Usuario</label>
      <input type="text" name="usuario" value="<?= htmlspecialchars($data['usuario']) ?>" required>
    </div>
    <div class="field">
      <label>Contraseña</label>
      <input type="text" name="contrasena" value="<?= htmlspecialchars($data['contrasena']) ?>" required>
    </div>
  </div>
  <div class="actions">
    <button class="btn btn-primary" type="submit">Actualizar</button>
    <a class="btn" href="index.php">Cancelar</a>
  </div>
</form>
<?php include __DIR__ . '/../includes/footer.php'; ?>
