<?php
    require("conexion.php");
    require("funciones.php");

    $query = "";
    $salida = array();
    $query = "SELECT * FROM productos ";

    //En PHP para concatenar es .=
    if(isset($_POST["search"]["value"])){
        $query .= 'WHERE nombre_producto LIKE "%' . $_POST["search"]["value"] . '%" ';
    }

    if(isset($_POST["order"])){
        $query .= 'ORDER BY ' . $_POST['order']['0']['column'] . ' ' . $_POST["order"][0]["dir"] . ' ';
    }
    else{
        $query .= 'ORDER BY id_producto asc ';
    }

    /* al menos un registro */
    if($_POST["length"] != -1){
        $query .= 'LIMIT ' . $_POST["start"] . ',' . $_POST["length"];
    }

    $stmt = $cn->prepare($query);
    $stmt -> execute();
    $resultado = $stmt->fetchAll();
    $datos = array();
    $filtered_rows = $stmt->rowCount();
    foreach($resultado as $fila){
        $foto = '';
        if($fila["foto"] != ''){
            $foto = '<img src="/pictures/' . $fila["foto"] . '" class="img-thumnail" width="71" height="38" />';
        }
        else{
            $foto = '';
        }

        $sub_array = array();
        $sub_array[] = $fila["id_producto"];
        $sub_array[] = $fila["nombre_producto"];
        $sub_array[] = $fila["categoria"];
        $sub_array[] = $fila["descripcion"];
        $sub_array[] = $fila["precio_unitario"];
        $sub_array[] = $fila["inventario"];
        $sub_array[] = $fila["promocion"];
        $sub_array[] = $foto;
        $sub_array[] = '<button type="button" name="editar" id="' . $fila["id_producto"] .'" class="btn btn-warning text-white py-2 px-4 fs-3 editarProducto">Editar</button>';
        $sub_array[] = '<button type="button" name="borrar" id="' . $fila["id_producto"] .'" class="btn btn-danger py-2 px-4 fs-3 borrarProducto">Borrar</button>';
        $datos[] = $sub_array;
    }
    //esto es de datatable
    $salida = array(
        "draw" => intval($_POST["draw"]),
        "recordsTotal" => $filtered_rows,
        "recordsFiltered" => todo("productos"),
        "data" => $datos
    );

    echo json_encode($salida);
?>