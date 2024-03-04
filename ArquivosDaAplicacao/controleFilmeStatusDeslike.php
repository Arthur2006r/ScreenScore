<?php
include_once "crud/deslikeCRUD.php";

$codFilme = $_SESSION['codFilme'];
$codAvaliador = $_SESSION['codAvaliador'];

$quantidade = verificarDeslike($codFilme, $codAvaliador);
if ($quantidade == 1) {
    excluirDeslike($codFilme, $codAvaliador);
} else {
    salvarDeslike($codFilme, $codAvaliador);
}

echo "<script>window.history.back();</script>";
?>