<?php
    require("conexion.php");
    require("funciones.php");

    $query = "";
    $salida = array();
    $query = "SELECT Pe.id_pedido, U.nombre_usuario, U.correo, Pr.nombre_producto, Pe.cantidad, Pe.total, Pe.codigo FROM pedidos Pe, productos Pr, usuarios U ";

    /* En PHP para concatenar es . */
    if(isset($_POST["search"]["value"])){
        $query .= 'WHERE Pe.estatus != "Completado" ';
        $query .= 'AND U.nombre_usuario LIKE "%' . $_POST["search"]["value"] . '%" ';
        $query .= 'AND Pe.id_producto = Pr.id_producto AND Pe.id_usuario = U.id_usuario ';
    }

    if(isset($_POST["order"])){
        $query .= 'ORDER BY ' . $_POST['order']['0']['column'] . ' ' . $_POST["order"][0]["dir"] . ' ';
    }
    else{
        $query .= 'ORDER BY Pe.id_pedido ASC ';
    }

    /* Al menos un registro */
    if($_POST["length"] != -1){
        $query .= 'LIMIT ' . $_POST["start"] . ',' . $_POST["length"];
    }

    $stmt = $cn->prepare($query);
    $stmt -> execute();
    $resultado = $stmt->fetchAll();
    $datos = array();
    $filtered_rows = $stmt->rowCount();
    foreach($resultado as $fila){
        $sub_array = array();
        $sub_array[] = $fila["id_pedido"];
        $sub_array[] = $fila["nombre_usuario"];
        $sub_array[] = $fila["correo"];
        $sub_array[] = $fila["nombre_producto"];
        $sub_array[] = $fila["cantidad"];
        $sub_array[] = $fila["total"];
        $sub_array[] = $fila["codigo"];
        $sub_array[] = '<button type="button" name="borrar" id="' . $fila["id_pedido"] .'" class="btn btn-danger py-2 px-4 fs-3 borrarOrden">Borrar</button>';
        $datos[] = $sub_array;
    }

    /* Esto es de datatable */
    $salida = array(
        "draw" => intval($_POST["draw"]),
        "recordsTotal" => $filtered_rows,
        "recordsFiltered" => todo("pedidos"),
        "data" => $datos
    );

    echo json_encode($salida);
