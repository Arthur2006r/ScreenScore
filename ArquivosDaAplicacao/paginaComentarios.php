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

if (isset($_SESSION['codAvaliador'])) {
    $codAvaliador = $_SESSION['codAvaliador'];
    if (isset($_SESSION['codFilme'])) {

        $registro = buscarFilmePorId($_SESSION['codFilme']);

        $codFilme = $registro['codFilme'];
        $titulo = $registro['titulo'];
        $diretor = $registro['diretor'];
        $dataEstreia = $registro['dataEstreia'];
        $sinopse = $registro['sinopse'];
        $capa = $registro['capa'];
        $banner = $registro['banner'];

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
    <link type="text/css" rel="stylesheet" href="css/datatables.css" />
    <link type="text/css" rel="stylesheet" href="css/estilos.css" />
    <link type="text/css" rel="stylesheet" href="css/paginaComentarios.css" />
    <link type="text/css" rel="stylesheet" href="css/menu.css" />
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@48,400,1,200" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@48,400,0,0" />
</head>

<body>
    <?php
    include_once "menu.php";
    ?>

    <div class="container mt-5">
        <div class="divComentarios">
            <div class="textoComentarios">
                Comentarios sobre <p style="display: inline;" class="titulo"><?= $titulo ?></p>
            </div>
        </div>
        <hr class="barraDivComentDadoFilme mb-5">

        <div id="comentariosCapa">
            <div id="comentarios">
                <table id="tabela" class="table">
                    <thead class="thead">
                        <tr>
                            <th>Avatar</th>
                            <th>Usuário</th>
                            <th class="mudarOrdenacao">Comentários</th>
                            <th></th>
                            <th>⊲⊳</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $comentariosAvaliador = listarComentariosFilmeAvaliador($codFilme);

                        foreach ($comentariosAvaliador as $comentarioAvaliador) {
                            $avatar = $comentarioAvaliador['avatar'] == "" ? "imagens/fotoPerfilPadrao.png" : $comentarioAvaliador['avatar'];
                        ?>
                            <tr>
                                <td>
                                    <a href="sessaoComentarioAvaliador.php?codPerfilAvaliador=<?= $comentarioAvaliador['codAvaliador'] ?>">
                                        <img class="avatarPerfil" src="<?= $avatar ?>">
                                    </a>
                                </td>
                                <td class="textoNome">Comentado por <p style="display: inline;" class="nomeComent"><?= $comentarioAvaliador['username'] ?></p>
                                </td>
                                <td class="textoComentario"><?= $comentarioAvaliador['comentario'] ?></td>
                                <td class="likesComent mr-5">
                                    <div id="curtidas">
                                        <div id="iconeCurti">
                                            <a class="linkStatus" id="like" href="controleComentStatusCurtida.php?codComentario=<?= $comentarioAvaliador['codComentario'] ?>">
                                                <span class="material-symbols-outlined <?php echo (verificarCurtidaComentario($comentarioAvaliador['codComentario'], $codAvaliador) == 1) ? 'iconeCurtidaAtivado' : 'iconeDesativado'; ?>">
                                                    favorite
                                                </span>
                                            </a>

                                        </div>
                                        <div id="dadosCurti">
                                            <?= calcularQuantidadeCurtidasComentario($comentarioAvaliador['codComentario']); ?>
                                        </div>
                                    </div>
                                </td>
                                <td class="deslikesComent ml-5">
                                    <div id="deslikes">
                                        <a class="linkStatus" id="like" href="controleComentStatusDeslike.php?codComentario=<?= $comentarioAvaliador['codComentario'] ?>">
                                            <span class="material-symbols-outlined <?php echo (verificarDeslikeComentario($comentarioAvaliador['codComentario'], $codAvaliador) == 1) ? 'iconeDeslikAtivado' : 'iconeDesativado'; ?>">
                                                thumb_down
                                            </span>
                                        </a>
                                        <div id="dadosDeslike">
                                            <?= calcularQuantidadeDeslikesComentario($comentarioAvaliador['codComentario']); ?>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        <?php
                        }
                        ?>
                    </tbody>
                </table>
            </div>

            <div id="capaStatus">
                <div id="capa">
                    <a href="paginaFilme.php">
                        <img class="imagemCapaFilme capa" src="<?= $capa ?>" alt="">
                    </a>
                </div>
            </div>
        </div>
        <hr class="barraDivComentDadoFilme mt-5">
        <form id="formulario" action="comentarioSalvarPagina2.php" method="post" enctype="multipart/form-data">
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

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script type="text/javascript" src="js/jquery.mask.js"></script>
    <script type="text/javascript" src="js/jquery.validate.js"></script>
    <script type="text/javascript" src="js/additional-methods.js"></script>
    <script type="text/javascript" src="js/localization/messages_pt_BR.js"></script>
    <script type="text/javascript" src="js/bootstrap.js"></script>
    <script type="text/javascript" src="js/datatables.js"></script>
    <script type="text/javascript" src="js/tabelaComentarios.js"></script>
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