<?php

    if(isset($_POST['nomeJogo']) && !empty($_POST['nomeJogo'])){

        require "../conexao1.php";
        require 'Jogos.php';

        $u = new Jogos();

        $nome =	filter_input(INPUT_POST, "nomeJogo", FILTER_DEFAULT);
        $valorJogo =	filter_input(INPUT_POST, "valorJogo", FILTER_VALIDATE_FLOAT);
        $premioJogo =	filter_input(INPUT_POST, "premioJogo", FILTER_DEFAULT);
        $dataInicio =	filter_input(INPUT_POST, "dataInicio", FILTER_DEFAULT);
        //$horaInicio =	filter_input(INPUT_POST, "horaInicio", FILTER_DEFAULT);
        $dataFim =	filter_input(INPUT_POST, "dataFim", FILTER_DEFAULT);
        $ativo =	filter_input(INPUT_POST, "ativo", FILTER_DEFAULT);
        $descricaoJogo =	filter_input(INPUT_POST, "descricaoJogo", FILTER_DEFAULT);
        $foto =	filter_input(INPUT_POST, "foto", FILTER_DEFAULT);

        if(isset($_FILES['foto'])){
            $foto = $_FILES['foto'];
            $nomeDaFoto = $foto['name'];
            $pasta = "img_Jogo/";
        
            $extensao = strtolower(pathinfo($nomeDaFoto,PATHINFO_EXTENSION));
        
            if($extensao != 'jpg' && $extensao != 'png' && $extensao != 'jpeg')
                die("tipo de arquivo invalido");
                $path =  $pasta . $nomeDaFoto;
            $aceito = move_uploaded_file($foto['tmp_name'], $path);
        }

        $u->criaJogo($nome, $valorJogo, $premioJogo, $dataInicio, $dataFim, $descricaoJogo, $path, $ativo);
    }

?>