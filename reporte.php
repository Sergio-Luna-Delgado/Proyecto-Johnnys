<?php
require 'includes/functions/funciones.php';
require "includes/functions/conexion.php";

if (!isset($_SESSION)) {
    session_start();
}
$id = $_SESSION['login_user_id'];

$stmt = $cn->prepare("SELECT * FROM usuarios WHERE id_usuario = $id");
$stmt->execute();
$resultado = $stmt->fetchAll(PDO::FETCH_ASSOC);

?>

<?php ob_start(); ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <!--CSS - Bootstrap-->
    <link rel="stylesheet" href="build/css/bootstrap.min.css">
    <!--CSS -->
    <link rel="stylesheet" href="build/css/app.css">
</head>
<body>
<?php include "includes/templates/header.php" ?>

<main class="container">
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

</body>
</html>

<?php 
/* Todo el html anterior lo almacena en una sola variable */
$html = ob_get_clean(); 

// require_once 'dompdf/autoload.inc.php';
// require __DIR__ . '/../../vendor/autoload.php';
use Dompdf\Dompdf;

$dompdf = new Dompdf();

$options = $dompdf->getOptions();
$options->set('isRemoteEnabled', true); /* Mostrar imagenesl */
$dompdf->setOptions($options);

$dompdf->loadHtml($html);
$dompdf->setPaper('letter');
// $dompdf->setPaper('A4', 'landscape');

$dompdf->render();
/* Attachment true para generar y descargar el pdf en la computadora */
$dompdf->stream("Reporte Inventario " . date('d-m-Y'), ['Attachment' => false]);
?>