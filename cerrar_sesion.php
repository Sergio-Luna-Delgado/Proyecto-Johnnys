<?php
$opcion = $_GET['op'];
session_start();
$_SESSION = [];

if ($opcion == 1) {
    header('Location: /admin');
} else if ($opcion == 2) {
    header('Location: /');
}
