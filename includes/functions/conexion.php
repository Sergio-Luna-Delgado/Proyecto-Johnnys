<?php

require __DIR__ . '/../../vendor/autoload.php';
$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->safeLoad(); /* Si un archivo no existe no marca error */

$db_host = $_ENV['DB_HOST'];
$db_name = $_ENV['DB_BD'];
$db_usuario = $_ENV['DB_USER'];
$db_contra = $_ENV['DB_PASS'];

try {
    $cn = new PDO("mysql:host=$db_host;dbname=$db_name;charset=utf8mb4", $db_usuario, $db_contra);
    // echo "<script>console.log('Conexion Exitosa');</script>";
} catch (PDOException $e) {
    echo "<script>console.log('Error en la conexion local: $e');</script>";
}
