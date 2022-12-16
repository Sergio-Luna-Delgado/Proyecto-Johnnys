<?php
require("conexion.php");
require("funciones.php");

$id = $_POST["id_producto"];
if (isset($_POST["id_producto"])) {
    $salida = array();
    $stmt = $cn->prepare("SELECT * FROM productos WHERE id_producto = $id LIMIT 1");
    $stmt->execute();
    $resultado = $stmt->fetchAll();
    foreach ($resultado as $fila) {
        $salida["nombre_producto"] = $fila["nombre_producto"];
        $salida["categoria"] = $fila["categoria"];
        $salida["descripcion"] = $fila["descripcion"];
        $salida["precio_unitario"] = $fila["precio_unitario"];
        $salida["inventario"] = $fila["inventario"];
        $salida["promocion"] = $fila["promocion"];
        if ($fila["foto"] != "") {
            $salida["foto"] = '<div align="center"><img src="/pictures/' . $fila["foto"] . '" class="img-thumnail" width="140" height="76"><input type="hidden" name="imagen_producto_oculto" value="' . $fila["foto"] . '"></div>';
        } else {
            $salida["foto"] = '<input type="hidden" name="imagen_producto_oculto" value="">';
        }
    }
}

echo json_encode($salida);
