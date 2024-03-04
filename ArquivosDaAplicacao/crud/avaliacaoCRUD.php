<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
include_once "bancoDadosCRUD.php";

function salvarAvaliacao($codFilme, $codAvaliador, $avaliacao)
{
    if (!isset($_SESSION['codAvaliador'])) {
        return 0; 
    }

    $conexao = criarConexao();

    if (verificarAvaliacao($codFilme, $codAvaliador) == 1) {
        $sql = "UPDATE Avaliacao SET avaliacao = :avaliacao WHERE codFilme = :codFilme AND codAvaliador = :codAvaliador;;";
        $sentenca = $conexao->prepare($sql);
        $sentenca->bindValue(':codFilme', $codFilme);
        $sentenca->bindValue(':codAvaliador', $codAvaliador);
        $sentenca->bindValue(':avaliacao', $avaliacao);
    } else {
        $sql = "INSERT INTO Avaliacao(codFilme, codAvaliador, avaliacao) VALUES(:codFilme, :codAvaliador, :avaliacao);";
        $sentenca = $conexao->prepare($sql);
        $sentenca->bindValue(':codFilme', $codFilme);
        $sentenca->bindValue(':codAvaliador', $codAvaliador);
        $sentenca->bindValue(':avaliacao', $avaliacao);
    }

    $sentenca->execute();
    fecharConexao();
    return $sentenca->rowCount();
}

function excluirAvaliacoesFilme($codFilme)
{
    $conexao = criarConexao();

    $sql = "DELETE FROM Avaliacao WHERE codFilme = :codFilme;";
    $sentenca = $conexao->prepare($sql);
    $sentenca->bindValue(':codFilme', $codFilme);

    $sentenca->execute();
    $conexao = null;
}

function verificarAvaliacao($codFilme, $codAvaliador)
{
    if (!isset($_SESSION['codAvaliador'])) {
        return 0; 
    }

    $sql = "SELECT * FROM Avaliacao WHERE codAvaliador = :codAvaliador AND codFilme = :codFilme;";

    $conexao = criarConexao();
    $sentenca = $conexao->prepare($sql);
    $sentenca->bindValue(':codAvaliador', $codAvaliador);
    $sentenca->bindValue(':codFilme', $codFilme);

    $sentenca->execute();
    $conexao = null;

    return $sentenca->rowCount();
}

function retornaAvaliacao($codFilme, $codAvaliador)
{
    if (!isset($_SESSION['codAvaliador'])) {
        return 0; 
    }

    $sql = "SELECT * FROM Avaliacao WHERE codAvaliador = :codAvaliador AND codFilme = :codFilme;";

    $conexao = criarConexao();
    $sentenca = $conexao->prepare($sql);
    $sentenca->bindValue(':codAvaliador', $codAvaliador);
    $sentenca->bindValue(':codFilme', $codFilme);

    $sentenca->execute();
    $conexao = null;

    $avaliacao = $sentenca->fetch();

    return $avaliacao['avaliacao'];
}

