<?php
session_start();

$codFilme = $_GET['codFilme'];

$_SESSION['codFilme'] = $codFilme;

echo "<script>window.location.replace('paginaFilmeAdiministrador.php');</script>";
?>
