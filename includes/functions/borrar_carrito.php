<?php
require("conexion.php");

$id = $_POST["id"];
if (!isset($_SESSION)) {
    session_start();
}

if (isset($_POST["id"])) {
    /* Me es mas facil trabajar con el carrito asignandole una variable */
    $articulos = $_SESSION['carrito'];
    $numeroProducto = count($articulos);

    /* For para buscar en el carrito */
    foreach ($articulos as $key => $articulo) {
        if ($articulo['id_producto'] == $id) {
            unset($_SESSION['carrito'][$key]);
        }
    }

    if ($_SESSION['carrito'] == null) {
        unset($_SESSION['carrito']);
    }


    $data = array(
        'status'     => 'success',
        'code'         => 200,
        'message'     => 'Registro borrado'
    );
} else {
    $data = array(
        'status'     => 'error',
        'code'         => 400,
        'message'     => 'Error al borrar el registro.'
    );
}

echo json_encode($data);
