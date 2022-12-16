<?php
$title = "- Administrador";
include "../includes/templates/head.php";
?>

<?php include("../includes/templates/header_login.php") ?>

<!-- Modal Alerta -->
<div class="container">
    <div class="modal fade" id="aviso_administrador" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="aviso_administrador" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h2 class="fw-bold text-danger fs-2" id="aviso_administrador">Solo Administradores Autorizados.</p>
                </div>
                <div class="modal-body fs-3">
                    <p>Si no eres administrador por favor oprime el logo de Johnny&prime;s Frappe & More para volver a la página principal.</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary p-2 fs-3" data-bs-dismiss="modal">Entendido</button>
                </div>
            </div>
        </div>
    </div>
</div>

<main class="container login text-center">
    <h1 class="my-5 titulo">Saludos Administrador, ingresa tus datos para ajustar el inventario, ver los pedidos, entre otras cosas.</h1>
    <form method="POST" id="login_admin">
        <label for="Email" class="mb-2">Correo:</label><br />
        <input type="email" name="email" id="email" class="mb-3" required><br>
        <label for="contraseña" class="mb-2">Contraseña:</label><br>
        <input type="password" name="contraseña" id="contraseña" class="mb-5" required><br>
        <input type="submit" value="Iniciar Sesión" class="btn btn-warning py-2 px-4 fs-3">
    </form>
</main>


<?php include("../includes/templates/footer_admin.php") ?>