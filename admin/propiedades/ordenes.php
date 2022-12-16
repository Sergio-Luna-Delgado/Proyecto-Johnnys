<?php
/* Revisar que el usuario este autenticado */
require '../../includes/functions/funciones.php';
estaAutenticado("admin");

$title = "- Ordenes";
include "../../includes/templates/head.php";
?>

<?php include("../../includes/templates/header_admin.php") ?>

<main class="container mb-5">
    <h1 class="tituloH1">- Panel de las Ordenes -</h1>
    <div class="table-responsive">
        <table id="datos_ordenes" class="table table-bordered table-striped">
            <thead class="text-center">
                <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Correo</th>
                    <th>Articulo</th>
                    <th>Cantidad</th>
                    <th>Total</th>
                    <th>Codigo</th>
                    <th></th>
                </tr>
            </thead>
        </table>
    </div>
</main>


<?php include("../../includes/templates/footer_admin.php") ?>