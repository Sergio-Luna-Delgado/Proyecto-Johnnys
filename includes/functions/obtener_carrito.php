<?php
require("conexion.php");
require("funciones.php");

$query = "";

if (!isset($_SESSION)) {
    session_start();
}

$resultado = $_SESSION['carrito'];
$numeroProducto = count($resultado);
$datos = array();
$filtered_rows = $numeroProducto;
foreach ($resultado as $fila) {
    $foto = '';
    if ($fila["foto"] != '') {
        $foto = '<div align="center"><img src="/pictures/' . $fila["foto"] . '" class="img-thumnail" width="140" height="76" /></div>';
    } else {
        $foto = '';
    }
    $sub_array = array();
    $sub_array[] = $fila["nombre_producto"];
    $sub_array[] = $foto;
    $sub_array[] = $fila["precio_unitario"];
    $sub_array[] = $fila["cantidad"];
    $sub_array[] = $fila["total"];
    $sub_array[] = '<button type="button" name="borrar" id="' . $fila["id_producto"] . '" class="btn btn-danger p-4 fs-3 borrarArticulo">Borrar</button>';
    $datos[] = $sub_array;
}

//esto es de datatable
$salida = array(
    "draw" => intval($_POST["draw"]),
    "recordsTotal" => $filtered_rows,
    "recordsFiltered" => $filtered_rows,
    "data" => $datos
);

echo json_encode($salida);
