<?php
session_start();

include_once "crud/avaliadorCRUD.php";

$email = $_POST['email'];
$senha = $_POST['senha'];

$codAvaliador = autenticarAvaliador($email, $senha);

if ($codAvaliador != null) {
    $_SESSION['codAvaliador'] = $codAvaliador;
    
    echo "<script>alert('O login ocorreu com sucesso!');</script>";
    echo "<script>window.location.replace('paginaInicial.php');</script>";
    exit();
} else {
    echo "<script>alert('Ocorreu um erro ao logar! Tente novamente mais tarde.');</script>";
    echo "<script>window.location.replace('paginaLogin.php');</script>";
    exit();
}
?>