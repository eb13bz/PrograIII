<?php include __DIR__ . '/../config/conexion.php';
$id = $_GET['id'] ?? null;
if (!$id) { die('ID requerido'); }
$stmt = $pdo->prepare("DELETE FROM productos WHERE id_producto = :id");
$stmt->execute([':id' => $id]);
header("Location: /productos/index.php");
