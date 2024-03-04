<?php
    $conexao = NULL;
    
    function criarConexao(){
        $conexao = new PDO('mysql:host=localhost; dbname=bdAtividade03PWII', 'root', '');
        return $conexao;
    }

    function fecharConexao(){
        $conexao = NULL;
    }
?>    