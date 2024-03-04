<?php			
	include_once "crud/FilmeCRUD.php";

	$codFilme = $_POST['codFilme'];

	$quantidade = excluirFilme($codFilme);	

	echo $quantidade;
?>	


	