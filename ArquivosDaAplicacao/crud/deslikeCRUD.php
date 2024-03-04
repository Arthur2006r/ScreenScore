<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
include_once "bancoDadosCRUD.php";

function salvarDeslike($codFilme, $codAvaliador)
{
    if (!isset($_SESSION['codAvaliador'])) {
        return 0; 
    }

    $conexao = criarConexao();

    $sql = "INSERT INTO Deslike(codFilme, codAvaliador) VALUES(:codFilme, :codAvaliador);";
    $sentenca = $conexao->prepare($sql);
    $sentenca->bindValue(':codFilme', $codFilme);
    $sentenca->bindValue(':codAvaliador', $codAvaliador);

    $sentenca->execute();
    fecharConexao();
    return $sentenca->rowCount();
}

function excluirDeslike($codFilme, $codAvaliador)
{
    if (!isset($_SESSION['codAvaliador'])) {
        return 0; 
    }

    $conexao = criarConexao();

    $sql = "DELETE FROM Deslike WHERE codFilme = :codFilme AND codAvaliador = :codAvaliador;";
    $sentenca = $conexao->prepare($sql);
    $sentenca->bindValue(':codFilme', $codFilme);
    $sentenca->bindValue(':codAvaliador', $codAvaliador);

    $sentenca->execute();
    $conexao = null;
    return $sentenca->rowCount();
}

function excluirDeslikesFilme($codFilme)
{
    $conexao = criarConexao();

    $sql = "DELETE FROM Deslike WHERE codFilme = :codFilme;";
    $sentenca = $conexao->prepare($sql);
    $sentenca->bindValue(':codFilme', $codFilme);

    $sentenca->execute();
    $conexao = null;
}

function verificarDeslike($codFilme, $codAvaliador)
{
    if (!isset($_SESSION['codAvaliador'])) {
        return 0; 
    }
    
    $sql = "SELECT * FROM Deslike WHERE codAvaliador = :codAvaliador AND codFilme = :codFilme;";

    $conexao = criarConexao();
    $sentenca = $conexao->prepare($sql);
    $sentenca->bindValue(':codAvaliador', $codAvaliador);
    $sentenca->bindValue(':codFilme', $codFilme);

    $sentenca->execute();
    $conexao = null;

    return $sentenca->rowCount();
}
