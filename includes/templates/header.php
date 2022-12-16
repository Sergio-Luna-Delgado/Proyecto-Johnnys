<header class="container mt-5">
    <div class="home">
        <div class="left">
            <a data-bs-toggle="offcanvas" href="#offcanvasHome" role="button" aria-controls="offcanvasHome" class="text-white">
                <svg xmlns="http://www.w3.org/2000/svg" width="50" height="50" fill="currentColor" class="bi bi-list" viewBox="0 0 16 16">
                    <path fill-rule="evenodd" d="M2.5 12a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5zm0-4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5zm0-4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5z" />
                </svg>
            </a>
        </div>
        <div class="center">
            <a href="/" class="logo">Johnny&prime;s Frappe & More</a>
        </div>
        <div class="right">
            <div class="login" align="right">
                <?php
                if(!isset($_SESSION)) 
                { 
                    session_start(); 
                }
                if (!isset($_SESSION['login_user'])) {
                    ?> <a href="login.php" class="link">Iniciar Sesión</a> <?php
                } else {
                    ?>
                    <a class="link dropdown-toggle" id="opciones" role="button" data-bs-toggle="dropdown" aria-expanded="false"><?php echo $_SESSION['login_user_name']; ?></a>
                    <ul class="dropdown-menu" aria-labelledby="opciones">
                        <li><a href="/carrito.php" class="enlace_dropdown">Carrito de Compras</a></li>
                        <li><a href="/pedidos.php" class="enlace_dropdown">Mis Pedidos</a></li>
                        <li><a href="/ajustes.php" class="enlace_dropdown">Mi Perfil</a></li>
                        <li>
                            <hr class="dropdown-divider text-black w-100">
                        </li>
                        <li><a href="/cerrar_sesion.php?op=2" class="enlace_dropdown">Cerrar Sesión</a></li>
                    </ul>
                    <?php
                }
                ?>
            </div>
        </div>
    </div>
</header>

<!-- Offcanvas con las etiquetas del menu -->
<div class="categorias">
    <div class="offcanvas offcanvas-start" tabindex="-1" id="offcanvasHome" aria-labelledby="offcanvasHomeLabel">
        <div class="offcanvas-header">
            <p class="offcanvas-title fs-1 fw-bold text-white" id="offcanvasHomeLabel">Menú</p>
            <button type="button" class="btn-close text-reset fs-3" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>
        <div class="offcanvas-body">
            <ul>
                <li class="mb-5 text-white"><a class="offcanva_menu" href="index.php?categoria=Frappe">Frappes</a></li>
                <li class="mb-5 text-white"><a class="offcanva_menu" href="index.php?categoria=Smoothie">Smoothies</a></li>
                <li class="mb-5 text-white"><a class="offcanva_menu" href="index.php?categoria=Crepa">Crepas</a></li>
                <li class="mb-5 text-white"><a class="offcanva_menu" href="index.php?categoria=Boneless">Boneless</a></li>
                <li class="mb-5 text-white"><a class="offcanva_menu" href="index.php?categoria=Papas">Papas</a></li>
            </ul>
        </div>
    </div>
</div>

<!-- Dropdown del usuario -->