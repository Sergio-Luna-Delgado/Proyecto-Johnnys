<?php
$title = "";
include "includes/templates/head.php";
?>

<?php include "includes/templates/header.php" ?>

<main class="container my-5">
    <article>
        <div id="Carousel_Menu" class="carousel slide" data-bs-ride="carousel">
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <img src="build/images/foto1.jpg" class="carrusel-foto">
                </div>
                <div class="carousel-item">
                    <img src="build/images/foto2.jpg" class="carrusel-foto">
                </div>
                <div class="carousel-item">
                    <img src="build/images/foto3.jpg" class="carrusel-foto">
                </div>
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#Carousel_Menu" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#Carousel_Menu" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </button>
        </div>
    </article>

    <article class="contenedorPrimario my-5">
        <?php include "includes/templates/contenedorPrimario.php" ?>
    </article>
    
    <article class="contenedorSecundario final">
        <?php include "includes/templates/contenedorSecundario.php" ?>
    </article>
</main>


<?php include("includes/templates/footer.php") ?>