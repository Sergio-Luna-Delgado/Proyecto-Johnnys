<?php

session_start();

/* No se ha iniciado sesion, si esta vacio los datos del usuario*/
if (empty($_SESSION['login_user'])) {
    $data = array(
        'status' 	=> 'error',
        'code' 		=> 400,
        'message' 	=> 'Primero inicia sesión'
    );
} else{
    $data = array(
        'status' 	=> 'success',
        'code' 		=> 200,
        'message' 	=> 'Ok'
    );
}

echo json_encode($data);
// data-bs-target="#detalles${producto.id_producto}"