<?php
include_once "crud/filmeCRUD.php";

$codFilme = 0;
$titulo = "";
$diretor = "";
$dataEstreia = "";
$sinopse = "";
$capaReserva = "";
$bannerReserva = "";

$capa = "imagens/imagemPadraoCapa.png";
$banner = "imagens/imagemPadraoBanner.png";
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

        $capaReserva = $capa;
        $bannerReserva = $banner;
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
    <title> ScreenScore - Página cadastro de filme </title>
    <link type="text/css" rel="stylesheet" href="css/bootstrap.css" />
    <link type="text/css" rel="stylesheet" href="css/estilos.css" />
    <link type="text/css" rel="stylesheet" href="css/paginaCadastrarFilme.css" />
    <link type="text/css" rel="stylesheet" href="css/menu.css" />
</head>

<body>
    <div class="container">
        <h1 class="titulo mt-5 mb-4">Cadastro de filme</h1>
        <hr class="linha">
        <form id="formulario" action="filmeSalvar.php" method="post" enctype="multipart/form-data">
            <div class="row form-group">
                <div>
                    <input type="hidden" id="codFilme" name="codFilme" value="<?php echo $codFilme ?>">
                </div>
                <div>
                    <input type="hidden" id="capaReserva" name="capaReserva" value="<?php echo $capaReserva ?>">
                </div>
                <div>
                    <input type="hidden" id="bannerReserva" name="bannerReserva" value="<?php echo $bannerReserva ?>">
                </div>
                <div class="col-4">
                    <br>
                    <label for="imagemCapa" class="textoCapaBannerFilme">Capa do filme</label>
                    <br>
                    <div id="previewCapa">
                        <input class="form-control" value="<?php echo $capaReserva ?>" id="imagemCapa" name="imagemCapa" type="file" onchange="previewImagemCapa()" style="display: none;">
                        <img src="<?= $capa ?>" class="capaFilme" onclick="document.getElementById('imagemCapa').click();" style="cursor: pointer;">
                    </div>
                    <br>
                    <br>
                </div>
                <div class="col-8">
                    <br>
                    <label for="imagemBanner" class="textoCapaBannerFilme">Banner do filme</label>
                    <br>
                    <div id="previewBanner">
                        <input class="form-control" value="<?php echo $banner ?>" id="imagemBanner" name="imagemBanner" type="file" onchange="previewImagemBanner()" style="display: none;">
                        <img src="<?= $banner ?>" class="bannerFilme" onclick="document.getElementById('imagemBanner').click();" style="cursor: pointer;">
                    </div>
                </div>
            </div>

            <div id="formularios">
                <div id="inputs">
                    <div id="inputTitulo" class="row form-group">
                        <div class="col-md-12">
                            <div>
                                <input type="hidden" id="idFilme" name="idFilme" value="<?php echo $idFilme ?>">
                            </div>
                            <label for="titulo" class="textoLabelInput">Título do filme</label>
                            <input class="form-control input" id="titulo" name="titulo" value="<?= $titulo ?>" type="text" placeholder="Digite o título">
                            <div class="error-message-titulo"></div>
                        </div>

                    </div>
                    <div id="inputDiretor" class="row form-group mt-5">
                        <div class="col-md-12">
                            <label for="diretor" class="textoLabelInput">Diretor do filme</label>
                            <input class="form-control input" id="diretor" name="diretor" value="<?= $diretor ?>" type="text" placeholder="Informe o diretor do filme">
                            <div class="error-message-diretor"></div>
                        </div>
                    </div>
                    <div id="inputDataEstreia" class="row form-group mt-5">
                        <div class="col-md-12">
                            <label for="dataEstreia" class="textoLabelInput">Data da estreia</label>
                            <input class="form-control input" id="dataEstreia" name="dataEstreia" value="<?= $dataEstreia ?>" type="date">
                            <div class="error-message-dataEstreia"></div>
                        </div>
                    </div>

                    <div id="inputTema" class="row form-group mt-5">
                        <div class="col-md-12">
                            <label for="tema" class="textoLabelInput">Tema do filme</label>
                            <select class="form-control input" id="tema" name="tema">
                                <option value="<?= $tema ?>" <?= $tema != "" ? "selected" : ""; ?>>Escolha uma opção</option>
                                <option value="Aventura" <?= $tema == "Aventura" ? "selected" : ""; ?>>Aventura</option>
                                <option value="Romance" <?= $tema == "Romance" ? "selected" : ""; ?>>Romance</option>
                                <option value="Ação" <?= $tema == "Ação" ? "selected" : ""; ?>>Ação</option>
                                <option value="Terror" <?= $tema == "Terror" ? "selected" : ""; ?>>Terror</option>
                                <option value="Ficção científica" <?= $tema == "Ficção científica" ? "selected" : ""; ?>>Ficção Científica</option>
                            </select>
                            <div class="error-message-tema"></div>
                        </div>
                    </div>
                </div>

                <div id="textArea">
                    <div class="col-md-12">
                        <label for="sinopse" class="textoLabelInput">Sinopse</label>
                        <textarea class="form-control input inputTextArea" id="sinopse" name="sinopse" style="height: 38vh;" required><?= $sinopse ?></textarea>
                        <div class="error-message-sinopse"></div>
                    </div>
                </div>
            </div>

            <div class="row form-group mt-5">
                <div class="col-md-12">
                    <a href="paginaInicialAdiministrador.php" class="botaoCancelar">Cancelar</a>
                    <button type="submit" class="botaoSalvar float-right">Cadastrar filme</button>
                </div>
            </div>
        </form>
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
    <script type="text/javascript" src="js/dadosFormularioFilme.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
</body>

<script>
    function previewImagemCapa() {
        var foto = document.querySelector('input[name=imagemCapa]').files[0];
        var preview = document.querySelector('#previewCapa img');

        var reader = new FileReader();

        reader.onloadend = function() {
            preview.src = reader.result;
        }

        if (foto) {
            reader.readAsDataURL(foto);
        } else {
            preview.src = "";
        }
    }

    function previewImagemBanner() {
        var foto = document.querySelector('input[name=imagemBanner]').files[0];
        var preview = document.querySelector('#previewBanner img');

        var reader = new FileReader();

        reader.onloadend = function() {
            preview.src = reader.result;
        }

        if (foto) {
            reader.readAsDataURL(foto);
        } else {
            preview.src = "";
        }
    }
</script>

</html>