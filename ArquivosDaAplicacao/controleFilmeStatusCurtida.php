<?php
include_once "crud/curtidaCRUD.php";

$codFilme = $_SESSION['codFilme'];
$codAvaliador = $_SESSION['codAvaliador'];

$quantidade = verificarCurtida($codFilme, $codAvaliador);
if ($quantidade == 1) {
    excluirCurtida($codFilme, $codAvaliador);
} else {
    salvarCurtida($codFilme, $codAvaliador);
}

echo "<script>window.history.back();</script>";
?>