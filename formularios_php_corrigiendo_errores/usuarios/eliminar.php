<?php include __DIR__ . '/../config/conexion.php';
$id = $_GET['id'] ?? null;
if (!$id) { die('ID requerido'); }
$stmt = $pdo->prepare("DELETE FROM usuarios WHERE id_usuario = :id");
$stmt->execute([':id' => $id]);
header("Location: /usuarios/index.php");
