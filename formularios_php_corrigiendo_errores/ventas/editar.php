
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
$clientes = $pdo->query("SELECT id_cliente, nombre FROM clientes ORDER BY nombre")->fetchAll();
$usuarios = $pdo->query("SELECT id_usuario, usuario FROM usuarios ORDER BY usuario")->fetchAll();
$productos = $pdo->query("SELECT id_producto, nombre, precio, stock FROM productos ORDER BY nombre")->fetchAll();
$errores = [];
// cargar venta + detalles
$stmt = $pdo->prepare("SELECT * FROM ventas WHERE id_venta = :id");
$stmt->execute([':id'=>$id]);
$venta = $stmt->fetch();
if (!$venta) { die('No encontrado'); }
$detA = $pdo->prepare("SELECT * FROM detalles_venta WHERE id_venta = :id");
$detA->execute([':id'=>$id]);
$itemsOld = $detA->fetchAll();
if ($_SERVER['REQUEST_METHOD']==='POST') {
    $id_cliente = $_POST['id_cliente'] ?? null;
    $id_usuario = $_POST['id_usuario'] ?? null;
    $items = $_POST['items'] ?? [];
    try {
        $pdo->beginTransaction();
        // devolver stock de items viejos
        foreach ($itemsOld as $it) {
            $pdo->prepare("UPDATE productos SET stock = stock + :q WHERE id_producto = :p")->execute([':q'=>$it['cantidad'], ':p'=>$it['id_producto']]);
        }
        // borrar detalles
        $pdo->prepare("DELETE FROM detalles_venta WHERE id_venta = :id")->execute([':id'=>$id]);
        // insertar nuevos + recalcular total + descontar stock
        $total = 0;
        $stmtD = $pdo->prepare("INSERT INTO detalles_venta (id_venta, id_producto, cantidad, precio_unitario) VALUES (:v,:p,:q,:pu)");
        foreach ($items as $it) {
            if (empty($it['id_producto']) || empty($it['cantidad']) || empty($it['precio_unitario'])) continue;
            $total += floatval($it['cantidad']) * floatval($it['precio_unitario']);
            $stmtD->execute([
                ':v'=>$id, ':p'=>$it['id_producto'], ':q'=>$it['cantidad'], ':pu'=>$it['precio_unitario']
            ]);
            $pdo->prepare("UPDATE productos SET stock = stock - :q WHERE id_producto = :p")->execute([':q'=>$it['cantidad'], ':p'=>$it['id_producto']]);
        }
        $pdo->prepare("UPDATE ventas SET id_cliente = :c, id_usuario = :u, total = :t WHERE id_venta = :id")->execute([':c'=>$id_cliente, ':u'=>$id_usuario, ':t'=>$total, ':id'=>$id]);
        $pdo->commit();
        header("Location: /ventas/ver.php?id=".$id);
        exit;
    } catch (Throwable $e) {
        $pdo->rollBack();
        $errores[] = $e->getMessage();
    }
}
?>
<h2>Editar Venta #<?= $venta['id_venta'] ?></h2>
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
<form method="post" id="venta-form">
  <div class="form-grid">
    <div class="field">
      <label>Cliente</label>
      <select name="id_cliente" required>
        <?php foreach($clientes as $c): ?>
        <option value="<?= $c['id_cliente'] ?>" <?= $c['id_cliente']==$venta['id_cliente']?'selected':'' ?>><?= htmlspecialchars($c['nombre']) ?></option>
        <?php endforeach; ?>
      </select>
    </div>
    <div class="field">
      <label>Usuario</label>
      <select name="id_usuario" required>
        <?php foreach($usuarios as $u): ?>
        <option value="<?= $u['id_usuario'] ?>" <?= $u['id_usuario']==$venta['id_usuario']?'selected':'' ?>><?= htmlspecialchars($u['usuario']) ?></option>
        <?php endforeach; ?>
      </select>
    </div>
  </div>
  <hr>
  <h3>Ítems</h3>
  <div id="items"></div>
  <button class="btn" type="button" onclick="agregarFila()">+ Agregar ítem</button>
  <hr>
  <div class="actions">
    <button class="btn btn-primary" type="submit">Guardar Cambios</button>
    <a class="btn" href="/ventas/index.php">Cancelar</a>
  </div>
</form>
<script>
const productos = <?php echo json_encode($productos); ?>;
const itemsOld = <?php echo json_encode($itemsOld); ?>;
function filaHTML(i, preset){
  const pid = preset?.id_producto || "";
  const qty = preset?.cantidad || "";
  const pu = preset?.precio_unitario || "";
  return `
  <div class="form-grid" style="border:1px solid #e5e7eb; padding:12px; border-radius:10px; margin-bottom:10px;">
    <div class="field">
      <label>Producto</label>
      <select name="items[${i}][id_producto]" required onchange="syncPrecio(${i}, this.value)">
        <option value="">-- Seleccione --</option>
        ${productos.map(p => `<option value="${p.id_producto}" data-precio="${p.precio}" ${'${p.id_producto}'==pid?'selected':''}>${p.nombre} (Bs ${p.precio}) - Stock: ${p.stock}</option>`).join('')}
      </select>
    </div>
    <div class="field">
      <label>Cantidad</label>
      <input type="number" min="1" name="items[${i}][cantidad]" value="${qty}" required>
    </div>
    <div class="field">
      <label>Precio Unitario</label>
      <input type="number" step="0.01" min="0" name="items[${i}][precio_unitario]" value="${pu}" required>
    </div>
  </div>`;
}
let idx = 0;
function agregarFila(preset=null){ 
  const cont = document.getElementById('items');
  cont.insertAdjacentHTML('beforeend', filaHTML(idx, preset));
  idx++;
}
function syncPrecio(i, val){
  const sel = document.querySelector(`select[name="items[${i}][id_producto]"]`);
  const precio = sel.options[sel.selectedIndex].getAttribute('data-precio');
  const precioInput = document.querySelector(`input[name="items[${i}][precio_unitario]"]`);
  if (precio && precioInput) precioInput.value = precio;
}
itemsOld.forEach(p => agregarFila(p));
</script>
<?php include __DIR__ . '/../includes/footer.php'; ?>
