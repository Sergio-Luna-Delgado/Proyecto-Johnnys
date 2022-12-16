<?php
require("conexion.php");
require("funciones.php");

if (!isset($_SESSION)) {
    session_start();
}

$id_usuario = $_SESSION['login_user_id'];

$query = "";
$salida = array();
$query = "SELECT Pr.nombre_producto, Pr.foto, Pr.precio_unitario, Pe.cantidad, Pe.total, Pe.codigo FROM pedidos Pe, productos Pr, usuarios U ";

/* En PHP para concatenar es . */
if (isset($_POST["search"]["value"])) {
    $query .= 'WHERE Pe.estatus != "Completado" AND Pe.id_usuario = ' . $id_usuario;
    $query .= ' AND Pr.nombre_producto LIKE "%' . $_POST["search"]["value"] . '%" ';
    $query .= 'AND Pe.id_producto = Pr.id_producto AND Pe.id_usuario = U.id_usuario ';
}

if (isset($_POST["order"])) {
    $query .= 'ORDER BY ' . $_POST['order']['0']['column'] . ' ' . $_POST["order"][0]["dir"] . ' ';
} else {
    $query .= 'ORDER BY Pe.id_pedido ASC ';
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
    $sub_array[] = $fila["codigo"];
    $datos[] = $sub_array;
}

/* Esto es de datatable */
$salida = array(
    "draw" => intval($_POST["draw"]),
    "recordsTotal" => $filtered_rows,
    "recordsFiltered" => todo("pedidos"),
    "data" => $datos
);

echo json_encode($salida);
