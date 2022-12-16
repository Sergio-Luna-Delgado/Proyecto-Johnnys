<?php

function estaAutenticado($rol)
{
    session_start();
    /* Si el admin NO inicio sesion lo regresa */
    if ($rol === "admin") {
        if (!$_SESSION['login_admin']) {
            header('Location: /admin');
        }
    } 
    /* Si el usuario SI inicia sesion lo regresa */
    if ($rol === "user") {
        if (!empty($_SESSION['login_user'])) {
            header('Location: /');
        }
    }
    /* Si el usuario NO inicio sesion lo regresa */
    if ($rol === "user2") {
        if (!$_SESSION['login_user']) {
            // echo "<script>alert('Inicie sesion primero')</script>";
            header('Location: /');
        }
    }
}

function todo(string $tabla)
{
    require('conexion.php');
    $stmt = $cn->prepare("SELECT * FROM $tabla");
    $stmt->execute();
    $resultado = $stmt->fetchAll();
    return $stmt->rowCount();
}

function subir_imagen()
{
    if (isset($_FILES["foto"])) {
        $extension = explode('.', $_FILES["foto"]['name']);
        $nuevo_nombre = rand() . '.' . $extension[1];
        $ubicacion = '../../pictures/' . $nuevo_nombre;
        move_uploaded_file($_FILES["foto"]['tmp_name'], $ubicacion);
        return $nuevo_nombre;
    }
}

function obtener_nombre_imagen($id_producto)
{
    require('conexion.php');
    $stmt = $cn->prepare("SELECT foto FROM productos WHERE id_producto = '$id_producto'");
    $stmt->execute();
    $resultado = $stmt->fetchAll();
    foreach ($resultado as $fila) {
        return $fila["foto"];
    }
}
