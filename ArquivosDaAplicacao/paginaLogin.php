<html>

<head>
    <meta charset="utf-8" />
    <title> ScreenScore - Página de Login </title>
    <link type="text/css" rel="stylesheet" href="css/bootstrap.css" />
    <link type="text/css" rel="stylesheet" href="css/estilos.css" />
    <link type="text/css" rel="stylesheet" href="css/paginaCadastroLogincss.css" />
</head>

<body background="imagens/imagemDeFundo.jpg">
    <?php
    include_once "menuCadastroLogin.php";
    ?>
    <div class="container">
        <div id="layoutInicial">
            <div id="caixaDeOpcoes">
                <div id="divOpcao1">
                    <p class="text-center fraseDasOpcoes">Já tem uma conta? Então faça login</p>
                    <p class="textoLogin">Login</p>
                    <div class="inputsLogin">
                        <form id="formulario" class="mb-5" action="avaliadorLogar.php" method="post">
                            <div class="row form-group">
                                <div class="col-md-12 mt-2">
                                    <input class="form-control inputLogin" id="email" name="email" value="" type="text" placeholder="E-mail">
                                </div>
                            </div>
                            <div class="row form-group">
                                <div class="col-md-12 mt-2 mb-2">
                                    <input class="form-control inputLogin" id="senha" name="senha" value="" type="password" placeholder="Senha">
                                </div>
                            </div>
                            <button class="botaoLogar" type="submit">Logar</button>
                        </form>
                    </div>
                </div>
                <div id="divOpcao2">
                    <p class="fraseDasOpcoes">Não é cadastrado? <a class="linkLogin" href="paginaCadastro.php">Cadastre-se</a> já!</p>
                </div>
            </div>
            <div id="textinhoInformacional">

                Bem-vindos de volta! Acompanhe seus filmes assistidos, salve sua lista de desejos e compartilhe com seus amigos.
                <p class="textoPequeno"> O lugar perfeito para amantes do cinema.</p>
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
            email: {
                required: true,
                email: true
            },
            senha: {
                required: true
            },
        },
        messages: {
            email: {
                required: "Campo obrigatório",
                email: "Digite um email válido"
            },
            senha: {
                required: "Campo obrigatório"
            }
        }
    });
</script>

</html>