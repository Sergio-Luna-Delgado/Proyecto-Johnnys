<?php
require 'includes/functions/funciones.php';
estaAutenticado("user2");
$title = "- Carrito";
include "includes/templates/head.php";
require "includes/functions/conexion.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    /* validar que exista almenos algo en el carrito */
    if (isset($_SESSION['carrito'])) {
        $resultados = $_SESSION['carrito'];
    }

    $id_usuario = $_SESSION['login_user_id'];
    $fecha = date("Y-m-d");
    $codigo = rand(1, 999999);

    foreach ($resultados as $resultado) {
        $cantidad = $resultado['cantidad'];
        $total = $resultado['total'];
        $id_producto = $resultado['id_producto'];
        $stmt = $cn->prepare("INSERT INTO pedidos VALUES ('', '$cantidad', '$total', '$id_producto', '$id_usuario', 'Pendiente', '$fecha', '$codigo')");
        $consulta = $stmt->execute();
        if ($consulta) {
            $stmt = $cn->prepare("UPDATE productos SET inventario = (SELECT inventario FROM productos WHERE id_producto = '$id_producto') - '$cantidad' WHERE id_producto = '$id_producto'");
            $consulta2 = $stmt->execute();
            if ($consulta2) {
                echo "<script>
                        alert('¡Compra Exitosa!\nEl codigo de su compra es: $codigo\nNosotros le enviaremos un correo cuando se encuentre listo su pedido para que pueda pasar a recogerlo al mostrador');
                    </script>";
            } else {
                echo "<script>alert('Error al actualizar, por favor intente mas tarde');</script>";
            }
        } else {
            echo "<script>alert('Error al crear, por favor intente mas tarde');</script>";
        }
    }
    unset($_SESSION['carrito']);
    header('Location: /pedidos.php');
}

?>

<?php include "includes/templates/header.php"; ?>

<main class="container">
    <?php
    if (!isset($_SESSION)) {
        session_start();
    }
    /* validar que exista almenos algo en el carrito */
    if (isset($_SESSION['carrito'])) {
        $resultados = $_SESSION['carrito'];
    }
    if (isset($resultados)) {
    ?>
        <article class="my-2">
            <div class="table-responsive">
                <table id="datos_carrito" class="table table-bordered table-striped">
                    <thead class="text-center">
                        <tr>
                            <th>Nombre</th>
                            <th>Imagen</th>
                            <th>Precio Unitario</th>
                            <th>Cantidad</th>
                            <th>Total</th>
                            <th></th>
                        </tr>
                    </thead>
                </table>
            </div>
        </article>
        <article class="final">
            <?php
            $suma = 0;
            foreach ($resultados as $resultado) {
                $suma = $suma + $resultado['total'];
            }
            ?>
            <form method="POST" id="formulario_total" class="formulario" method="POST" action="carrito.php">
                <label for="total_compra">Total de la compra:</label>
                <input type="text" name="total_compra" id="total_compra" class="ms-2 w-10 text-start ps-3" readonly value="$<?php echo $suma; ?>"><br>
                <a href="/" type="button" class="btn btn-danger mt-4 me-4 py-2 px-4 fs-3">Cancelar</a>
                <input type="submit" class="btn btn-warning mt-4 py-2 px-4 fs-3" value="Confirmar">
            </form>
        </article>
    <?php
    } else {
    ?>
        <main class="text-center">
            <h1 class="tituloH1">El carrito esta vacio</h1>
            <img src="build/images/cart.gif" class="verificacionGif mt-5" alt="Gif de error">
        </main>
    <?php
    } ?>
</main>

<?php include("includes/templates/footer.php"); ?>