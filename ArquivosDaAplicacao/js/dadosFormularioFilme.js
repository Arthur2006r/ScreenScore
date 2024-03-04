$("#formulario").validate({
    rules: {
        titulo: {
            required: true,
            remote: {
                url: "filmeVerificar.php?validacao=1",
                type: "post",
                data: {
                    codFilme: function () {
                        return $("#codFilme").val();
                    }
                }
            }
        },
        diretor: {
            required: true
        },
        tema: {
            required: true
        },
        sinopse: {
            required: function() {
                // Verifica se o campo "sinopse" está vazio
                return $.trim($("#sinopse").val()) === "";
            }
        },
        dataEstreia: {
            required: true
        },
        imagemCapa: {
            required: true,
        },
        imagemBanner: {
            required: true,
        },
        banner: {
            required: true
        },
    },
    messages: {
        titulo: {
            required: "Campo obrigatório",
            remote: "Título indisponível"
        },
        diretor: {
            required: "Campo obrigatório"
        },
        tema: {
            required: "Campo obrigatório"
        },
        sinopse: {
            required: "Campo obrigatório"
        },
        dataEstreia: {
            required: "Campo obrigatório"
        },
        imagemCapa: {
            required: "Campo obrigatório",
        },
        imagemBanner: {
            required: "Campo obrigatório",
        },
        banner: {
            required: "Campo obrigatório"
        }
    },
    errorPlacement: function (error, element) {
        if (element.attr("name") === "sinopse") {
            error.insertAfter(element); // Insere a mensagem de erro após o campo "sinopse"
        } else {
            error.appendTo(element.closest(".form-group").find(".error-message-" + element.attr("name")));
        }
    },
});
