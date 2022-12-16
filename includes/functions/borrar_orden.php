<?php
require("conexion.php");
require("funciones.php");

$id = $_POST['id'];

$stmt = $cn->prepare("UPDATE pedidos SET estatus = 'Completado' WHERE id_pedido = $id");

$resultado = $stmt->execute();

if ($resultado) {
    $data = array(
        'status'     => 'success',
        'code'         => 200,
        'message'     => 'El producto se ha competado correctamente'
    );
} else {
    $data = array(
        'status'     => 'error',
        'code'       => 404,
        'message'    => 'Error al momento de completar mi pedido'
    );
}

echo json_encode($data);
