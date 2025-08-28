
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
 include __DIR__ . '/../includes/header.php'; include __DIR__ . '/../config/conexion.php'; ?>
<h2>Nueva Venta</h2>
<?php
$clientes = $pdo->query("SELECT id_cliente, nombre FROM clientes ORDER BY nombre")->fetchAll();
$usuarios = $pdo->query("SELECT id_usuario, usuario FROM usuarios ORDER BY usuario")->fetchAll();
$productos = $pdo->query("SELECT id_producto, nombre, precio, stock FROM productos ORDER BY nombre")->fetchAll();
$errores = [];
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id_cliente = $_POST['id_cliente'] ?? null;
    $id_usuario = $_POST['id_usuario'] ?? null;
    $items = $_POST['items'] ?? [];
    if (!$id_cliente || !$id_usuario || empty($items)) {
        $errores[] = "Cliente, Usuario e Ítems son obligatorios";
    } else {
        try {
            $pdo->beginTransaction();
            // calcular total
            $total = 0;
            foreach ($items as $it) {
                if (empty($it['id_producto']) || empty($it['cantidad']) || empty($it['precio_unitario'])) continue;
                $total += floatval($it['cantidad']) * floatval($it['precio_unitario']);
            }
            $stmt = $pdo->prepare("INSERT INTO ventas (id_cliente, id_usuario, total) VALUES (:c, :u, :t) RETURNING id_venta");
            $stmt->execute([':c'=>$id_cliente, ':u'=>$id_usuario, ':t'=>$total]);
            $id_venta = $stmt->fetchColumn();
            // detalles
            $stmtD = $pdo->prepare("INSERT INTO detalles_venta (id_venta, id_producto, cantidad, precio_unitario) VALUES (:v,:p,:q,:pu)");
            foreach ($items as $it) {
                if (empty($it['id_producto']) || empty($it['cantidad']) || empty($it['precio_unitario'])) continue;
                $stmtD->execute([
                    ':v'=>$id_venta,
                    ':p'=>$it['id_producto'],
                    ':q'=>$it['cantidad'],
                    ':pu'=>$it['precio_unitario'],
                ]);
                // descontar stock
                $upd = $pdo->prepare("UPDATE productos SET stock = stock - :q WHERE id_producto = :p AND stock >= :q");
                $upd->execute([':q'=>$it['cantidad'], ':p'=>$it['id_producto']]);
            }
            $pdo->commit();
            header("Location: /ventas/ver.php?id=".$id_venta);
            exit;
        } catch (Throwable $e) {
            $pdo->rollBack();
            $errores[] = $e->getMessage();
        }
    }
}
?>
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
        <option value="">-- Seleccione --</option>
        <?php foreach($clientes as $c): ?>
        <option value="<?= $c['id_cliente'] ?>"><?= htmlspecialchars($c['nombre']) ?></option>
        <?php endforeach; ?>
      </select>
    </div>
    <div class="field">
      <label>Usuario</label>
      <select name="id_usuario" required>
        <option value="">-- Seleccione --</option>
        <?php foreach($usuarios as $u): ?>
        <option value="<?= $u['id_usuario'] ?>"><?= htmlspecialchars($u['usuario']) ?></option>
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
    <button class="btn btn-primary" type="submit">Guardar Venta</button>
    <a class="btn" href="/ventas/index.php">Cancelar</a>
  </div>
</form>
<script>
const productos = <?php echo json_encode($productos); ?>;
function filaHTML(i){
  return `
  <div class="form-grid" style="border:1px solid #e5e7eb; padding:12px; border-radius:10px; margin-bottom:10px;">
    <div class="field">
      <label>Producto</label>
      <select name="items[${i}][id_producto]" required onchange="syncPrecio(${i}, this.value)">
        <option value="">-- Seleccione --</option>
        ${productos.map(p => `<option value="${p.id_producto}" data-precio="${p.precio}">${p.nombre} (Bs ${p.precio}) - Stock: ${p.stock}</option>`).join('')}
      </select>
    </div>
    <div class="field">
      <label>Cantidad</label>
      <input type="number" min="1" name="items[${i}][cantidad]" required>
    </div>
    <div class="field">
      <label>Precio Unitario</label>
      <input type="number" step="0.01" min="0" name="items[${i}][precio_unitario]" required>
    </div>
  </div>`;
}
let idx = 0;
function agregarFila(){ 
  const cont = document.getElementById('items');
  cont.insertAdjacentHTML('beforeend', filaHTML(idx));
  idx++;
}
function syncPrecio(i, val){
  const sel = document.querySelector(`select[name="items[${i}][id_producto]"]`);
  const precio = sel.options[sel.selectedIndex].getAttribute('data-precio');
  const precioInput = document.querySelector(`input[name="items[${i}][precio_unitario]"]`);
  if (precio && precioInput) precioInput.value = precio;
}
agregarFila();
</script>
<?php include __DIR__ . '/../includes/footer.php'; ?>
