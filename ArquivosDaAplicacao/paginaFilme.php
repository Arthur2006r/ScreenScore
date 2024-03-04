<?php
include_once "crud/filmeCRUD.php";
include_once "crud/comentarioCRUD.php";
include_once "crud/vizualizacaoCRUD.php";
include_once "crud/curtidaCRUD.php";
include_once "crud/deslikeCRUD.php";
include_once "crud/avaliacaoCRUD.php";
include_once "crud/deslikesComentarioCRUD.php";
include_once "crud/curtidaComentarioCRUD.php";

$codFilme = 0;
$titulo = "";
$diretor = "";
$dataEstreia = "";
$sinopse = "";
$capa = "";
$banner = "";
$tema = "";

if (isset($_SESSION['codAvaliador'])) {
    $codAvaliador = $_SESSION['codAvaliador'];
    if (isset($_SESSION['codFilme'])) {
        $codFilme = $_SESSION['codFilme'];

        $registro = buscarFilmePorId($codFilme);

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
        echo "<script>window.location.replace('paginaInicial.php');</script>";
    }
} else {
    echo "<script>alert('Logue para acessar essa página!');</script>";
    echo "<script>window.location.replace('paginaLogin.php');</script>";
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
</head>

<body>
    <?php
    include_once "menuPaginaFilme.php";
    ?>

    <div id="banner">
        <div class="gradient-overlay"></div>
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
                <div id="caixaInteracao">
                    <a class="linkStatus" href="controleFilmeStatusVizualizacao.php" id="visto">
                        <span class="material-symbols-outlined <?php echo (verificarVisualizacao($codFilme, $codAvaliador) == 1) ? 'iconeVistoAtivado' : 'iconeDesativado'; ?> icon">
                            visibility
                        </span>
                        <p class="descricao">
                            Visto
                        </p>
                    </a>
                    <a class="linkStatus" id="like" href="controleFilmeStatusCurtida.php">
                        <span class="material-symbols-outlined <?php echo (verificarCurtida($codFilme, $codAvaliador) == 1) ? 'iconeCurtidaAtivado' : 'iconeDesativado'; ?> icon">
                            favorite
                        </span>
                        <p class="descricao">
                            Like
                        </p>
                    </a>
                    <a class="linkStatus" id="deslike" href="controleFilmeStatusDeslike.php">
                        <span class="material-symbols-outlined <?php echo (verificarDeslike($codFilme, $codAvaliador) == 1) ? 'iconeDeslikeAtivado' : 'iconeDesativado'; ?> icon">
                            thumb_down
                        </span>
                        <p class="descricao">
                            Deslike
                        </p>
                    </a>
                    <hr id="barraCaixaAvaliacao">
                    <div id="avaliar">
                        <p class="avalieTexto">
                            Avalie
                        </p>
                        <div class="avaliador">
                            <?php
                            $avaliacaoSelecionada = 0;
                            $existeAvaliacao = verificarAvaliacao($codFilme, $codAvaliador);
                            if ($existeAvaliacao == 1) {
                                $avaliacaoSelecionada = retornaAvaliacao($codFilme, $codAvaliador);
                            }
                            $avaliacaoParam = 6;

                            for ($i = 1; $i <= 5; $i++) {
                                $radioId = "star" . $i;
                                $avaliacaoParam -= 1;
                                $link = "controleFilmeStatusAvaliacao.php?avaliacao=" . $avaliacaoParam;
                                $starClass = ($existeAvaliacao == 1 && $avaliacaoParam <= $avaliacaoSelecionada) ? 'selected' : '';
                            ?>
                                <input type="radio" name="star" id="<?php echo $radioId; ?>">
                                <label class="<?php echo $starClass; ?>" for="<?php echo $radioId; ?>" onclick="window.location.href='<?php echo $link; ?>'"></label>
                            <?php
                            }
                            ?>
                        </div>
                    </div>
                </div>
                <div id="avaliacao">
                    <div id="statusAvaliacoes">
                        <div class="divAvaliacoes">
                            <div class="textoAvaliacoes">
                                Avaliações
                            </div>
                            <div class="quantidadeAvaliacoes">
                                <?= $avaliacoes ?>
                            </div>
                        </div>
                    </div>
                    <hr id="barraDivisoria">
                    <div id="mediaAvaliacao">
                        <div id="media">
                            <?= $avaliacao ?>
                        </div>
                        <div id="iconeMedia">
                            <span class="material-symbols-outlined estrelaMedia">
                                grade
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="divComentarios">
            <div class="textoComentarios">
                Comentarios populares
            </div>
            <a href="paginaComentarios.php" class="linkVerMais">
                Ver mais
            </a>
        </div>
        <hr class="barraDivComentDadoFilme">
        <div id="tabelaComentarios">
            <table>
                <tbody>
                    <?php
                    $comentarios = listarComentariosFilmeAvaliador($codFilme);
                    $contador = 0;

                    foreach ($comentarios as $comentario) {
                        if ($contador >= 4) {
                            break;
                        }

                        $avatar = $comentario['avatar'] == "" ? "imagens/fotoPerfilPadrao.png" : $comentario['avatar'];
                    ?>
                        <tr id="tabelaComentario">
                            <td>
                                <a href="sessaoComentarioAvaliador.php?codPerfilAvaliador=<?= $comentario['codAvaliador'] ?>">
                                    <img class="avatarPerfil" src="<?= $avatar ?>">
                                </a>
                            </td>
                            <td class="textoNome">
                                Comentado por <?= $comentario['username'] ?>
                            </td>
                            <td class="textoComentario">
                                <?= $comentario['comentario'] ?>
                            </td>
                        </tr>

                        <tr class="areaInteracaoComentario mt-4">
                            <td class="likesComent mr-5">
                                <div id="curtidas">
                                    <div id="iconeCurti">
                                        <a class="linkStatus" id="like" href="controleComentStatusCurtida.php?codComentario=<?= $comentario['codComentario'] ?>">
                                            <span class="material-symbols-outlined <?php echo (verificarCurtidaComentario($comentario['codComentario'], $codAvaliador) == 1) ? 'iconeCurtidaAtivado' : 'iconeDesativado'; ?>">
                                                favorite
                                            </span>
                                        </a>

                                    </div>
                                    <div id="dadosCurti">
                                        <?= calcularQuantidadeCurtidasComentario($comentario['codComentario']); ?>
                                    </div>
                                </div>
                            </td>
                            <td class="deslikesComent ml-5">
                                <div id="deslikes">
                                    <a class="linkStatus" id="like" href="controleComentStatusDeslike.php?codComentario=<?= $comentario['codComentario'] ?>">
                                        <span class="material-symbols-outlined <?php echo (verificarDeslikeComentario($comentario['codComentario'], $codAvaliador) == 1) ? 'iconeDeslikAtivado' : 'iconeDesativado'; ?>">
                                            thumb_down
                                        </span>
                                    </a>
                                    <div id="dadosDeslike">
                                        <?= calcularQuantidadeDeslikesComentario($comentario['codComentario']); ?>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="3">
                                <hr class="barraDivComentarios">
                            </td>
                        </tr>
                    <?php
                        $contador++;
                    }
                    ?>
                </tbody>
            </table>
        </div>
        <form id="formulario" action="comentarioSalvar.php" method="post" enctype="multipart/form-data">
            <div>
                <input type="hidden" id="codFilme" name="codFilme" value="<?php echo $codFilme ?>">
            </div>
            <div>
                <input type="hidden" id="codAvaliador" name="codAvaliador" value="<?php echo $codAvaliador ?>">
            </div>
            <div id="textArea" class="row">
                <div class="col-md-12">
                    <label for="comentario" class="textoLabelInput">Comente</label>
                    <textarea class="form-control input inputTextArea" id="comentario" name="comentario"></textarea>
                </div>
            </div>

            <div class="row mt-3">
                <div class="col-md-6">
                    <button type="reset" class="botaoCancelar float-left">Limpar</button>
                </div>
                <div class="col-md-6">
                    <button type="submit" class=" botaoSalvar botaoSalvarDesabilitado">Comentar</button>
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
    <script type="text/javascript" src="js/usuarioFormulario.js"></script>
    <script type="text/javascript" src="js/controleStatusFilme.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
</body>

<script>
    $(document).ready(function() {
        $("#comentario").on("input", function() {
            var comentario = $(this).val().trim();

            if (comentario !== "") {
                $(".botaoSalvar").prop("disabled", false).addClass("botaoSalvarAbilitado").removeClass("botaoSalvarDesabilitado");
            } else {
                $(".botaoSalvar").prop("disabled", true).addClass("botaoSalvarDesabilitado").removeClass("botaoSalvarAbilitado");
            }
        });
    });
</script>

</html>