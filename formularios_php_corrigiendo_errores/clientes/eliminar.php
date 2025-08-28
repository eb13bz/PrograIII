<?php include __DIR__ . '/../config/conexion.php';
$id = $_GET['id'] ?? null;
if (!$id) { die('ID requerido'); }
$stmt = $pdo->prepare("DELETE FROM clientes WHERE id_cliente = :id");
$stmt->execute([':id' => $id]);
header("Location: /clientes/index.php");
