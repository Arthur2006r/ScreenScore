<?php
include_once "crud/curtidaComentarioCRUD.php";

$codComentario = $_GET['codComentario'];
$codAvaliador = $_SESSION['codAvaliador'];

$quantidade = verificarCurtidaComentario($codComentario, $codAvaliador);
if ($quantidade == 1) {
    excluirCurtidaComent($codComentario, $codAvaliador);
} else {
    salvarCurtidaComentario($codComentario, $codAvaliador);
}

echo "<script>window.history.back();</script>";
?>