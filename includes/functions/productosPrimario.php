<?php
require("conexion.php");

$categoria = '';

if (isset($_POST['categoria'])) {
    $categoria = $_POST['categoria'];
}

if ($_POST['categoria'] == "") {
    $query = "";
    $salida = array();
    $query = "SELECT * FROM productos ORDER BY precio_unitario ASC LIMIT 5";
    $stmt = $cn->prepare($query);
    //$stmt->bindParam( ":categoria", $categoria, PDO::PARAM_STR);
    $stmt->execute();
    $resultado = $stmt->fetchAll();
} else {
    $query = "";
    $salida = array();
    $query = "SELECT * FROM productos WHERE categoria = :categoria ORDER BY precio_unitario ASC";
    $stmt = $cn->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
    $stmt = $cn->prepare($query);
    $stmt->bindParam(":categoria", $categoria, PDO::PARAM_STR);
    $stmt->execute();
    $resultado = $stmt->fetchAll();
}

echo json_encode($resultado);
