<?php
include_once "crud/avaliadorCRUD.php";

$codAvaliador = $_POST['codAvaliador'];
$biografia = $_POST['biografia'];
$email = $_POST['email'];
$username = $_POST['username'];

$avatarReserva = $_POST['avatarReserva'];
$avatar = $_FILES['avatarInput'];

if ($avatar['error'] == UPLOAD_ERR_NO_FILE) {
    $caminhoArquivo = $avatarReserva;

    $quantidade = EditarAvaliador($codAvaliador, $username, $email, $biografia, $caminhoArquivo);
    if ($quantidade > 0) {
        echo  "<script>alert('A edição foi efetuata com sucesso!');</script>";
        echo  "<script>window.location.replace('paginaMinhaConta.php');</script>";
    } else {
        echo  "<script>alert('Erro ao editar seus dados! Tente novamente mais tarde.');</script>";
        echo  "<script>window.location.replace('paginaeditarPerfil.php');</script>";
    }
} else {
    $tamanhoArquivo = $avatar['size'];
    $nomeArquivo = $avatar['name'];
    $extensaoArquivo = pathinfo($nomeArquivo, PATHINFO_EXTENSION);
    $tempArquivo = $avatar['tmp_name'];

    if (($extensaoArquivo == "png" || $extensaoArquivo == "jpeg" || $extensaoArquivo == "jpg")) {
        $nomeUnico = gerarNomeImagem($extensaoArquivo);
        $caminhoArquivo = "imagens/" . $nomeUnico;

        move_uploaded_file($tempArquivo, $caminhoArquivo);

        $quantidade = EditarAvaliador($codAvaliador, $username, $email, $biografia, $caminhoArquivo);
        if ($quantidade > 0) {
            echo  "<script>alert('A edição foi efetuata com sucesso!');</script>";
            echo  "<script>window.location.replace('paginaMinhaConta.php');</script>";
        } else {
            echo  "<script>alert('Erro ao editar seus dados! Tente novamente mais tarde.');</script>";
            echo  "<script>window.location.replace('paginaeditarPerfil.php');</script>";
        }
    } else {
        echo  "<script>alert('Formato ou tamanho de arquivo inválido! Tente novamente.');</script>";
        echo  "<script>window.location.replace('paginaeditarPerfil.php');</script>";
    }
}
