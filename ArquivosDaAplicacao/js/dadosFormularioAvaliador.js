
$("#formulario").validate(
    {
        rules: {
            email: {
                required: true,
                remote: {
                    url: "avaliadorVerificar.php?validacao=1",
                    type: "post",
                    data: {
                        codAvaliador: function () {
                            return $("#codAvaliador").val();
                        }
                    }
                },
                email: true
            },
            username: {
                required: true,
                remote: {
                    url: "avaliadorVerificar.php?validacao=2",
                    type: "post",
                    data: {
                        codAvaliador: function () {
                            return $("#codAvaliador").val();
                        }
                    }
                }
            },
            senha: {
                required: true
            },
        },
        messages: {
            email: {
                required: "Campo obrigatório",
                remote: "O email informado já foi cadastrado",
                email: "Digite um email válido"
            },
            username: {
                required: "Campo obrigatório",
                remote: "O username informado está indisponível"
            },
            senha: {
                required: "Campo obrigatório"
            }
        }
    }
);