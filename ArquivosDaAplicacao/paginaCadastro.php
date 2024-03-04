<?php
$codAvaliador = 0;
?>

<html>

<head>
    <meta charset="utf-8" />
    <title> ScreenScore - Página de Cadastro </title>
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
                    <p class="text-center fraseDasOpcoes">Ainda não tem uma conta? Cadastre-se aqui!</p>
                    <p class="textoLogin">Cadastro</p>
                    <div class="inputsLogin">
                        <form id="formulario" class="mb-5" action="avaliadorSalvar.php" method="post">
                            <div>
                                <input type="hidden" id="codAvaliador" name="codAvaliador" value="<?php echo $codAvaliador ?>">
                            </div>
                            <div class="row form-group">
                                <div class="col-md-12 mt-2">
                                    <input class="form-control inputCadastro" id="email" name="email" value="" type="text" placeholder="E-mail">
                                </div>
                            </div>
                            <div class="row form-group">
                                <div class="col-md-6 mt-2">
                                    <input class="form-control inputCadastro" id="username" name="username" value="" type="text" placeholder="Username">
                                </div>
                                <div class="col-md-6 mt-2 mb-2">
                                    <input class="form-control inputCadastro" id="senha" name="senha" value="" type="password" placeholder="Senha">
                                </div>
                            </div>
                            <button type="submit" class="botaoCadastrar">Cadastrar</button>
                        </form>
                    </div>
                </div>
                <div id="divOpcao2">
                    <p class="fraseDasOpcoes">Já tem uma conta na ScreenScore? <a class="linkCadastro" href="paginaLogin.php">Faça login</a></p>
                </div>
            </div>
            <div id="textinhoInformacional">
                <div class="caixa">
                    Seja bem-vindo! Cadastre-se agora e comece a acompanhar seus filmes assistidos, salve suas futuras escolhas e compartilhe suas recomendações com amigos apaixonados por cinema.
                <p class="textoPequeno">Junte-se à nossa rede social exclusiva para os verdadeiros amantes do cinema.</p>
                </div>
                
            </div>
        </div>
    </div>
    <script type="text/javascript" src="js/jquery.js"></script>
    <script type="text/javascript" src="js/bootstrap.js"></script>
    <script type="text/javascript" src="js/jquery.mask.js"></script>
    <script type="text/javascript" src="js/jquery.validate.js"></script>
    <script type="text/javascript" src="js/additional-methods.js"></script>
    <script type="text/javascript" src="js/localization/messages_pt_BR.js"></script>
    <script type="text/javascript" src="js/cadastroOuLogin.js"></script>
    <script type="text/javascript" src="js/dadosFormularioAvaliador.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

</body>

</html>