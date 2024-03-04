<?php
include_once "crud/avaliadorCRUD.php";
include_once "crud/filmeCRUD.php";

$filmesMaisCurtidos = listarFilmesMelhorAvaliados();
$tem = count($filmesMaisCurtidos) > 0;
$bannerPrincipal = $tem ? $filmesMaisCurtidos[0]['banner'] : "imagens/naoHaFilmes.png";

if (!isset($_SESSION['codAdiministrador'])) {
    echo "<script>alert('Logue como Adiministrador para acessar essa página!');</script>";
    echo "<script>window.location.replace('paginaAdministrador.php');</script>";
}
?>

<html>

<head>
    <meta charset="utf-8" />
    <title> ScreenScore - Página mais curtidos do momento </title>
    <link type="text/css" rel="stylesheet" href="css/bootstrap.css" />
    <link type="text/css" rel="stylesheet" href="css/estilos.css" />
    <link type="text/css" rel="stylesheet" href="css/paginaMaisCurtidosDoMomento.css" />
    <link type="text/css" rel="stylesheet" href="css/menu.css" />
</head>

<body>
    <?php
    include_once "menuAdiministradorPaginas.php";
    ?>
    <div id="banner">
        <div class="gradient-overlay"></div>
        <img class="banner" src="<?= $bannerPrincipal ?>">
    </div>
    <div class="container">
        <div class="textoSimbolo">
            <p class="textoCatalogo">
                Confira os filmes mais bem avaliados
            </p>
        </div>

        <?php if ($tem) { ?>
            <div class="listaDeFilmes mt-3">
                <hr class="linha">
                <?php
                $contador = 0;
                foreach ($filmesMaisCurtidos as $filme) {
                    if ($contador % 4 == 0) {
                        echo '<div class="row">';
                    }
                ?>
                    <div class="col-md-3">
                        <div class="capaRanking">
                            <div class="capaFilme">
                                <a href="sessaoFilmeAdmin.php?codFilme=<?= $filme['codFilme']; ?>">
                                    <img class="imagemCapaFilme" src="<?= $filme['capa']; ?>" alt="">
                                </a>
                            </div>
                            <div class="ranking <?php
                                                if ($contador == 0) {
                                                    echo "primeiro";
                                                } else if ($contador == 1) {
                                                    echo "segundo";
                                                } else if ($contador == 2) {
                                                    echo "terceiro";
                                                }
                                                ?>">
                                <?= $contador + 1; ?>
                            </div>
                        </div>

                    </div>
                <?php
                    $contador++;
                    if ($contador % 4 == 0) {
                        echo '</div>
                        <br> <br> <br> <br>';
                    }
                }
                ?>
            </div>
        <?php } else { ?>
            <div>Não há filmes cadastrados</div>
        <?php } ?>
    </div>

    </div>
    <br>
    <br>

    <footer class="footer">
    </footer>

    <script type="text/javascript" src="js/jquery.js"></script>
    <script type="text/javascript" src="js/bootstrap.js"></script>
    <script type="text/javascript" src="js/jquery.mask.js"></script>
    <script type="text/javascript" src="js/jquery.validate.js"></script>
    <script type="text/javascript" src="js/additional-methods.js"></script>
    <script type="text/javascript" src="js/localization/messages_pt_BR.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
</body>


</html>