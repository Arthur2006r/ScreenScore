<?php
include_once "crud/avaliadorCRUD.php";
include_once "crud/filmeCRUD.php";

if (isset($_SESSION['codAvaliador'])) {
    $codAvaliador = $_SESSION['codAvaliador'];
    if (isset($_SESSION['categoria'])) {
        $categoria = $_SESSION['categoria'];
    } else {
        echo "<script>alert('Nenhuma categoria foi selecionada! Tente novamente mais tarde');</script>";
        echo "<script>window.location.replace('paginaInicial.php');</script>";
    }
} else {
    echo "<script>alert('Logue para acessar essa página!');</script>";
    echo "<script>window.location.replace('paginaLogin.php');</script>";
}

$filmesCategoria = listarFilmesCategoria($categoria);
$tem = count($filmesCategoria) > 0;
?>

<html>

<head>
    <meta charset="utf-8" />
    <title> ScreenScore - Página mais curtidos do momento </title>
    <link type="text/css" rel="stylesheet" href="css/bootstrap.css" />
    <link type="text/css" rel="stylesheet" href="css/estilos.css" />
    <link type="text/css" rel="stylesheet" href="css/paginaInicial.css" />
    <link type="text/css" rel="stylesheet" href="css/menu.css" />
</head>

<body>
    <?php
    include_once "menu.php";
    ?>
    <div class="container">
        <div class="textoSimbolo mt-5">
            <p class="textoCatalogo">
                Confira os filmes do gênero <?= $categoria ?>
            </p>
        </div>
        <hr class="linhaFiomeGenero">
        <?php if ($tem) { ?>
            <div class="listaDeFilmes">
                <?php
                $contador = 0;
                foreach ($filmesCategoria as $filme) {
                    if ($contador % 4 === 0) {
                        if ($contador !== 0) {
                            echo '<br> <br> <br> <br>';
                        }
                        echo '<div class="row">';
                    }
                ?>
                    <div class="col-md-3">
                        <div class="capaFilme">
                            <a href="paginaSessaoFilme.php?codFilme=<?= $filme['codFilme']; ?>">
                                <img class="imagemCapaFilme" src="<?= $filme['capa']; ?>" alt="">
                            </a>
                        </div>
                    </div>
                <?php
                    $contador++;
                    if ($contador % 4 === 0) {
                        echo '</div>';
                    }
                }
                if ($contador % 4 !== 0) {
                    echo '</div>';
                }
                ?>
            </div>
        <?php } else { ?>
            <div>Não há filmes do gênero <?= $categoria ?></div>
        <?php } ?>

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