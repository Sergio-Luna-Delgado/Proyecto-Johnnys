<?php

$array = array(
    "Frappe"    => "Frappe",
    "Smoothie"  => "Smoothie",
    "Crepa"     => "Crepa",
    "Boneless"  => "Boneless",
    "Papas"     => "Papas"
);

if (isset($_GET['categoria']) && in_array($_GET['categoria'], $array)) {
    echo '
            <h2 class="tituloH2 my-5">- ' . $_GET['categoria'] . '- </h2>
            <script>
                let categoria = "' . $_GET['categoria'] . '";
            </script>
        ';
} else if (isset($_GET['categoria']) && !in_array($_GET['categoria'], $array)) {
    echo '<script>window.location.href = "404.php";</script>';
} else {
    echo '
            <h2 class="tituloH2 my-5">Esto es lo que todos llevan:</h2>
            <script>let categoria = "";</script>
        ';
}

?>

<div id="card-container" class="row">

</div>