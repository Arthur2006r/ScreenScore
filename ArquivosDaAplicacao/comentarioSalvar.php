<?php
include_once "crud/comentarioCRUD.php";

$codFilme = $_POST['codFilme'];
$codAvaliador = $_POST['codAvaliador'];
$comentario = $_POST['comentario'];

$quantidade = salvarComentario($codFilme, $codAvaliador, $comentario);
if ($quantidade > 0) {
    echo  "<script>alert('Seu comentário foi salvo!');</script>";
    echo  "<script>window.location.replace('paginaFilme.php');</script>";
} else {
    echo  "<script>alert('Ocorreu um erro ao salvar ser comentário! Tente novamente mais tarde.');</script>";
    echo  "<script>window.location.replace('paginaFilme.php');</script>";
}
?>