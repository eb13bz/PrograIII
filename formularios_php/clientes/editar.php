<?php include __DIR__ . '/../includes/header.php'; include __DIR__ . '/../config/conexion.php';
$id = $_GET['id'] ?? null;
if (!$id) { die('ID requerido'); }
$errores = [];
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nombre = trim($_POST['nombre'] ?? '');
    $correo = trim($_POST['correo'] ?? '');
    $telefono = trim($_POST['telefono'] ?? '');
    try {
        $sql = "UPDATE clientes SET nombre = :nombre, correo = :correo, telefono = :telefono WHERE id_cliente = :id";
        $stmt = $pdo->prepare($sql);
        $stmt->bindValue(':nombre', $nombre);
        $stmt->bindValue(':correo', $correo);
        $stmt->bindValue(':telefono', $telefono);
        $stmt->bindValue(':id', $id);
        $stmt->execute();
        header("Location: /clientes/index.php");
        exit;
    } catch (Throwable $e) {
        $errores[] = $e->getMessage();
    }
}
$stmt = $pdo->prepare("SELECT * FROM clientes WHERE id_cliente = :id");
$stmt->execute([':id' => $id]);
$data = $stmt->fetch();
if (!$data) { die('No encontrado'); }
?>
<h2>Editar Clientes</h2>
<?php if($errores): ?><div class="small" style="color:#b91c1c;"><?='Errores: '.implode(' | ', $errores)?></div><?php endif; ?>
<form method="post">
  <div class="form-grid">
    <div class="field">
      <label>Nombre</label>
      <input type="text" name="nombre" value="<?= htmlspecialchars($data['nombre']) ?>" required>
    </div>
    <div class="field">
      <label>Correo</label>
      <input type="email" name="correo" value="<?= htmlspecialchars($data['correo']) ?>" required>
    </div>
    <div class="field">
      <label>Teléfono</label>
      <input type="text" name="telefono" value="<?= htmlspecialchars($data['telefono']) ?>" required>
    </div>
  </div>
  <div class="actions">
    <button class="btn btn-primary" type="submit">Actualizar</button>
    <a class="btn" href="index.php">Cancelar</a>
  </div>
</form>
<?php include __DIR__ . '/../includes/footer.php'; ?>
