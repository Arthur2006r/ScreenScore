<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
include_once "bancoDadosCRUD.php";

function verificarAdiministrador($codAdiministrador, $senha)
{
    $sql = "SELECT * FROM Adiministrador WHERE codAdiministrador = :codAdiministrador AND senha = :senha;";

    $conexao = criarConexao();
    $sentenca = $conexao->prepare($sql);
    $sentenca->bindValue(':codAdiministrador', $codAdiministrador);
    $sentenca->bindValue(':senha', $senha);

    $sentenca->execute();
    $conexao = null;

    return $sentenca->fetch();
}

function gerarNomeImagem($extensaoArquivo)
{
    $nomeUnico = uniqid("0", true) . "." . $extensaoArquivo;
    return $nomeUnico;
}

function calcularQuantidadeVistos($codAvaliador)
{
    $sql = "SELECT * FROM Vizualizacao WHERE codAvaliador = :codAvaliador;";

    $conexao = criarConexao();

    $sentenca = $conexao->prepare($sql);
    $sentenca->bindValue(':codAvaliador', $codAvaliador);

    $sentenca->execute();
    $conexao = null;

    $vetorVistos = $sentenca->fetchAll();

    return count($vetorVistos);
}

function calcularQuantidadeCurtidos($codAvaliador)
{
    $sql = "SELECT * FROM Curtida WHERE codAvaliador = :codAvaliador;";

    $conexao = criarConexao();

    $sentenca = $conexao->prepare($sql);
    $sentenca->bindValue(':codAvaliador', $codAvaliador);

    $sentenca->execute();
    $conexao = null;

    $vetorVistos = $sentenca->fetchAll();

    return count($vetorVistos);
}

function calcularQuantidadeAvaliacoes($codAvaliador)
{
    $sql = "SELECT * FROM Avaliacao WHERE codAvaliador = :codAvaliador;";

    $conexao = criarConexao();

    $sentenca = $conexao->prepare($sql);
    $sentenca->bindValue(':codAvaliador', $codAvaliador);

    $sentenca->execute();
    $conexao = null;

    $vetorVistos = $sentenca->fetchAll();

    return count($vetorVistos);
}
