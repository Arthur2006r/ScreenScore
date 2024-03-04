<?php
include_once "crud/avaliacaoCRUD.php";

$codFilme = $_SESSION['codFilme'];
$codAvaliador = $_SESSION['codAvaliador'];
$avaliacao = $_GET['avaliacao'];

salvarAvaliacao($codFilme, $codAvaliador, $avaliacao);

echo "<script>window.history.back();</script>";
?>