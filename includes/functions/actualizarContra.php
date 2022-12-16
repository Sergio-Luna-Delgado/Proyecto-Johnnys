<?php
require("conexion.php");

$contra = $_POST['contra'];
$id = $_POST['id'];

$passwordHash = password_hash($contra, PASSWORD_BCRYPT);

$stmt = $cn->prepare("UPDATE usuarios SET contraseña = '$passwordHash' WHERE id_usuario = $id");
$resultado = $stmt->execute();

if($resultado){
    $data = array(
        'status' 	=> 'success',
        'code' 		=> 200,
        'message' 	=> 'Se actualizo la contraseña correctamente'
    );
}
else{
    $data = array(
        'status' 	=> 'error',
        'code' 		=> 400,
        'message' 	=> 'Hubo un error por favor intentar mas tarde'
    );
}

echo json_encode($data);