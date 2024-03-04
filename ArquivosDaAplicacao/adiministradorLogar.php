<?php
session_start();
include_once "crud/administradorCRUD.php";

$codAdiministrador = $_POST['codigo'];
$senha = $_POST['senha'];

$quantidade = verificarAdiministrador($codAdiministrador, $senha);
if ($quantidade > 0) {
    $_SESSION['codAdiministrador'] = $codAdiministrador;

    echo "<script>alert('O login ocorreu com sucesso!');</script>";
    echo "<script>window.location.replace('paginaInicialAdiministrador.php');</script>";
} else {
    echo "<script>alert('Ocorreu um erro ao logar! Tente novamente mais tarde.');</script>";
    echo "<script>window.location.replace('paginaAdministrador.php');</script>";
}
?>