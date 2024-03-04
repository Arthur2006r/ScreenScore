<?php
include_once "crud/avaliadorCRUD.php";

$codAvaliador = 0;
$username = "";
$avatar = "imagens/fotoPerfilPadrao.png";
$biografia = "No bio yet";
$vistos = 0;
$curtidos = 0;
$avaliacoes = 0;

if (isset($_SESSION['codAvaliador'])) {
    $codAvaliador = $_SESSION['codAvaliador'];

    if (isset($_SESSION['codPerfilAvaliador'])) {
        $codPerfilAvaliador = $_SESSION['codPerfilAvaliador'];
        $avaliadores = buscarAvaliadorPorId($codPerfilAvaliador);
        if (!empty($avaliadores)) {
            $avaliador = $avaliadores[0];
            $vistos = calcularQuantidadeVistos($codPerfilAvaliador);
            $curtidos = calcularQuantidadeCurtidos($codPerfilAvaliador);
            $avaliacoes = calcularQuantidadeAvaliacoes($codPerfilAvaliador);

            if ($avaliador['avatar'] != null || $avaliador['avatar'] != "") {
                $avatar = $avaliador['avatar'];
            }

            if ($avaliador['biografia'] != null || $avaliador['biografia'] != "") {
                $biografia = $avaliador['biografia'];
            }

            $username = $avaliador['username'];
        }
    } else {
        echo "<script>alert('Nenhum perfil selecionado!');</script>";
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
    <title> ScreenScore - Perfil </title>
    <link type="text/css" rel="stylesheet" href="css/bootstrap.css" />
    <link type="text/css" rel="stylesheet" href="css/estilos.css" />
    <link type="text/css" rel="stylesheet" href="css/paginaMinhaConta.css" />
    <link type="text/css" rel="stylesheet" href="css/menu.css" />
</head>

<body>
    <?php
    include_once "menu.php";
    ?>

    <div class="container">
        <div id="textoPerfil" class="mt-5">Perfil</div>
        <div id="dadosPerfil">
            <div id="avatarStatus">
                <div id="avatarUsername">
                    <div id="avatar">
                        <img class="avatarFoto" src="<?= $avatar ?>">
                    </div>
                    <div id="username">
                        <p><?= $username ?></p>
                    </div>
                </div>

                <div id="statusConta">
                    <a href="paginaFilmesVistos.php" id="filmesVistos" class="status linkStatus">
                        <div class="numero">
                            <?= $vistos ?>
                        </div>
                        <div class="textoStatus linkStatus">
                            Vistos
                        </div>
                    </a>
                    <p class="barra">|</p>
                    <a href="paginaFilmesCurtidos.php" id="filmesCurtidos" class="status linkStatus">
                        <div class="numero">
                            <?= $curtidos ?>
                        </div>
                        <div class="textoStatus linkStatus">
                            Curtidos
                        </div>
                    </a>
                    <p class="barra">|</p>
                    <div id="curtidas" class="status">
                        <div class="numero">
                            <?= $avaliacoes ?>
                        </div>
                        <div class="textoStatus">
                            Avaliações
                        </div>
                    </div>
                </div>
            </div>

            <div id="biografiaBotaoEditar" class="mt-5">
                <div id="biografia">
                    <label for="biografia">Biografia</label>
                    <p class="bio"><?= $biografia ?></p>
                </div>
            </div>
        </div>
    </div>

    <br>
    <br>
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
</body>


</html>