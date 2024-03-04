<?php
include_once "crud/avaliadorCRUD.php";

$avatar = "imagens/fotoPerfilPadrao.png";
$biografia = "No bio yet";
$vistos = 0;
$curtidos = 0;
$avaliacoes = 0;

if (isset($_SESSION['codAvaliador'])) {
    if (isset($_SESSION['codFilme'])) {
        unset($_SESSION['codFilme']);
    }
    
    if (isset($_SESSION['categoria'])) {
        unset($_SESSION['categoria']);
    }
    
    $avaliadores = buscarAvaliadorPorId($_SESSION['codAvaliador']);
    if (!empty($avaliadores)) {
        $avaliador = $avaliadores[0];

        $codAvaliador = $_SESSION['codAvaliador'];

        $vistos = calcularQuantidadeVistos($codAvaliador);
        $curtidos = calcularQuantidadeCurtidos($codAvaliador);
        $avaliacoes = calcularQuantidadeAvaliacoes($codAvaliador);

        if ($avaliador['avatar'] != null || $avaliador['avatar'] != "") {
            $avatar = $avaliador['avatar'];
        }

        if ($avaliador['biografia'] != null || $avaliador['biografia'] != "") {
            $biografia = $avaliador['biografia'];
        }
    }
} else {
    echo "<script>alert('Logue para acessar essa página!');</script>";
    echo "<script>window.location.replace('paginaLogin.php');</script>";
}
?>


<html>

<head>
    <meta charset="utf-8" />
    <title> ScreenScore - Minha conta </title>
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
        <div id="textoPerfil" class="mt-5">Meu perfil</div>
        <div id="dadosPerfil">
            <div id="avatarStatus">
                <div id="avatarUsername">
                    <div id="avatar">
                        <img class="avatarFoto" src="<?= $avatar ?>">
                    </div>
                    <div id="username">
                        <p><?= $avaliador['username']; ?></p>
                    </div>
                </div>

                <div id="statusConta">
                    <div id="filmesVistos" class="status ">
                        <div class="numero">
                            <?= $vistos ?>
                        </div>
                        <div class="textoStatus">
                            Vistos
                        </div>
                    </div>
                    <p class="barra">|</p>
                    <div  id="filmesCurtidos" class="status ">
                        <div class="numero">
                            <?= $curtidos ?>
                        </div>
                        <div class="textoStatus">
                            Curtidos
                        </div>
                    </div>
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
                <div id="EditarPerfil">
                    <a href="paginaeditarPerfil.php" class="botaoEditarPerfil">Editar perfil</a>
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