<?php
/* Revisar que el usuario este autenticado */
require '../../includes/functions/funciones.php';
estaAutenticado("admin");

$title = "- Auditar";
include "../../includes/templates/head.php";
?>

<?php include("../../includes/templates/header_admin.php") ?>

<main class="container mb-5">
    <h1 class="tituloH1">- Panel de Auditoria -</h1>
    <div class="table-responsive">
        <table id="datos_auditar" class="table table-bordered table-striped">
            <thead class="text-center">
                <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Descripcion</th>
                    <th>Precio</th>
                    <th>Inventario</th>
                    <th>Promocion</th>
                    <th>Movimiento</th>
                    <th>Fecha</th>
                </tr>
            </thead>
        </table>
    </div>
</main>


<?php include("../../includes/templates/footer_admin.php") ?>