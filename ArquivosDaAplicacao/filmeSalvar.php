<?php
include_once "crud/filmeCRUD.php";

$titulo = $_POST['titulo'];
$diretor = $_POST['diretor'];
$sinopse = $_POST['sinopse'];
$dataEstreia = $_POST['dataEstreia'];
$tema = $_POST['tema'];
$codFilme = $_POST['codFilme'];

$capaReserva = $_POST['capaReserva'];
$capa = $_FILES["imagemCapa"];
$tamanhoArquivoCapa = $capa['size'];
$nomeArquivoCapa = $capa['name'];
$extensaoArquivoCapa = pathinfo($nomeArquivoCapa, PATHINFO_EXTENSION);
$tempArquivoCapa = $capa['tmp_name'];
$caminhoArquivoCapa = "";

$bannerReserva = $_POST['bannerReserva'];
$banner = $_FILES["imagemBanner"];
$tamanhoArquivoBanner = $banner['size'];
$nomeArquivoBanner = $banner['name'];
$extensaoArquivoBanner = pathinfo($nomeArquivoBanner, PATHINFO_EXTENSION);
$tempArquivoBanner = $banner['tmp_name'];
$caminhoArquivoBanner = "";

if ($capa['error'] == UPLOAD_ERR_NO_FILE) {
	$caminhoArquivoCapa = $capaReserva;
}

if ($banner['error'] == UPLOAD_ERR_NO_FILE) {
	$caminhoArquivoBanner = $bannerReserva;
}

if (((($extensaoArquivoBanner == "png" || $extensaoArquivoBanner == "jpeg" || $extensaoArquivoBanner == "jpg")) || ($caminhoArquivoBanner != "")) && ((($extensaoArquivoCapa == "png" || $extensaoArquivoCapa == "jpeg" || $extensaoArquivoCapa == "jpg")) || ($caminhoArquivoCapa != ""))) {
	if ($caminhoArquivoCapa == "") {
		$nomeUnicoCapa = gerarNomeImagemCapaBanner($extensaoArquivoCapa);
		$caminhoArquivoCapa = "imagens/" . $nomeUnicoCapa;
		move_uploaded_file($tempArquivoCapa, $caminhoArquivoCapa);
	}

	if ($caminhoArquivoBanner == "") {
		$nomeUnicoBanner = gerarNomeImagemCapaBanner($extensaoArquivoBanner);
		$caminhoArquivoBanner = "imagens/" . $nomeUnicoBanner;
		move_uploaded_file($tempArquivoBanner, $caminhoArquivoBanner);
	}

	$quantidade = salvarFilme($codFilme, $titulo, $diretor, $dataEstreia, $sinopse, $caminhoArquivoCapa, $caminhoArquivoBanner, $tema);
	if ($quantidade > 0) {
		echo  "<script>alert('Cadastro realizado com sucesso!');</script>";
		echo  "<script>window.location.replace('paginaInicialAdiministrador.php');</script>";
	} else {
		echo  "<script>alert('Erro ao cadastro e registro');</script>";
		if ($codFilme > 0) {
			echo  "<script>window.location.replace('paginaEditarFilme.php');</script>";
		} else {
			echo  "<script>window.location.replace('paginaCadastrarFilme.php');</script>";
		}
	}
} else {
	echo  "Formato ou tamanho de arquivo inválido!";
}
