<?php include __DIR__ . '/../config/conexion.php';
$id = $_GET['id'] ?? null;
if (!$id) { die('ID requerido'); }
$pdo->beginTransaction();
try {
    // devolver stock antes de eliminar
    $stmt = $pdo->prepare("SELECT id_producto, cantidad FROM detalles_venta WHERE id_venta = :id");
    $stmt->execute([':id'=>$id]);
    foreach ($stmt->fetchAll() as $it) {
        $upd = $pdo->prepare("UPDATE productos SET stock = stock + :q WHERE id_producto = :p");
        $upd->execute([':q'=>$it['cantidad'], ':p'=>$it['id_producto']]);
    }
    $pdo->prepare("DELETE FROM ventas WHERE id_venta = :id")->execute([':id'=>$id]);
    $pdo->commit();
} catch (Throwable $e) {
    $pdo->rollBack();
}
header("Location: /ventas/index.php");
