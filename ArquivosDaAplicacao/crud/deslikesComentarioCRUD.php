<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
include_once "bancoDadosCRUD.php";

function salvarDeslikeComentario($codComentario, $codAvaliador)
{
    if (!isset($_SESSION['codAvaliador'])) {
        return 0; 
    }

    $conexao = criarConexao();

    $sql = "INSERT INTO DeslikeComentario(codComentario, codAvaliador) VALUES(:codComentario, :codAvaliador);";
    $sentenca = $conexao->prepare($sql);
    $sentenca->bindValue(':codComentario', $codComentario);
    $sentenca->bindValue(':codAvaliador', $codAvaliador);

    $sentenca->execute();
    fecharConexao();
    return $sentenca->rowCount();
}

function excluirDeslikeComent($codComentario, $codAvaliador)
{
    if (!isset($_SESSION['codAvaliador'])) {
        return 0; 
    }

    $conexao = criarConexao();

    $sql = "DELETE FROM DeslikeComentario WHERE codComentario = :codComentario AND codAvaliador = :codAvaliador;";
    $sentenca = $conexao->prepare($sql);
    $sentenca->bindValue(':codComentario', $codComentario);
    $sentenca->bindValue(':codAvaliador', $codAvaliador);

    $sentenca->execute();
    $conexao = null;
    return $sentenca->rowCount();
}

function excluirDeslikesComentario($codComentario)
{
    $conexao = criarConexao();

    $sql = "DELETE FROM DeslikeComentario WHERE codComentario = :codComentario;";
    $sentenca = $conexao->prepare($sql);
    $sentenca->bindValue(':codComentario', $codComentario);

    $sentenca->execute();
    $conexao = null;
}

function verificarDeslikeComentario($codComentario, $codAvaliador)
{
    if (!isset($_SESSION['codAvaliador'])) {
        return 0; 
    }
    
    $sql = "SELECT * FROM DeslikeComentario WHERE codAvaliador = :codAvaliador AND codComentario = :codComentario;";

    $conexao = criarConexao();
    $sentenca = $conexao->prepare($sql);
    $sentenca->bindValue(':codAvaliador', $codAvaliador);
    $sentenca->bindValue(':codComentario', $codComentario);

    $sentenca->execute();
    $conexao = null;

    return $sentenca->rowCount();
}
