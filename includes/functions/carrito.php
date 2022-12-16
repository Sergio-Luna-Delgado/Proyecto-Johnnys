<?php
require("conexion.php");

$id = $_POST['id'];
$cantidad = $_POST['cantidad'];
$cantidad_entero = (int)$cantidad;

$sw = false;

$stmt = $cn->prepare("SELECT nombre_producto, foto, inventario, promocion, precio_unitario FROM productos where id_producto = '$id'");
$stmt->execute();
$resultado = $stmt->fetchAll();

$nombre = $resultado[0]['nombre_producto'];
$foto = $resultado[0]['foto'];
$inventario = $resultado[0]['inventario'];
$inventario_entero = (int)$inventario;
$precio = $resultado[0]['precio_unitario'];
$precio_floatante = (float)$precio;
$promocion = $resultado[0]['promocion'];

if ($inventario_entero >= $cantidad_entero) {
    // $inventario_entero = $inventario_entero - $cantidad_entero;
    $total = $precio_floatante * $cantidad_entero;

    if ($promocion == "2x1" && $cantidad_entero == 2) {
        $total = $total - $precio_floatante;
        $promo = true;
    } elseif ($promocion == "3x2" && $cantidad_entero == 3) {
        $total = $total - $precio_floatante;
        $promo = true;
    } else {
        $promocion = "Ninguna";
        $promo = false;
    }

    if (!isset($_SESSION)) {
        session_start();
    }

    if (!isset($_SESSION['carrito'])) {
        $productos = array(
            'id_producto'       => $id,
            'nombre_producto'   => $nombre,
            'foto'              => $foto,
            'precio_unitario'   => $precio_floatante,
            'cantidad'          => $cantidad,
            'total'             => $total,
            'promocion'         => $promo
        );
        $_SESSION['carrito'][0] = $productos;

    } else {
        /* Me es mas facil trabajar con el carrito asignandole una variable */
        $articulos = $_SESSION['carrito'];
        $numeroProducto = count($articulos);

        /* For para saber si hay un articulo repetido en el carrito */
        foreach ($articulos as $key => $articulo){
            if ($articulo['id_producto'] == $id && $articulo['promocion'] == false) {
                $nuevoCantidad = $articulo['cantidad'] + $cantidad;
                $nuevoTotal = $articulo['total'] + $total;

                /* Si lo hay lo actualizo en la misma posicion donde se encontro el primer registro */
                $productos = array(
                    'id_producto'       => $id,
                    'nombre_producto'   => $nombre,
                    'foto'              => $foto,
                    'precio_unitario'   => $precio_floatante,
                    'cantidad'          => $nuevoCantidad,
                    'total'             => $nuevoTotal,
                    'promocion'         => $promo
                );
                $_SESSION['carrito'][$key] = $productos;
                $sw = true;
            }
        }

        if($sw == false){
            $productos = array(
                'id_producto'       => $id,
                'nombre_producto'   => $nombre,
                'foto'              => $foto,
                'precio_unitario'   => $precio_floatante,
                'cantidad'          => $cantidad,
                'total'             => $total,
                'promocion'         => $promo
            );
            $_SESSION['carrito'][$numeroProducto] = $productos;
        }
    }

    $data = array(
        'status'     => 'success',
        'code'         => 200,
        'message'     => 'Se agrego al carrito correctamente',
        'promotion' => $promocion
    );
} else {
    $data = array(
        'status'     => 'error',
        'code'         => 400,
        'message'     => 'No hay disponibilidad del producto que selecciono'
    );
}

echo json_encode($data);
