<html>

<head>
    <meta charset="utf-8" />
    <title> ScreenScore - Página do Administrador </title>
    <link type="text/css" rel="stylesheet" href="css/bootstrap.css" />
    <link type="text/css" rel="stylesheet" href="css/estilos.css" />
    <link type="text/css" rel="stylesheet" href="css/paginaCadastroLogincss.css" />
</head>

<body background="imagens/imagemDeFundo.jpg">
    <?php
    include_once "menuAdministrador.php";
    ?>
    <div class="container">
        <div id="layoutInicial">
            <div id="caixaDeOpcoes">
                <div id="divOpcao1">
                    <p class="text-center fraseDasOpcoes">Área para login do Administrador</p>
                    <p class="textoLogin">Login do Administrador</p>
                    <div class="inputsLogin">
                        <form id="formulario" class="mb-5" action="adiministradorLogar.php" method="post">
                            <div class="row form-group">
                                <div class="col-md-12 mt-2">
                                    <input class="form-control inputAdministrador" id="codigo" name="codigo" value="" type="password" placeholder="Código do Administrador">
                                </div>
                            </div>
                            <div class="row form-group">
                                <div class="col-md-12 mt-2 mb-2">
                                    <input class="form-control inputAdministrador" id="senha" name="senha" value="" type="text" placeholder="Senha">
                                </div>
                            </div>
                            <button class="botaoAdministrador" type="submit">Logar</button>
                        </form>
                    </div>
                </div>
            </div>
            <div id="textinhoInformacional">
                Área restrita para Administradores. O login de Administrador permite que ele poste, edite e exclue filmes no catálogo do ScreenScore. Seja bem-vindo!
            </div>
        </div>
    </div>
    <script type="text/javascript" src="js/jquery.js"></script>
    <script type="text/javascript" src="js/bootstrap.js"></script>
    <script type="text/javascript" src="js/jquery.validate.js"></script>
    <script type="text/javascript" src="js/jquery.mask.js"></script>
    <script type="text/javascript" src="js/cadastroOuLogin.js"></script>
</body>

<script>
    $("#formulario").validate({
        rules: {
            codigo: {
                required: true,
            },
            senha: {
                required: true
            },
        },
        messages: {
            codigo: {
                required: "Campo obrigatório",
            },
            senha: {
                required: "Campo obrigatório"
            }
        }
    });

    $(document).ready(function() {
        $('#senha').mask('AAAAA-999999');
    });
</script>

</html>