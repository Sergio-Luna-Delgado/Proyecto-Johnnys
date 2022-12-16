<?php
require("conexion.php");

$email = $_POST['correo'];
$password = $_POST['contraseña'];
$rol = $_POST['rol'];

$stmt = $cn->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
$stmt = $cn->prepare("SELECT * FROM $rol WHERE correo = :email");
$stmt->bindParam(":email", $email, PDO::PARAM_STR);
$stmt->execute();
$resultado = $stmt->fetchAll(PDO::FETCH_ASSOC);

if (!empty($resultado)) {
    $auth = password_verify($password, $resultado[0]['contraseña']);
    if($auth){
        session_start();
        if($rol === 'administradores'){
            $_SESSION['login_admin'] = true;
            $data = array(
                'status'    => 'success',
                'code'      => 200,
                'message'   => 'Bienvenido administrador'
            );
        }
        else if($rol === 'usuarios'){
            $_SESSION['login_user'] = true;
            $_SESSION['login_user_name'] = $resultado[0]['nombre_usuario'];
            $_SESSION['login_user_id'] = $resultado[0]['id_usuario'];
            $data = array(
                'status'    => 'success',
                'code'      => 200,
                'message'   => 'Bienvenido(a) ' . $resultado[0]["nombre_usuario"]
            );
        }
        else{
            $data = array(
                'status'    => 'error',
                'code'      => 400,
                'message'   => 'Intentalo mas tarde',
            );
        }

    }
    else{
        $data = array(
            'status'     => 'error',
            'code'       => 400,
            'message'    => 'Contraseña Incorrecta'
        );
    }
} else {
    $data = array(
        'status'     => 'error',
        'code'       => 400,
        'message'    => 'El correo no existe'
    );
}

echo json_encode($data);