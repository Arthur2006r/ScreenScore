<?php
include_once "bancoDadosCRUD.php";
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

function salvarAvaliador($codAvaliador, $username, $email, $senha, $avatar)
{
    $conexao = criarConexao();

    if ($codAvaliador <= 0) {
        $sql = "INSERT INTO Avaliador(username, email, senha, avatar) VALUES(:username, :email, :senha, :avatar);";
        $sentenca = $conexao->prepare($sql);
        $sentenca->bindValue(':username', $username);
        $sentenca->bindValue(':email', $email);
        $sentenca->bindValue(':senha', $senha);
        $sentenca->bindValue(':avatar', $avatar);
    }

    $sentenca->execute();
    fecharConexao();
    return $sentenca->rowCount();
}

function EditarAvaliador($codAvaliador, $username, $email, $biografia, $caminhoArquivo)
{
    if (!isset($_SESSION['codAvaliador'])) {
        // O usuário não está autenticado, redirecione para a página de login ou exiba uma mensagem de erro.
        header('Location: login.php');
        exit();
    }

    $conexao = criarConexao();

    $sql = "UPDATE Avaliador SET username = :username, email = :email, avatar = :caminhoArquivo, biografia = :biografia WHERE codAvaliador = :codAvaliador;";
    $sentenca = $conexao->prepare($sql);
    $sentenca->bindValue(':username', $username);
    $sentenca->bindValue(':email', $email);
    $sentenca->bindValue(':biografia', $biografia);
    $sentenca->bindValue(':caminhoArquivo', $caminhoArquivo);
    $sentenca->bindValue(':codAvaliador', $codAvaliador);

    $sentenca->execute();
    fecharConexao();
    return $sentenca->rowCount();
}

function excluirAvaliador($codAvaliador)
{
    if (!isset($_SESSION['codAvaliador'])) {
        // O usuário não está autenticado, redirecione para a página de login ou exiba uma mensagem de erro.
        header('Location: login.php');
        exit();
    }

    $conexao = criarConexao();

    $sql = "DELETE FROM Avaliador WHERE codAvaliador = :codAvaliador;";
    $sentenca = $conexao->prepare($sql);
    $sentenca->bindValue(':codAvaliador', $codAvaliador);

    $sentenca->execute();
    $conexao = null;
    return $sentenca->rowCount();
}


function listarAvaliador()
{
    $sql = "SELECT * FROM Avaliador;";

    $conexao = criarConexao();
    $sentenca = $conexao->prepare($sql);

    $sentenca->execute();
    $conexao = null;
    return $sentenca->fetchAll();
}

function buscarAvaliadorPorId($codAvaliador)
{
    $sql = "SELECT * FROM Avaliador WHERE codAvaliador = :codAvaliador;";

    $conexao = criarConexao();

    $sentenca = $conexao->prepare($sql);
    $sentenca->bindValue(':codAvaliador', $codAvaliador);

    $sentenca->execute();
    $conexao = null;

    return $sentenca->fetchAll();
}

function autenticarAvaliador($email, $senha)
{
    try {
        $sql = "SELECT * FROM Avaliador WHERE email = :email AND senha = :senha;";

        $conexao = criarConexao();
        $sentenca = $conexao->prepare($sql);
        $sentenca->bindValue(':email', $email);
        $sentenca->bindValue(':senha', $senha);

        $sentenca->execute();
        $conexao = null;

        $avaliadores = $sentenca->fetchAll();
        $avaliador = $avaliadores[0];
        return $avaliador['codAvaliador'];
    } catch (PDOException $erro) {
        criarArquivoErro($erro);
        die();
    }
}

function verificarAvaliador($email, $senha)
{
    $sql = "SELECT * FROM Avaliador WHERE email = :email AND senha = :senha;";

    $conexao = criarConexao();
    $sentenca = $conexao->prepare($sql);
    $sentenca->bindValue(':email', $email);
    $sentenca->bindValue(':senha', $senha);

    $sentenca->execute();
    $conexao = null;

    $avaliadores = $sentenca->fetchAll();
    $avaliador = $avaliadores[0];
    return $avaliador['codAvaliador'];
}

function verificarEmail($email, $codAvaliador)
{
    $sql = "SELECT * FROM Avaliador WHERE email = :email AND codAvaliador <> :codAvaliador;";

    $conexao = criarConexao();
    $sentenca = $conexao->prepare($sql);
    $sentenca->bindValue(':email', $email);
    $sentenca->bindValue(':codAvaliador', $codAvaliador);

    $sentenca->execute();
    $conexao = null;

    return $sentenca->rowCount();
}

function verificarUsername($username, $codAvaliador)
{
    $sql = "SELECT * FROM Avaliador WHERE username = :username AND codAvaliador <> :codAvaliador;";

    $conexao = criarConexao();
    $sentenca = $conexao->prepare($sql);
    $sentenca->bindValue(':username', $username);
    $sentenca->bindValue(':codAvaliador', $codAvaliador);

    $sentenca->execute();
    $conexao = null;

    return $sentenca->rowCount();
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
