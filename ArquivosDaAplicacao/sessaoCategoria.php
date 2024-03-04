<?php
session_start();

$categoria = $_GET['categoria'];

$_SESSION['categoria'] = $categoria;

echo "<script>window.location.replace('paginaTodosOsFilmesCategoria.php');</script>";
?>
