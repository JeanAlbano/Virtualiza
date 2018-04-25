<?php

    function inserePrimeiraOcorrencia($string, $busca, $insere) {   //função para adicionar novo campo na query
        $index = strpos($string, $busca);
        if($index === false) {
            return $string;
        }
        return substr_replace($string, $insere, $index, 0);
    }
    
    function insereUltimaOcorrencia($string, $busca, $insere) { //função para adicionar novo valor na query
        $index = strrpos($string, $busca);
        if($index === false) {
            return $string;
        }
        return substr_replace($string, $insere, $index, 0);
    }

    //verifica se todos os parâmetros foram enviados 
    if(isset($_POST['nome']) && isset($_POST['email']) && isset($_POST['mensagem'])){ 

        include "conexao.php";

        $nome = addslashes($_POST['nome']); //addslashes para evitar sql inject
        $email = addslashes($_POST['email']);
        $mensagem = addslashes($_POST['mensagem']);

        $query = "INSERT INTO contato (nomecontato, emailcontato, mensagemcontato) 
                VALUES('$nome', '$email', '$mensagem')"; //cadastro sem nenhum campo opcional

        //verificação de campo opicional
        if(!empty($_POST['telefone'])){
            $telefone = addslashes($_POST['telefone']);
            $query = inserePrimeiraOcorrencia($query, ")", ", telefonecontato");
            $query = insereUltimaOcorrencia($query, ")", ", '$telefone'");  //adicionando na query o campo telefone
        }

        echo mysqli_query($con, $query); //inserindo no banco
    }else{  //nem todos os parâmetros obrigatorios foram enviados
        echo 0;
    }

?>