<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
include_once "bancoDadosCRUD.php";

function salvarVisualizacao($codFilme, $codAvaliador)
{
    if (!isset($_SESSION['codAvaliador'])) {
        return 0; 
    }

    $conexao = criarConexao();

    $sql = "INSERT INTO Vizualizacao(codFilme, codAvaliador) VALUES(:codFilme, :codAvaliador);";
    $sentenca = $conexao->prepare($sql);
    $sentenca->bindValue(':codFilme', $codFilme);
    $sentenca->bindValue(':codAvaliador', $codAvaliador);

    $sentenca->execute();
    fecharConexao();
    return $sentenca->rowCount();
}

function excluirVisualizacao($codFilme, $codAvaliador)
{
    if (!isset($_SESSION['codAvaliador'])) {
        return 0; 
    }

    $conexao = criarConexao();

    $sql = "DELETE FROM Vizualizacao WHERE codFilme = :codFilme AND codAvaliador = :codAvaliador;";
    $sentenca = $conexao->prepare($sql);
    $sentenca->bindValue(':codFilme', $codFilme);
    $sentenca->bindValue(':codAvaliador', $codAvaliador);

    $sentenca->execute();
    $conexao = null;
    return $sentenca->rowCount();
}

function excluirVizualizacoesioFilme($codFilme)
{
    $conexao = criarConexao();

    $sql = "DELETE FROM Vizualizacao WHERE codFilme = :codFilme;";
    $sentenca = $conexao->prepare($sql);
    $sentenca->bindValue(':codFilme', $codFilme);

    $sentenca->execute();
    $conexao = null;
}

function verificarVisualizacao($codFilme, $codAvaliador)
{
    if (!isset($_SESSION['codAvaliador'])) {
        return 0; 
    }
    
    $sql = "SELECT * FROM Vizualizacao WHERE codAvaliador = :codAvaliador AND codFilme = :codFilme;";

    $conexao = criarConexao();
    $sentenca = $conexao->prepare($sql);
    $sentenca->bindValue(':codAvaliador', $codAvaliador);
    $sentenca->bindValue(':codFilme', $codFilme);

    $sentenca->execute();
    $conexao = null;

    return $sentenca->rowCount();
}
