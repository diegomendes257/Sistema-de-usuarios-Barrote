<?php

    require "../conexao1.php";
    require "../Usuario.php";

    $pontos = $_POST['pontos'];
    $ganhou = 0.05;
    $id = $_SESSION['id_usuario'];

    if($_POST['pontos'] == 1){

        global $conexao;

        $id = $_SESSION['id_usuario'];
        $consulta = "SELECT id_usuario, saldo FROM usuario WHERE id_usuario = :id";
        $consulta = $conexao->prepare($consulta);
        $consulta->bindValue(":id", $id);
        $consulta->execute();
        $mostra = $consulta->fetch();

        $soma = $mostra['saldo'] + $ganhou;

        $insereValor = "UPDATE usuario set saldo = "."$soma"." WHERE id_usuario = :id";
        $insereValor = $conexao->prepare($insereValor);
        $insereValor->bindValue(":id",$id);
        $insereValor->execute();

        $mostraSaldo = "SELECT saldo FROM usuario WHERE id_usuario = :id";
        $mostraSaldo = $conexao->prepare($mostraSaldo);
        $mostraSaldo->bindValue(":id",$id);
        $mostraSaldo->execute();
        $mostraSaldoAtualizado = $mostraSaldo->fetch();
        
        echo $mostraSaldoAtualizado;

    }else if($_POST['pontos'] == 0){

        global $conexao;

        $id = $_SESSION['id_usuario'];
        
        $consulta = "SELECT id_usuario, saldo FROM usuario WHERE id_usuario = :id";
        $consulta = $conexao->prepare($consulta);
        $consulta->bindValue(":id", $id);
        $consulta->execute();
        $mostra = $consulta->fetch();

        $soma1 = $mostra['saldo'] - $ganhou;

        $insereValor = "UPDATE usuario set saldo = "."$soma1"." WHERE id_usuario = :id";
        $insereValor = $conexao->prepare($insereValor);
        $insereValor->bindValue(":id",$id);
        $insereValor->execute();

        $mostraSaldo = "SELECT saldo FROM usuario WHERE id_usuario = :id";
        $mostraSaldo = $conexao->prepare($mostraSaldo);
        $mostraSaldo->bindValue(":id",$id);
        $mostraSaldo->execute();
        $mostraSaldoAtualizado = $mostraSaldo->fetch();
    }
?>