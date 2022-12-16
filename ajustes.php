<?php
require 'includes/functions/funciones.php';
estaAutenticado("user2");

$title = "- Mi Perfil";
include "includes/templates/head.php";

require "includes/functions/conexion.php";

if (!isset($_SESSION)) {
    session_start();
}
$id = $_SESSION['login_user_id'];

$stmt = $cn->prepare("SELECT * FROM usuarios WHERE id_usuario = $id");
$stmt->execute();
$resultado = $stmt->fetchAll(PDO::FETCH_ASSOC);

/* Ejecutar el codigo despues de que el usuario envia el formulario */
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nombre = $_POST['nombre_usuario'];
    $apellido = $_POST['apellido_usuario'];
    $direccion = $_POST['direccion'];
    $correo = $_POST['correo'];

    if (!$id) {
        $errores[] = "Error";
    }
    if (!$nombre) {
        $errores[] = "El nombre es obligatorio";
    }
    if (!$apellido) {
        $errores[] = "El apellido es obligatorio";
    }
    if (!$direccion) {
        $errores[] = "La direccion es obligatoria";
    }
    if (!$correo) {
        $errores[] = "El correo es obligatorio";
    }

    if (empty($errores)) {
        $stmt = $cn->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
        $stmt = $cn->prepare("UPDATE usuarios SET nombre_usuario = :Nombre, apellido_usuario = :Apellido, direccion = :Direccion, correo = :Correo WHERE id_usuario = :Id");
        $stmt->bindParam(":Id", $id, PDO::PARAM_INT);
        $stmt->bindParam(":Nombre", $nombre, PDO::PARAM_STR);
        $stmt->bindParam(":Apellido", $apellido, PDO::PARAM_STR);
        $stmt->bindParam(":Direccion", $direccion, PDO::PARAM_STR);
        $stmt->bindParam(":Correo", $correo, PDO::PARAM_STR);

        $resultado = $stmt->execute();

        echo "<script>
                alert('Se han actualizado los datos con exito');
                window.location.href = '/';
            </script>";
    } else {
        foreach ($errores as $error) {
            echo "<script>alert('$error');</script>";
        }
    }
}

?>

<?php include "includes/templates/header.php" ?>

<main class="container final">
    <form class="formulario" method="POST" action="ajustes.php">
        <fieldset>
            <legend>Actualiza tu información</legend>
            <label for="nombre_usuario" class="mb-2">Nombre:</label>
            <input type="text" name="nombre_usuario" id="nombre_usuario" value="<?php echo $resultado[0]['nombre_usuario'] ?>">

            <label for="apellido_usuario" class="mb-2">Apellidos:</label>
            <input type="text" name="apellido_usuario" id="apellido_usuario" value="<?php echo $resultado[0]['apellido_usuario'] ?>" required>

            <label for="direccion" class="mb-2">Tu dirección donde recibiras tus pedidos:</label>
            <input type="text" name="direccion" id="direccion" minlength="10" value="<?php echo $resultado[0]['direccion'] ?>" required>

            <label for="correo" class="mb-2">Correo:</label>
            <input type="email" name="correo" id="correo_user" value="<?php echo $resultado[0]['correo'] ?>" required>

            <input type="button" value="Cambiar Contraseña" class="btn btn-primary py-2 px-4 fs-3 d-block my-5" data-bs-toggle="modal" data-bs-target="#cambiarContraseña">

            <input type="submit" class="btn btn-warning text-white py-2 px-4 fs-2 mt-4" value="Guardar">
        </fieldset>
    </form>
</main>

<!-- Modal -->
<div class="modal fade" id="cambiarContraseña" tabindex="-1" aria-labelledby="cambiarContraseñalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h2 class="fw-bold" id="cambiarContraseñalLabel">Escribe tu nueva contraseña</h2>
            </div>
            <form method="POST" id="actulizarContra" class="formulario">
                <div class="modal-body">
                    <label for="contraseña1" class="mb-2">Contraseña:</label>
                    <input type="password" name="contraseña1" id="contraseña1" class="mb-3 d-block w-100" minlength="8" required>

                    <label for="contraseña2" class="mb-2">Repite la Contraseña:</label>
                    <input type="password" name="contraseña2" id="contraseña2" class="mb-3 d-block w-100" minlength="8" required>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary py-2 px-4 fs-2" data-bs-dismiss="modal">Cancelar</button>
                    <input type="hidden" id="id" value="<?php echo $id ?>">
                    <button type="sumbit" class="btn btn-primary py-2 px-4 fs-2">Guardar</button>
                </div>
            </form>
        </div>
    </div>
</div>

<?php include("includes/templates/footer.php") ?>