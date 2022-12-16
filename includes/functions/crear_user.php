<?php

require("conexion.php");

$id = '';
$Nombre_Usuario = $_POST["nombre_usuario"];
$Apellido_Usuario = $_POST["apellido_usuario"];
$Correo = $_POST["correo"];
$Direccion = $_POST["direccion"];
$Contra = $_POST["contraseña_user"];
$passwordHash = password_hash($Contra, PASSWORD_BCRYPT);

$stmt = $cn->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
$stmt = $cn->prepare("SELECT * FROM usuarios WHERE correo = :correo");
$stmt->bindParam(":correo", $Correo, PDO::PARAM_STR);
$stmt->execute();
$resultado = $stmt->fetchAll();

if(!empty($resultado)){
    $data = array(
        'status'     => 'warning',
        'code'       => 400,
        'message'    => 'El correo ya esta registrado en otra cuenta.'
    );
}
else{
    $stmt = $cn->prepare("INSERT INTO usuarios(id_usuario, nombre_usuario, apellido_usuario, direccion, correo, contraseña) VALUES(:id, :nombre, :apellido, :direccion, :correo, '$passwordHash')");
    $stmt->bindParam(":id", $id, PDO::PARAM_INT);
    $stmt->bindParam(":nombre", $Nombre_Usuario, PDO::PARAM_STR);
    $stmt->bindParam(":apellido", $Apellido_Usuario, PDO::PARAM_STR);
    $stmt->bindParam(":direccion", $Direccion, PDO::PARAM_STR);
    $stmt->bindParam(":correo", $Correo, PDO::PARAM_STR);
    $resultado = $stmt->execute();
    
    if (!empty($resultado)) {
        $data = array(
            'status'     => 'success',
            'code'       => 200,
            'message'    => 'Tu cuenta se ha creado exitosamente, por favor inicia sesión llenando tu correo y tu contraseña.'
        );
    } else {
        $data = array(
            'status'     => 'error',
            'code'       => 404,
            'message'    => 'La solicitud no se pudo enviar, favor de intentarlo más tarde.'
        );
    }
}

echo json_encode($data);