<?php
include_once "crud/filmeCRUD.php";
include_once "crud/comentarioCRUD.php";

$codFilme = 0;
$titulo = "";
$diretor = "";
$dataEstreia = "";
$sinopse = "";
$capa = "";
$banner = "";
$tema = "";

if (isset($_SESSION['codAdiministrador'])) {
    if (isset($_SESSION['codFilme'])) {

        $registro = buscarFilmePorId($_SESSION['codFilme']);
    
        $codFilme = $registro['codFilme'];
        $titulo = $registro['titulo'];
        $diretor = $registro['diretor'];
        $dataEstreia = $registro['dataEstreia'];
        $sinopse = $registro['sinopse'];
        $capa = $registro['capa'];
        $banner = $registro['banner'];
        $tema = $registro['tema'];
    
        $vistos = calcularQuantidadeVistosFilme($codFilme);
        $curtidas = calcularQuantidadeCurtidas($codFilme);
        $deslikes = calcularQuantidadeDeslikes($codFilme);
        $avaliacoes = calcularQuantidadeAvaliacoesFilme($codFilme);
        $avaliacao = calcularAvaliacao($codFilme);
    } else {
        echo "<script>alert('Nenhum Filme Selecionado! Tente novamente mais tarde');</script>";
        echo "<script>window.location.replace('paginaInicialAdiministrador.php');</script>";
    }
} else {
    echo "<script>alert('Logue como Adiministrador para acessar essa página!');</script>";
    echo "<script>window.location.replace('paginaAdministrador.php');</script>";
}
?>

<html>

<head>
    <meta charset="utf-8" />
    <title> ScreenScore - Página filme </title>
    <link type="text/css" rel="stylesheet" href="css/bootstrap.css" />
    <link type="text/css" rel="stylesheet" href="css/estilos.css" />
    <link type="text/css" rel="stylesheet" href="css/paginaFilme.css" />
    <link type="text/css" rel="stylesheet" href="css/menuPaginaFilme.css" />
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@48,400,1,200" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@48,400,0,0" />
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script type="text/javascript" src="js/jquery.js"></script>
    <script type="text/javascript" src="js/bootstrap.js"></script>
    <script type="text/javascript" src="js/jquery.mask.js"></script>
</head>

<body>
    <?php
    include_once "menuAdiministradorPaginas.php";
    ?>

    <div id="banner">
        <div class="gradient-overlay">
        </div>
        <img class="banner" src="<?= $banner ?>">
    </div>

    <div class="container mt-5">
        <div id="dadosFilme">
            <div id="capaStatus">
                <div id="capa">
                    <img class="capa" src="<?= $capa ?>">
                </div>
                <div id="status">
                    <div id="vizualizacoes">
                        <div id="iconeVizu">
                            <span class="material-symbols-outlined iconeDadoVizu ">
                                visibility
                            </span>
                        </div>
                        <div id="dadosVizu">
                            <?= $vistos ?>
                        </div>
                    </div>
                    <div id="curtidas">
                        <div id="iconeCurti">
                            <span class="material-symbols-outlined iconeDadoCurtidas">
                                favorite
                            </span>
                        </div>
                        <div id="dadosCurti">
                            <?= $curtidas ?>
                        </div>
                    </div>
                    <div id="deslikes">
                        <div id="iconeDeslike">
                            <span class="material-symbols-outlined iconeDadoDeslike">
                                thumb_down
                            </span>
                        </div>
                        <div id="dadosDeslike">
                            <?= $deslikes ?>
                        </div>
                    </div>
                </div>
            </div>

            <div id="dados">
                <div id="titulo">
                    <?= $titulo ?> </div>
                <div id="dataEstreia">
                    Data de estreia <p style="display: inline;" class="data"><?= formatarData($dataEstreia) ?></p>
                </div>
                <div id="diretor">
                    Dirigido por <p style="display: inline;" class="diretor"><?= $diretor ?></p>
                </div>
                <div id="tema">
                    Genêro <p style="display: inline;" class="data"><?= $tema ?></p>
                </div>
                <div id="sinopse">
                    <p style="display: inline;" class="diretor">Sinopse</p>
                    <p class="sinopseP"><?= $sinopse ?></p>
                </div>
            </div>

            <div id="tabelaAvaliacao">
                <div id="caixaInteracaoAdmin">
                    <div id="visto" class="text-center">
                    </div>
                    <div id="like">
                        <a href="paginaEditarFilme.php" class="botaoEditar"> Editar </a>
                    </div>
                    <div id="deslike">
                    </div>
                    <hr id="barraCaixaAvaliacao" class="mt-1">
                    <div id="avaliar">
                        <button onclick="confirmarExclusao(<?= $codFilme ?>)" class="btn btn-danger float-center botaoExcluir"> Excluir </button>
                    </div>
                </div>
                <div id="avaliacao">
                    <div id="statusAvaliacoes">
                        <div class="divAvaliacoes">
                            <div class="textoAvaliacoes">
                                Avaliações </div>
                            <div class="quantidadeAvaliacoes">
                                <?= $avaliacoes ?> </div>
                        </div>
                    </div>
                    <hr id="barraDivisoria">
                    <div id="mediaAvaliacao">
                        <div id="media">
                            <?= $avaliacao ?> </div>
                        <div id="iconeMedia">
                            <span class="material-symbols-outlined estrelaMedia">
                                grade </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <br>
    <br>

    <footer class="footer">
    </footer>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script type="text/javascript" src="js/bootstrap.js"></script>
    <script type="text/javascript" src="js/jquery.mask.js"></script>
    <script type="text/javascript" src="js/jquery.validate.js"></script>
    <script type="text/javascript" src="js/additional-methods.js"></script>
    <script type="text/javascript" src="js/localization/messages_pt_BR.js"></script>
    <script type="text/javascript" src="js/paginaFilmeAdiministrador.js"></script>
</body>


</html>