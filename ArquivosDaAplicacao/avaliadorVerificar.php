<?php			
	include_once "crud/avaliadorCRUD.php";

    $validacao = $_GET['validacao'];
	$codAvaliador = $_POST['codAvaliador'];

    if($validacao == 1) {
        $email = $_POST['email'];
    
        $quantidade = verificarEmail($email, $codAvaliador);
     
        if($quantidade == 0){
            echo "true";
        } else{
            echo "false";
        } 
    } else if($validacao == 2) {
        $username = $_POST['username'];
    
        $quantidade = verificarUsername($username, $codAvaliador);
     
        if($quantidade == 0){
            echo "true";
        } else{
            echo "false";
        } 
    }
