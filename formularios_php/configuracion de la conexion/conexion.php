<?php
// config/conexion.php
// ajusta tus datos Edu
$host = "localhost";
$port = "5432";
$dbname = "sistema_ventas";
$user = "postgres";
$password = "postgres"; // aca cambia tu pass Edu

try {
    $pdo = new PDO("pgsql:host=$host;port=$port;dbname=$dbname", $user, $password, [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    ]);
} catch (PDOException $e) {
    die("Error de conexión: " . $e->getMessage());
}
?>
