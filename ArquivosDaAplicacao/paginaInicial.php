<?php
session_start();
include_once "crud/avaliadorCRUD.php";
include_once "crud/filmeCRUD.php";

if (isset($_SESSION['codAvaliador'])) {
    $codAvaliador = $_SESSION['codAvaliador'];

    if (isset($_SESSION['codFilme'])) {
        unset($_SESSION['codFilme']);
    }

    if (isset($_SESSION['categoria'])) {
        unset($_SESSION['categoria']);
    }
} else {
    echo "<script>alert('Logue para acessar essa página!');</script>";
    echo "<script>window.location.replace('paginaLogin.php');</script>";
}
?>

<html>

<head>
    <meta charset="utf-8" />
    <title> ScreenScore - Página inicial </title>
    <link type="text/css" rel="stylesheet" href="css/bootstrap.css" />
    <link type="text/css" rel="stylesheet" href="css/estilos.css" />
    <link type="text/css" rel="stylesheet" href="css/paginaInicial.css" />
    <link type="text/css" rel="stylesheet" href="css/menu.css" />
</head>

<body>
    <?php
    include_once "menu.php";
    ?>
    <br>
    <br>
    <div class="container">
        <div id="carrossel">
            <div id="carouselExampleFade" class="carousel slide carousel-fade" data-ride="carousel">
                <div class="carousel-inner">
                    <div class="carousel-item active">
                        <img class="d-block w-100 imagemCarousel" src="imagens/imagemCarrossel2.jpeg" alt="Primeiro Slide">
                    </div>
                    <div class="carousel-item">
                        <img class="d-block w-100 imagemCarousel" src="imagens/imagemCarrossel3.jpeg" alt="Segundo Slide">
                    </div>
                    <div class="carousel-item">
                        <img class="d-block w-100 imagemCarousel" src="imagens/imagemCarrossel1.jpeg" alt="Terceiro Slide">
                    </div>
                </div>
            </div>
        </div>
        <br>
        <br>

        <div class="textoSimbolo">
            <p class="textoCatalogo">
                Catálogo ScreenScore
            </p>
        </div>

        <?php
        $filmesAção = listarFilmesCategoria("Ação");
        $tem = $filmesAção != null ? true : false;
        if ($tem) {
        ?>
            <div class="mt-3">
                <div class="textoListaDeFilmes">
                    <div class="textoDaCategoria">
                        Filmes de Ação
                    </div>
                    <a href="sessaoCategoria.php?categoria=Ação" class="linkVerMais">
                        Ver mais
                    </a>
                </div>
                <hr class="linha">

                <div class="row">
                    <?php
                    $contador = 0;

                    foreach ($filmesAção as $filme) {
                        if ($contador >= 4) {
                            break;
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
                    }
                    ?>
                </div>
            </div>
        <?php } ?>

        <?php
        $filmesAventura = listarFilmesCategoria("Aventura");
        $tem = $filmesAventura != null ? true : false;
        if ($tem) {
        ?>
            <div class="listaDeFilmes">
                <div class="textoListaDeFilmes">
                    <div class="textoDaCategoria">
                        Filmes de Aventura
                    </div>
                    <a href="sessaoCategoria.php?categoria=Aventura" class="linkVerMais">
                        Ver mais
                    </a>
                </div>
                <hr class="linha">

                <div class="row">
                    <?php
                    $contador = 0;

                    foreach ($filmesAventura as $filme) {
                        if ($contador >= 4) {
                            break;
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
                    }
                    ?>
                </div>
            </div>
        <?php } ?>

        <?php
        $filmesRomance = listarFilmesCategoria("Romance");
        $tem = $filmesRomance != null ? true : false;
        if ($tem) {
        ?>
            <div class="listaDeFilmes">
                <div class="textoListaDeFilmes">
                    <div class="textoDaCategoria">
                        Filmes de Romance
                    </div>
                    <a href="sessaoCategoria.php?categoria=Romance" class="linkVerMais">
                        Ver mais
                    </a>
                </div>
                <hr class="linha">

                <div class="row">
                    <?php
                    $contador = 0;

                    foreach ($filmesRomance as $filme) {
                        if ($contador >= 4) {
                            break;
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
                    }
                    ?>
                </div>
            </div>
        <?php } ?>

        <?php
        $filmesFicçãoCientífica = listarFilmesCategoria("Ficção científica");
        $tem = $filmesFicçãoCientífica != null ? true : false;
        if ($tem) {
        ?>
            <div class="listaDeFilmes">
                <div class="textoListaDeFilmes">
                    <div class="textoDaCategoria">
                        Filmes de Ficção científica
                    </div>
                    <a href="sessaoCategoria.php?categoria=Ficção científica" class="linkVerMais">
                        Ver mais
                    </a>
                </div>
                <hr class="linha">

                <div class="row">
                    <?php
                    $contador = 0;

                    foreach ($filmesFicçãoCientífica as $filme) {
                        if ($contador >= 4) {
                            break;
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
                    }
                    ?>
                </div>
            </div>
        <?php } ?>

        <?php
        $filmesTerror = listarFilmesCategoria("Terror");
        $tem = $filmesTerror != null ? true : false;
        if ($tem) {
        ?>
            <div class="listaDeFilmes">
                <div class="textoListaDeFilmes">
                    <div class="textoDaCategoria">
                        Filmes de Terror
                    </div>
                    <a href="sessaoCategoria.php?categoria=Terror" class="linkVerMais">
                        Ver mais
                    </a>
                </div>
                <hr class="linha">

                <div class="row">
                    <?php
                    $contador = 0;

                    foreach ($filmesTerror as $filme) {
                        if ($contador >= 4) {
                            break;
                        }
                    ?>
                        <div class="col-md-3">
                            <div class="capaFilme">
                                <a href="paginaSessaoFilme.php?codFilme=<?= $filme['codFilme']; ?>>">
                                    <img class="imagemCapaFilme" src="<?= $filme['capa']; ?>" alt="">
                                </a>
                            </div>
                        </div>
                    <?php
                        $contador++;
                    }
                    ?>
                </div>
            </div>
        <?php } ?>

        <?php
        $todosOsFilmesRecentes = listarFilmesRecentes();
        $tem = $todosOsFilmesRecentes != null ? true : false;
        if ($tem) {
        ?>
            <div class="listaDeFilmes">
                <div class="textoListaDeFilmes">
                    <div class="textoDaCategoria">
                        Adicionados recentemente
                    </div>
                    <a href="paginaFilmesAdicionadosRecentemente.php" class="linkVerMais">
                        Ver mais
                    </a>
                </div>
                <hr class="linha">

                <div class="row">
                    <?php
                    $contador = 0;

                    foreach ($todosOsFilmesRecentes as $filme) {
                        if ($contador >= 4) {
                            break;
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
                    }
                    ?>
                </div>
            </div>
        <?php  } ?>

        <?php
        $todosOsFilmes = listarFilme();
        $tem = $todosOsFilmes != null ? true : false;
        if ($tem) {
        ?>
            <div class="listaDeFilmes">
                <div class="textoListaDeFilmes">
                    <div class="textoDaCategoria">
                        Todos os filmes
                    </div>
                    <a href="paginaTodosOsFilmes.php" class="linkVerMais">
                        Ver mais
                    </a>
                </div>
                <hr class="linha">

                <div class="row">
                    <?php
                    $contador = 0;

                    foreach ($todosOsFilmes as $filme) {
                        if ($contador >= 4) {
                            break;
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
                    }
                    ?>
                </div>
            </div>
        <?php  } ?>
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