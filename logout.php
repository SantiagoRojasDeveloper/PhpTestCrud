<?php
session_start();

if (isset($_POST["logout"])) {
    session_destroy();
    header("Location: login.php");
    exit();
} else {
    // Maneja otros casos o redirige a alguna otra página
    // en caso de que alguien acceda a esta página directamente sin el formulario.
}
?>
