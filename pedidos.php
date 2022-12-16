<?php
require 'includes/functions/funciones.php';
estaAutenticado("user2");
$title = "- Pedidos";
include "includes/templates/head.php";
?>

<?php include "includes/templates/header.php"; ?>

<main class="container mb-5">
    <h1 class="tituloH1">- Mis Pedidos Pendientes -</h1>
    <div class="table-responsive">
        <table id="datos_pedidos" class="table table-bordered table-striped">
            <thead class="text-center">
                <tr>
                    <th>Nombre</th>
                    <th>Imagen</th>
                    <th>Precio Unitario</th>
                    <th>Cantidad</th>
                    <th>Total</th>
                    <th>Codigo de Compra</th>
                </tr>
            </thead>
        </table>
    </div>
</main>

<?php include("includes/templates/footer.php"); ?>