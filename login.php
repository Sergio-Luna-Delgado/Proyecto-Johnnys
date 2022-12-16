<?php
require 'includes/functions/funciones.php';
estaAutenticado("user");
$title = "- Login";
include "includes/templates/head.php";

?>

<?php include "includes/templates/header.php" ?>

<main class="container my-5 login final text-center">
    <h1 class="my-5 titulo">Inicia sesión para poder comprar todo lo que selecciones en el carrito y poder recoger tus pedidos.</h1>
    <form method="POST" id="login_usuario">
        <label for="correo" class="mb-2 label">Correo Electronico:</label><br />
        <input type="text" name="correo" id="correo" class="mb-3 input" required><br>

        <label for="password" class="mb-2 label">Contraseña:</label><br>
        <input type="password" name="password" id="password" class="mb-5 input" required><br>
        
        <input type="submit" value="Iniciar Sesión" class="btn btn-warning py-2 px-4 fs-3">
    </form>
    <div align="center">
        <hr>
    </div>
    <a type="button" class="enlace" data-bs-toggle="modal" data-bs-target="#ingresar_usuario" id="botonCrear">¿Aún no creas una cuenta?, regístrate aquí</a>
</main>
<!-- <div class="final"></div> -->

<!-- Modal para crear usuarios -->
<div class="register final">
    <div class="modal fade" id="ingresar_usuario" tabindex="-1" aria-labelledby="ingresar_usuario_label" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <p class="modal-title text-black fs-2 fw-bold" id="ingresar_usuario_label">Llena el siguiente formulario para crear una cuenta en Johnny&prime;s Frappe & More</p>
                </div>
                <div class="modal-body">
                    <form method="POST" id="crear_usuario" enctype="multipart/form-data">
                        <div class="modal-content">
                            <label for="nombre_usuario" class="mb-2">Nombre:</label><br>
                            <input type="text" name="nombre_usuario" id="nombre_usuario" class="mb-3" required><br>
    
                            <label for="apellido_usuario" class="mb-2">Apellidos:</label><br>
                            <input type="text" name="apellido_usuario" id="apellido_usuario" class="mb-3" required><br>
    
                            <label for="direccion" class="mb-2">Tu dirección donde recibiras tus pedidos:</label><br>
                            <input type="text" name="direccion" id="direccion" class="mb-3" minlength="10" required><br>

                            <label for="correo_user" class="mb-2">Correo:</label><br>
                            <input type="email" name="correo" id="correo_user" class="mb-3" required><br>   
    
                            <label for="contraseña_user" class="mb-2">Contraseña:</label><br>
                            <input type="password" name="contraseña_user" id="contraseña_user" class="mb-3" minlength="8" required><br>
                        </div>
                        <div class="modal-footer">
                            <!-- <input type="hidden" name="id_Usuario" id="id_Usuario"> -->
                            <input type="button" class="btn btn-danger py-2 px-4 fs-3" data-bs-dismiss="modal" value="Cancelar">
                            <input type="submit" name="action" id="action" class="btn btn-warning text-white py-2 px-4 fs-3" value="Enviar Solicitud">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include("includes/templates/footer.php") ?>