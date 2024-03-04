<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
include_once "bancoDadosCRUD.php";

function salvarComentario($codFilme, $codAvaliador, $comentario)
{
    if (!isset($_SESSION['codAvaliador'])) {
        return 0; 
    }

    $conexao = criarConexao();

    $sql = "INSERT INTO Comentario(codFilme, codAvaliador, comentario) VALUES(:codFilme, :codAvaliador, :comentario);";
    $sentenca = $conexao->prepare($sql);
    $sentenca->bindValue(':codFilme', $codFilme);
    $sentenca->bindValue(':codAvaliador', $codAvaliador);
    $sentenca->bindValue(':comentario', $comentario);

    $sentenca->execute();
    fecharConexao();
    return $sentenca->rowCount();
}

function excluirComentariosFilme($codFilme)
{
    if (!isset($_SESSION['codAvaliador'])) {
        return 0; 
    }

    $conexao = criarConexao();

    $sql = "DELETE FROM Comentario WHERE codFilme = :codFilme;";
    $sentenca = $conexao->prepare($sql);
    $sentenca->bindValue(':codFilme', $codFilme);

    $sentenca->execute();
    $conexao = null;
}

function listarComentarios()
{
    $sql = "SELECT * FROM Comentario;";

    $conexao = criarConexao();
    $sentenca = $conexao->prepare($sql);

    $sentenca->execute();
    $conexao = null;
    return $sentenca->fetchAll();
}

function listarComentariosFilmeAvaliador($codFilme)
{
    $sql = "SELECT Avaliador.*, Comentario.* FROM Comentario
    INNER JOIN Avaliador ON Avaliador.codAvaliador = Comentario.codAvaliador
    WHERE codFilme = :codFilme;";

    $conexao = criarConexao();
    $sentenca = $conexao->prepare($sql);
    $sentenca->bindValue(':codFilme', $codFilme);

    $sentenca->execute();
    $conexao = null;
    return $sentenca->fetchAll();
}

function listarComentariosFilmeAvaliadorPopulares($codFilme)
{
    $sql = "SELECT Avaliador.*, Comentario.* FROM Comentario
    INNER JOIN Avaliador ON Avaliador.codAvaliador = Comentario.codAvaliador    WHERE codFilme = :codFilme;";

    $conexao = criarConexao();
    $sentenca = $conexao->prepare($sql);
    $sentenca->bindValue(':codFilme', $codFilme);

    $sentenca->execute();

    $comentarios = $sentenca->fetchAll();
    shuffle($comentarios);

    $conexao = null;
    return $comentarios;
}



function listarAvaliadorComentario($codFilme)
{
    $sql = "SELECT * FROM Filme WHERE codFilme = :codFilme;";

    $conexao = criarConexao();
    $sentenca = $conexao->prepare($sql);
    $sentenca->bindValue(':codFilme', $codFilme);

    $sentenca->execute();
    $conexao = null;
    return $sentenca->fetch();
}

function calcularQuantidadeCurtidasComentario($codComentario)
{
    $sql = "SELECT * FROM CurtidaComentario WHERE codComentario = :codComentario;";

    $conexao = criarConexao();

    $sentenca = $conexao->prepare($sql);
    $sentenca->bindValue(':codComentario', $codComentario);

    $sentenca->execute();
    $conexao = null;

    $vetorCurtidas = $sentenca->fetchAll();

    return count($vetorCurtidas);
}

function calcularQuantidadeDeslikesComentario($codComentario)
{
    $sql = "SELECT * FROM DeslikeComentario WHERE codComentario = :codComentario;";

    $conexao = criarConexao();

    $sentenca = $conexao->prepare($sql);
    $sentenca->bindValue(':codComentario', $codComentario);

    $sentenca->execute();
    $conexao = null;

    $vetorDeslike = $sentenca->fetchAll();

    return count($vetorDeslike);
}
