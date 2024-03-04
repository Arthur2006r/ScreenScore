<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
include_once "bancoDadosCRUD.php";

function salvarCurtidaComentario($codComentario, $codAvaliador)
{
    if (!isset($_SESSION['codAvaliador'])) {
        return 0; 
    }

    $conexao = criarConexao();

    $sql = "INSERT INTO CurtidaComentario(codComentario, codAvaliador) VALUES(:codComentario, :codAvaliador);";
    $sentenca = $conexao->prepare($sql);
    $sentenca->bindValue(':codComentario', $codComentario);
    $sentenca->bindValue(':codAvaliador', $codAvaliador);

    $sentenca->execute();
    fecharConexao();
    return $sentenca->rowCount();
}

function excluirCurtidaComent($codComentario, $codAvaliador)
{
    if (!isset($_SESSION['codAvaliador'])) {
        return 0; 
    }

    $conexao = criarConexao();

    $sql = "DELETE FROM CurtidaComentario WHERE codComentario = :codComentario AND codAvaliador = :codAvaliador;";
    $sentenca = $conexao->prepare($sql);
    $sentenca->bindValue(':codComentario', $codComentario);
    $sentenca->bindValue(':codAvaliador', $codAvaliador);

    $sentenca->execute();
    $conexao = null;
    return $sentenca->rowCount();
}

function excluirCurtidasComentario($codComentario)
{
    $conexao = criarConexao();

    $sql = "DELETE FROM CurtidaComentario WHERE codComentario = :codComentario;";
    $sentenca = $conexao->prepare($sql);
    $sentenca->bindValue(':codComentario', $codComentario);

    $sentenca->execute();
    $conexao = null;
}

function verificarCurtidaComentario($codComentario, $codAvaliador)
{
    if (!isset($_SESSION['codAvaliador'])) {
        return 0; 
    }

    $sql = "SELECT * FROM CurtidaComentario WHERE codAvaliador = :codAvaliador AND codComentario = :codComentario;";

    $conexao = criarConexao();
    $sentenca = $conexao->prepare($sql);
    $sentenca->bindValue(':codAvaliador', $codAvaliador);
    $sentenca->bindValue(':codComentario', $codComentario);

    $sentenca->execute();
    $conexao = null;

    return $sentenca->rowCount();
}
