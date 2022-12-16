<?php
require("conexion.php");
require("funciones.php");


if ($_POST["Operacion"] == "Crear") {

    $id = '';
    $idNuevo = $_POST["id_producto"];
    $Nombre = $_POST["nombre_producto"];
    $Categoria = $_POST["categoria"];
    $Descripcion = $_POST["descripcion"];
    $Precio = $_POST["precio_unitario"];
    $Inventario = $_POST["inventario"];
    $Promocion = $_POST["promocion"];

    $foto = '';
    if ($_FILES["foto"]["name"] != '') {
        $foto = subir_imagen();
    }

    $stmt = $cn->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
    $stmt = $cn->prepare("INSERT INTO productos VALUES(:id, :Nombre, :Categoria, :Descripcion, :Precio, :Inventario, :Promocion, :foto)");
    $stmt->bindParam(":id", $id, PDO::PARAM_INT);
    $stmt->bindParam(":Nombre", $Nombre, PDO::PARAM_STR);
    $stmt->bindParam(":Categoria", $Categoria, PDO::PARAM_STR);
    $stmt->bindParam(":Descripcion", $Descripcion, PDO::PARAM_STR);
    $stmt->bindParam(":Precio", $Precio, PDO::PARAM_INT);
    $stmt->bindParam(":Inventario", $Inventario, PDO::PARAM_INT);
    $stmt->bindParam(":Promocion", $Promocion, PDO::PARAM_STR);
    $stmt->bindParam(":foto", $foto, PDO::PARAM_STR);
    $resultado = $stmt->execute();

    if (!empty($resultado)) {
        $data = array(
            'status'     => 'success',
            'code'         => 200,
            'message'     => 'El producto se ha creado correctamente'
        );
    } else {
        $data = array(
            'status'     => 'error',
            'code'       => 404,
            'message'    => 'El producto no se pudo crear'
        );
    }
}

if ($_POST["Operacion"] == "Editar") {

    $id = '';
    $idNuevo = $_POST["id_producto"];
    $Nombre = $_POST["nombre_producto"];
    $Categoria = $_POST["categoria"];
    $Descripcion = $_POST["descripcion"];
    $Precio = $_POST["precio_unitario"];
    $Inventario = $_POST["inventario"];
    $Promocion = $_POST["promocion"];

    $foto = '';
    if ($_FILES["foto"]["name"] != '') {
        $foto = subir_imagen();
        unlink("../../pictures/" . $_POST["imagen_producto_oculto"]);
    } else {
        $foto = $_POST["imagen_producto_oculto"];
    }

    $stmt = $cn->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
    $stmt = $cn->prepare("UPDATE productos SET nombre_producto = :Nombre, categoria = :Categoria, descripcion = :Descripcion, precio_unitario = :Precio, inventario = :Inventario, promocion = :Promocion, foto = :foto WHERE id_producto = :idNuevo");
    $stmt->bindParam(":idNuevo", $idNuevo, PDO::PARAM_INT);
    $stmt->bindParam(":Nombre", $Nombre, PDO::PARAM_STR);
    $stmt->bindParam(":Categoria", $Categoria, PDO::PARAM_STR);
    $stmt->bindParam(":Descripcion", $Descripcion, PDO::PARAM_STR);
    $stmt->bindParam(":Precio", $Precio, PDO::PARAM_INT);
    $stmt->bindParam(":Inventario", $Inventario, PDO::PARAM_INT);
    $stmt->bindParam(":Promocion", $Promocion, PDO::PARAM_STR);
    $stmt->bindParam(":foto", $foto, PDO::PARAM_STR);

    $resultado = $stmt->execute();

    if (!empty($resultado)) {
        $data = array(
            'status'     => 'success',
            'code'         => 200,
            'message'     => 'El producto se ha actualizado correctamente'
        );
    } else {
        $data = array(
            'status'     => 'error',
            'code'       => 404,
            'message'    => 'No se pudo actualizar'
        );
    }
}

if ($_POST["Operacion"] == "Borrar") {

    $idNuevo=$_POST["id_producto"];
    if(isset($_POST["id_producto"])){
        $foto = obtener_nombre_imagen($_POST["id_producto"]);
        if($foto != ""){
            unlink("../../pictures/" . $foto);
        }
        $stmt = $cn->prepare("DELETE FROM productos WHERE id_producto = '$idNuevo'");
        $resultado = $stmt->execute();
        if(!empty($resultado)){
            $data = array(
                'status' 	=> 'success',
                'code' 		=> 200,
                'message' 	=> 'El producto se ha borrado correctamente'
            );
        }
        else{
            $data = array(
                'status'     => 'error',
                'code'       => 400,
                'message'    => 'El producto no se pudo borrar'
            );
        }
    }
}

echo json_encode($data);
