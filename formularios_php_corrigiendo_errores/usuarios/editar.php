
<?php
// === Validación de datos (inyectada) ===
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (!isset($errores) || !is_array($errores)) { $errores = []; }
    // Normalizar entradas
    $id = $_POST['id'] ?? null;
    $nombre = $_POST['nombre'] ?? null;
    $telefono = $_POST['telefono'] ?? null;
    $precio = $_POST['precio'] ?? null;

    if ($id !== null && filter_var($id, FILTER_VALIDATE_INT) === false) {
        $errores[] = "❌ El ID debe ser un número entero.";
    }
    if ($nombre !== null && !preg_match("/^[A-Za-zÁÉÍÓÚÑáéíóúñ\s]+$/u", $nombre)) {
        $errores[] = "❌ El nombre solo debe contener letras.";
    }
    if ($telefono !== null && filter_var($telefono, FILTER_VALIDATE_INT) === false) {
        $errores[] = "❌ El teléfono debe contener solo números enteros.";
    }
    if ($precio !== null && filter_var($precio, FILTER_VALIDATE_FLOAT) === false) {
        $errores[] = "❌ El precio debe ser un número decimal.";
    }

    // Si hay errores, impedir procesamiento posterior estableciendo un flag
    if (!empty($errores)) {
        $validacion_fallida = true;
    }
}
?>
 include __DIR__ . '/../includes/header.php'; include __DIR__ . '/../config/conexion.php';
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

<?php if (isset($errores) && !empty($errores)): ?>
<div style="background:#ffe6e6; border:1px solid #ff5c5c; color:#900; padding:12px; margin:12px 0; border-radius:8px;">
    <strong>Se encontraron errores:</strong>
    <ul style="margin:8px 0 0 18px;">
        <?php foreach ($errores as $e): ?>
            <li><?= htmlspecialchars($e) ?></li>
        <?php endforeach; ?>
    </ul>
</div>
<?php endif; ?>
<form method="post">
  <div class="form-grid">
    <div class="field">
      <label>Nombre</label>
      <input type="text" name="nombre" value="<?= htmlspecialchars($data['nombre']) ? type="text" pattern="[A-Za-zÁÉÍÓÚÑáéíóúñ\s]+" required title="Solo letras">" required>
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
