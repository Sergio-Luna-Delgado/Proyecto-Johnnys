<?php
/* Revisar que el usuario este autenticado */
require '../../includes/functions/funciones.php';
estaAutenticado("admin");

$title = "- Inventario";
include "../../includes/templates/head.php";
?>

<?php include("../../includes/templates/header_admin.php") ?>

<main class="container">
    <article>
        <h1 class="tituloH1">- Panel del Inventario -</h1>
        <button type="button" class="btn btn-primary py-2 px-4 fs-3" data-bs-toggle="modal" data-bs-target="#ingresar_producto" id="Crear">
            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-plus-circle-fill" viewBox="0 0 16 16">
                <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zM8.5 4.5a.5.5 0 0 0-1 0v3h-3a.5.5 0 0 0 0 1h3v3a.5.5 0 0 0 1 0v-3h3a.5.5 0 0 0 0-1h-3v-3z" />
            </svg>
            Crear Producto
        </button>
        </div>
    </article>
    <article class="container my-5">
        <div class="table-responsive final">
            <table id="datos_productos" class="table table-bordered table-striped final">
                <thead class="text-center">
                    <tr>
                        <th>ID</th>
                        <th>Nombre</th>
                        <th>Categoria</th>
                        <th>Descripcion</th>
                        <th>Precio ($)</th>
                        <th>Inventario</th>
                        <th>Promocion</th>
                        <th>Foto</th>
                        <th></th>
                        <th></th>
                    </tr>
                </thead>
            </table>
        </div>
    </article>
</main>

<!-- Modal para llenar un producto y actualizar -->
<div class="modal fade" id="ingresar_producto" tabindex="-1" aria-labelledby="ingresar_producto_label" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <p class="modal-title text-black fs-2 fw-bold" id="ingresar_usuario_label">Llena el siguiente formulario para crear un producto en el restaurante</p>
            </div>
            <div class="modal-body">
                <form method="POST" id="formulario_producto" class="register" enctype="multipart/form-data">
                    <div class="modal-content">
                        <label for="nombre_producto" class="label">Nombre:</label><br>
                        <input type="text" name="nombre_producto" id="nombre_producto" class="input" required><br>

                        <label for="categoria" class="label">Categoria:</label><br>
                        <!--<input type="text" name="categoria" id="categoria" class="input" required><br> -->

                        <select name="categoria" id="categoria" class="input mb-3 border-2" required>
                            <option disabled selected>--Seleccione una categoria--</option>
                            <option value="Frappe">Frappe</option>
                            <option value="Smoothie">Smoothie</option>
                            <option value="Crepa">Crepa</option>
                            <option value="Boneless">Boneless</option>
                            <option value="Papas">Papas</option>
                        </select>

                        <label for="descripcion" class="label">Descripcion:</label><br>
                        <input type="text" name="descripcion" id="descripcion" class="input" required><br>

                        <label for="precio_unitario" class="label">Precio Unitario:</label><br>
                        <input type="number" name="precio_unitario" id="precio_unitario" step="0.01" class="input" required><br>

                        <label for="inventario" class="label">Inventario:</label><br>
                        <input type="number" name="inventario" id="inventario" value="1" min="0" max="100" class="input" required><br>

                        <label for="promocion" class="label">Promoción:</label><br>
                        <!-- <input type="text" name="promocion" id="promocion" class="input" required><br> -->

                        <select name="promocion" id="promocion" class="input mb-3 border-2" required>
                            <option disabled selected>--Seleccione una promoción--</option>
                            <option value="Ninguna">Ninguna</option>
                            <option value="2x1">2x1</option>
                            <option value="3x2">3x2</option>
                        </select>

                        <label for="foto" class="label">Foto:</label><br>
                        <input type="file" name="foto" id="foto" class="input border-secondary border-2"><br>
                        <span id="Foto_Subida"></span><br>
                    </div>
                    <div class="modal-footer">
                        <input type="hidden" name="id_producto" id="id_producto">
                        <input type="hidden" name="Operacion" id="Operacion">
                        <input type="button" class="btn btn-danger py-2 px-4 fs-3" data-bs-dismiss="modal" value="Cancelar">
                        <input type="submit" name="action" id="action" class="btn btn-warning text-white py-2 px-4 fs-3" value="Guardar">
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<?php include("../../includes/templates/footer_admin.php") ?>