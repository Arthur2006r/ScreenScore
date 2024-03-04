<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
include_once "bancoDadosCRUD.php";

function salvarCurtida($codFilme, $codAvaliador)
{
    if (!isset($_SESSION['codAvaliador'])) {
        return 0; 
    }

    $conexao = criarConexao();

    $sql = "INSERT INTO Curtida(codFilme, codAvaliador) VALUES(:codFilme, :codAvaliador);";
    $sentenca = $conexao->prepare($sql);
    $sentenca->bindValue(':codFilme', $codFilme);
    $sentenca->bindValue(':codAvaliador', $codAvaliador);

    $sentenca->execute();
    fecharConexao();
    return $sentenca->rowCount();
}

function excluirCurtida($codFilme, $codAvaliador)
{
    if (!isset($_SESSION['codAvaliador'])) {
        return 0; 
    }

    $conexao = criarConexao();

    $sql = "DELETE FROM Curtida WHERE codFilme = :codFilme AND codAvaliador = :codAvaliador;";
    $sentenca = $conexao->prepare($sql);
    $sentenca->bindValue(':codFilme', $codFilme);
    $sentenca->bindValue(':codAvaliador', $codAvaliador);

    $sentenca->execute();
    $conexao = null;
    return $sentenca->rowCount();
}

function excluirCurtidasFilme($codFilme)
{
    $conexao = criarConexao();

    $sql = "DELETE FROM Curtida WHERE codFilme = :codFilme;";
    $sentenca = $conexao->prepare($sql);
    $sentenca->bindValue(':codFilme', $codFilme);

    $sentenca->execute();
    $conexao = null;
}

function verificarCurtida($codFilme, $codAvaliador)
{
    if (!isset($_SESSION['codAvaliador'])) {
        return 0; 
    }

    $sql = "SELECT * FROM Curtida WHERE codAvaliador = :codAvaliador AND codFilme = :codFilme;";

    $conexao = criarConexao();
    $sentenca = $conexao->prepare($sql);
    $sentenca->bindValue(':codAvaliador', $codAvaliador);
    $sentenca->bindValue(':codFilme', $codFilme);

    $sentenca->execute();
    $conexao = null;

    return $sentenca->rowCount();
}
