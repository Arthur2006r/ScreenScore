<?php
session_start();

$codPerfilAvaliador = $_GET['codPerfilAvaliador'];

$_SESSION['codPerfilAvaliador'] = $codPerfilAvaliador;

echo "<script>window.location.replace('paginaPerfil.php');</script>";
?>
