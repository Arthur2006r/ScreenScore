<?php
include_once "bancoDadosCRUD.php";
include_once "vizualizacaoCRUD.php";
include_once "curtidaCRUD.php";
include_once "deslikeCRUD.php";
include_once "avaliacaoCRUD.php";
include_once "comentarioCRUD.php";

function salvarFilme($codFilme, $titulo, $diretor, $dataEstreia, $sinopse, $caminhoExtensaoCapa, $caminhoExtensaoBanner, $tema)
{
    $conexao = criarConexao();

    if ($codFilme > 0) {
        $sql = "UPDATE Filme SET titulo = :titulo, diretor = :diretor, dataEstreia = :dataEstreia, sinopse = :sinopse, capa = :caminhoExtensaoCapa, banner = :caminhoExtensaoBanner, tema = :tema WHERE codFilme = :codFilme;";
        $sentenca = $conexao->prepare($sql);
        $sentenca->bindValue(':titulo', $titulo);
        $sentenca->bindValue(':diretor', $diretor);
        $sentenca->bindValue(':sinopse', $sinopse);
        $sentenca->bindValue(':dataEstreia', $dataEstreia);
        $sentenca->bindValue(':caminhoExtensaoBanner', $caminhoExtensaoBanner);
        $sentenca->bindValue(':caminhoExtensaoCapa', $caminhoExtensaoCapa);
        $sentenca->bindValue(':codFilme', $codFilme);
        $sentenca->bindValue(':tema', $tema);
    } else {
        $sql = "INSERT INTO Filme(titulo, diretor, sinopse, dataEstreia, capa, banner, tema) VALUES(:titulo, :diretor, :sinopse, :dataEstreia, :caminhoExtensaoCapa,  :caminhoExtensaoBanner, :tema);";
        $sentenca = $conexao->prepare($sql);
        $sentenca->bindValue(':titulo', $titulo);
        $sentenca->bindValue(':diretor', $diretor);
        $sentenca->bindValue(':sinopse', $sinopse);
        $sentenca->bindValue(':dataEstreia', $dataEstreia);
        $sentenca->bindValue(':caminhoExtensaoBanner', $caminhoExtensaoBanner);
        $sentenca->bindValue(':caminhoExtensaoCapa', $caminhoExtensaoCapa);
        $sentenca->bindValue(':tema', $tema);
    }

    $sentenca->execute();
    fecharConexao();
    return $sentenca->rowCount();
}

function excluirFilme($codFilme)
{

    $conexao = criarConexao();

    excluirCurtidasFilme($codFilme);
    excluirDeslikesFilme($codFilme);
    excluirVizualizacoesioFilme($codFilme);
    excluirComentariosFilme($codFilme);
    excluirAvaliacoesFilme($codFilme);

    $sql = "DELETE FROM Filme WHERE codFilme = :codFilme;";
    $sentenca = $conexao->prepare($sql);
    $sentenca->bindValue(':codFilme', $codFilme);

    $sentenca->execute();
    $conexao = null;
    return $sentenca->rowCount();
}

function listarFilme()
{
    $sql = "SELECT * FROM Filme;";

    $conexao = criarConexao();
    $sentenca = $conexao->prepare($sql);

    $sentenca->execute();
    $conexao = null;
    return $sentenca->fetchAll();
}

function listarFilmesRecentes()
{
    $sql = "SELECT * FROM Filme 
    ORDER BY Filme.codFilme DESC;";

    $conexao = criarConexao();
    $sentenca = $conexao->prepare($sql);

    $sentenca->execute();
    $conexao = null;
    return $sentenca->fetchAll();
}


function listarFilmesCategoria($tema)
{
    $sql = "SELECT * FROM Filme WHERE tema = :tema;";

    $conexao = criarConexao();
    $sentenca = $conexao->prepare($sql);
    $sentenca->bindValue(':tema', $tema);

    $sentenca->execute();
    $conexao = null;

    return $sentenca->rowCount() >= 1 ? $sentenca->fetchAll() : null;
}

function listarFilmesMaisCurtidos()
{
    $sql = "SELECT * FROM Filme;";

    $conexao = criarConexao();
    $sentenca = $conexao->prepare($sql);

    $sentenca->execute();
    $conexao = null;
    $filmes = $sentenca->fetchAll();

    usort($filmes, function ($a, $b) {
        $avaliacaoA = calcularQuantidadeCurtidas($a['codFilme']);
        $avaliacaoB = calcularQuantidadeCurtidas($b['codFilme']);

        if ($avaliacaoA == $avaliacaoB) {
            return 0;
        }

        return ($avaliacaoA > $avaliacaoB) ? -1 : 1;
    });

    return $filmes;
}

function listarFilmesMelhorAvaliados()
{
    $sql = "SELECT * FROM Filme;";

    $conexao = criarConexao();
    $sentenca = $conexao->prepare($sql);

    $sentenca->execute();
    $conexao = null;
    $filmes = $sentenca->fetchAll();

    usort($filmes, function ($a, $b) {
        $avaliacaoA = calcularAvaliacao($a['codFilme']);
        $avaliacaoB = calcularAvaliacao($b['codFilme']);

        if ($avaliacaoA == $avaliacaoB) {
            return 0;
        }

        return ($avaliacaoA > $avaliacaoB) ? -1 : 1;
    });

    return $filmes;
}

function buscarFilmePorId($codFilme)
{
    $sql = "SELECT * FROM Filme WHERE codFilme = :codFilme;";

    $conexao = criarConexao();

    $sentenca = $conexao->prepare($sql);
    $sentenca->bindValue(':codFilme', $codFilme);

    $sentenca->execute();
    $conexao = null;

    return $sentenca->fetch();
}

function verificarFilme($diretor, $sinopse)
{
    $sql = "SELECT * FROM Filme WHERE diretor = :diretor AND sinopse = :sinopse;";

    $conexao = criarConexao();
    $sentenca = $conexao->prepare($sql);
    $sentenca->bindValue(':diretor', $diretor);
    $sentenca->bindValue(':sinopse', $sinopse);

    $sentenca->execute();
    $conexao = null;

    $avaliador = $sentenca->fetch();

    if ($avaliador === false) {
        return 0;
    } else {
        return $avaliador['codFilme'];
    }
}

function gerarNomeImagemCapaBanner($extensaoArquivo)
{
    $nomeUnico = uniqid("0", true) . "." . $extensaoArquivo;
    return $nomeUnico;
}

function calcularQuantidadeVistosFilme($codFilme)
{
    $sql = "SELECT * FROM Vizualizacao WHERE codFilme = :codFilme;";

    $conexao = criarConexao();

    $sentenca = $conexao->prepare($sql);
    $sentenca->bindValue(':codFilme', $codFilme);

    $sentenca->execute();
    $conexao = null;

    $vetorVistos = $sentenca->fetchAll();

    return count($vetorVistos);
}

function calcularQuantidadeCurtidas($codFilme)
{
    $sql = "SELECT * FROM Curtida WHERE codFilme = :codFilme;";

    $conexao = criarConexao();

    $sentenca = $conexao->prepare($sql);
    $sentenca->bindValue(':codFilme', $codFilme);

    $sentenca->execute();
    $conexao = null;

    $vetorCurtidas = $sentenca->fetchAll();

    return count($vetorCurtidas);
}

function calcularQuantidadeDeslikes($codFilme)
{
    $sql = "SELECT * FROM Deslike WHERE codFilme = :codFilme;";

    $conexao = criarConexao();

    $sentenca = $conexao->prepare($sql);
    $sentenca->bindValue(':codFilme', $codFilme);

    $sentenca->execute();
    $conexao = null;

    $vetorDeslike = $sentenca->fetchAll();

    return count($vetorDeslike);
}

function calcularQuantidadeAvaliacoesFilme($codFilme)
{
    $sql = "SELECT * FROM Avaliacao WHERE codFilme = :codFilme;";

    $conexao = criarConexao();

    $sentenca = $conexao->prepare($sql);
    $sentenca->bindValue(':codFilme', $codFilme);

    $sentenca->execute();
    $conexao = null;

    $vetorAvaliacoes = $sentenca->fetchAll();

    return count($vetorAvaliacoes);
}

function calcularAvaliacao($codFilme)
{
    $sql = "SELECT * FROM Avaliacao WHERE codFilme = :codFilme;";

    $conexao = criarConexao();

    $sentenca = $conexao->prepare($sql);
    $sentenca->bindValue(':codFilme', $codFilme);

    $sentenca->execute();
    $conexao = null;

    $vetorAvaliacoes = $sentenca->fetchAll();
    $soma = 0;

    foreach ($vetorAvaliacoes as $avaliacao) {
        $soma += $avaliacao['avaliacao'];
    }

    return count($vetorAvaliacoes) == 0 ? 0 : number_format(($soma / count($vetorAvaliacoes)), 1);
}

function formatarData($data)
{
    $dataFormatada = date("d/m/Y", strtotime($data));
    return $dataFormatada;
}

function verificarTitulo($titulo, $codFilme)
{
    $sql = "SELECT * FROM Filme WHERE titulo = :titulo AND codFilme <> :codFilme;";

    $conexao = criarConexao();
    $sentenca = $conexao->prepare($sql);
    $sentenca->bindValue(':titulo', $titulo);
    $sentenca->bindValue(':codFilme', $codFilme);

    $sentenca->execute();
    $conexao = null;

    return $sentenca->rowCount();
}

function verificarCapa($capa, $capaReserva)
{
    if($capaReserva =! "") {
        return 1;
    } else if($capa != "imagens/imagemDeFundo.jpg") {
        return 1;
    } else {
        return 0;
    }
}
