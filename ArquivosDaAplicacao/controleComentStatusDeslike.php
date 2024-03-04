<?php
include_once "crud/deslikesComentarioCRUD.php";

$codComentario = $_GET['codComentario'];
$codAvaliador = $_SESSION['codAvaliador'];

$quantidade = verificarDeslikeComentario($codComentario, $codAvaliador);
if ($quantidade == 1) {
    excluirDeslikeComent($codComentario, $codAvaliador);
} else {
    salvarDeslikeComentario($codComentario, $codAvaliador);
}

echo "<script>window.history.back();</script>";
?>