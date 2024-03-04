<?php			
	include_once "crud/filmeCRUD.php";

    $validacao = $_GET['validacao'];
	$codFilme = $_POST['codFilme'];

    if($validacao == 1) {
        $titulo = $_POST['titulo'];
    
        $quantidade = verificarTitulo($titulo, $codFilme);
     
        if($quantidade == 0){
            echo "true";
        } else{
            echo "false";
        } 
    } else if($validacao == 2) {
        $capa = $_POST['imagemCapa'];
        $capaReserva = $_POST['capaReserva'];
    
        $quantidade = verificarCapa($capa, $capaReserva);

        echo $quantidade;
     
        if($quantidade == 0){
            echo "true";
        } else{
            echo "false";
        } 
    }
