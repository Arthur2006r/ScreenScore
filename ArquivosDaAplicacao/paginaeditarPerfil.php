<?php
include_once "crud/avaliadorCRUD.php";

$avatarReserva = "";
$avatar = "imagens/fotoPerfilPadrao.png";
$username = "";
$email = "";
$biografia = "No bio yet";

if (isset($_SESSION['codAvaliador'])) {
    $avaliadores = buscarAvaliadorPorId($_SESSION['codAvaliador']);
    if (!empty($avaliadores)) {
        $avaliador = $avaliadores[0];

        $codAvaliador = $_SESSION['codAvaliador'];

        if ($avaliador['avatar'] != null || $avaliador['avatar'] != "") {
            $avatar = $avaliador['avatar'];
            $avatarReserva = $avaliador['avatar'];
        }

        if ($avaliador['biografia'] != null || $avaliador['biografia'] != "") {
            $biografia = $avaliador['biografia'];
        }

        $username = $avaliador['username'];
        $email = $avaliador['email'];
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
    <link type="text/css" rel="stylesheet" href="css/paginaeditarPerfil.css" />
    <link type="text/css" rel="stylesheet" href="css/menu.css" />
</head>

<body>
    <div class="container">
        <h1 class="titulo mt-5 mb-4">Edição do perfil</h1>
        <hr class="linha">
        <form id="formulario" action="avaliadorEditar.php" method="post" enctype="multipart/form-data">
            <div class="row form-group">
                <div>
                    <input type="hidden" id="codAvaliador" name="codAvaliador" value="<?= $codAvaliador ?>">
                </div>
                <div>
                    <input type="hidden" id="avatarReserva" name="avatarReserva" value="<?= $avatarReserva ?>">
                </div>
                <div class="col-12">
                    <br>
                    <label for="avatar" class="textoCapaBannerFilme">Avatar</label>
                    <br>
                    <div id="preview">
                        <input class="form-control" value="<? $avatar ?>" id="avatarInput" name="avatarInput" type="file" onchange="previewImagem()" style="display: none;">
                        <img src="<?= $avatar ?>" class="avatar" onclick="document.getElementById('avatarInput').click();" style="cursor: pointer;">
                    </div>
                    <br>
                    <br>
                </div>
            </div>

            <div id="formularios">
                <div id="inputs">
                    <div id="inputTitulo" class="row form-group">
                        <div class="col-md-12">
                            <div>
                                <input type="hidden" id="idFilme" name="idFilme" value="<?php echo $codAvaliador ?>">
                            </div>
                            <label for="username" class="textoLabelInput">Username</label>
                            <input class="form-control input" id="username" name="username" value="<?= $username ?>" type="text" placeholder="">
                        </div>
                    </div>
                    <div id="inputDiretor" class="row form-group mt-5">
                        <div class="col-md-12">
                            <label for="email" class="textoLabelInput">Email</label>
                            <input class="form-control input" id="email" name="email" value="<?= $email ?>" type="text" placeholder="">
                        </div>
                    </div>
                </div>

                <div id="textArea">
                    <div class="col-md-12">
                        <label for="biografia" class="textoLabelInput">Biografia</label>
                        <textarea class="form-control inputTextArea" id="biografia" name="biografia" value="" style="height: 21vh;"><?= $biografia ?></textarea>
                    </div>
                </div>
            </div>

            <div class="row form-group mt-5">
                <div class="col-md-12">
                    <a href="paginaMinhaConta.php" class="botaoCancelar">Cancelar</a>
                    <button type="submit" class="botaoSalvar float-right">Salvar alterações</button>
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
    <script type="text/javascript" src="js/cadastroOuLogin.js"></script>
    <script type="text/javascript" src="js/dadosFormularioEditar.js"></script>
</body>

<script>
    function previewImagem() {
        var foto = document.querySelector('input[name=avatarInput]').files[0];
        var preview = document.querySelector('img');

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