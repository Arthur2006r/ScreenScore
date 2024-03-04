<?php
include_once "crud/avaliadorCRUD.php";

$idAvaliador = 0;
$email = $_POST['email'];
$username = $_POST["username"];
$senha = $_POST['senha'];
$avatar = "";

$quantidade = salvarAvaliador($idAvaliador, $username, $email, $senha, $avatar);
if ($quantidade > 0) {
    echo  "<script>alert('Cadastro realizado com sucesso!');</script>";
    echo  "<script>window.location.replace('paginaLogin.php');</script>";
} else {
    echo  "<script>alert('Ocorreu um erro ao cadastrar sua conta! Tente novamente mais tarde.');</script>";
    echo  "<script>window.location.replace('paginaCadastro.php');</script>";
}
?>