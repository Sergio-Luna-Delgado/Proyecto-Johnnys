<?php
require("conexion.php");
require("funciones.php");

$query = "";
$salida = array();
$query = "SELECT * FROM auditar_productos ";

/* En PHP para concatenar es . */
if (isset($_POST["search"]["value"])) {
    $query .= 'WHERE nombre_producto LIKE "%' . $_POST["search"]["value"] . '%" ';
}

if (isset($_POST["order"])) {
    $query .= 'ORDER BY ' . $_POST['order']['0']['column'] . ' ' . $_POST["order"][0]["dir"] . ' ';
} else {
    $query .= 'ORDER BY id ASC ';
}

/* Al menos un registro */
if ($_POST["length"] != -1) {
    $query .= 'LIMIT ' . $_POST["start"] . ',' . $_POST["length"];
}

$stmt = $cn->prepare($query);
$stmt->execute();
$resultado = $stmt->fetchAll();
$datos = array();
$filtered_rows = $stmt->rowCount();
foreach ($resultado as $fila) {
    $sub_array = array();
    $sub_array[] = $fila["id"];
    $sub_array[] = $fila["nombre_producto"];
    $sub_array[] = $fila["descripcion"];
    $sub_array[] = $fila["precio_unitario"];
    $sub_array[] = $fila["inventario"];
    $sub_array[] = $fila["promocion"];
    $sub_array[] = $fila["accion"];
    $sub_array[] = $fila["fecha"];
    $datos[] = $sub_array;
}

/* Esto es de datatable */
$salida = array(
    "draw" => intval($_POST["draw"]),
    "recordsTotal" => $filtered_rows,
    "recordsFiltered" => todo("auditar_productos"),
    "data" => $datos
);

echo json_encode($salida);
