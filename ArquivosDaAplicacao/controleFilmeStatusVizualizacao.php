<?php
include_once "crud/vizualizacaoCRUD.php";

$codFilme = $_SESSION['codFilme'];
$codAvaliador = $_SESSION['codAvaliador'];

$quantidade = verificarVisualizacao($codFilme, $codAvaliador);
if ($quantidade == 1) {
    excluirVisualizacao($codFilme, $codAvaliador);
} else {
    salvarVisualizacao($codFilme, $codAvaliador);
}

echo "<script>window.history.back();</script>";
?>