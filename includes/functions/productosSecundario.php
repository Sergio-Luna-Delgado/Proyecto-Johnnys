<?php
include("conexion.php");

$categoria = '';

if (isset($_POST['categoria'])) {
    $categoria = $_POST['categoria'];
}

if ($_POST['categoria'] == "") {
    $query = "";
    $salida = array();
    $query = "SELECT * FROM productos order by id_producto DESC LIMIT 5";

    $stmt = $cn->prepare($query);
    $stmt->execute();
    $resultado = $stmt->fetchAll();

    echo json_encode($resultado);
}
