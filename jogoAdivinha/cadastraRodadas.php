<?php
    require "../conexao1.php";
    require "../Usuario.php";
    session_id();

    global $conexao;

    $id_usuario = $_SESSION['id_usuario'];
    $cor = $_POST['cor'];
    $palpite = $_POST['palpite'];
    $pontos = strval($_POST['pontos']);


    switch ($palpite) {
        case "gray":
            $palpite = 'cinza';
            break;
        case "white":
            $palpite = 'branco';
            break;
        case "black":
            $palpite = 'preto';
            break;
        case "pink":
            $palpite = 'rosa';
            break;
        case "blue":
            $palpite = 'azul';
            break;
        case "yellow":
            $palpite = 'amarelo';
            break;
        case "red":
            $palpite = 'vermelho';
            break;
        case "green":
            $palpite = 'verde';
            break;
    }


    switch ($cor) {
        case "gray":
            $cor = 'cinza';
            break;
        case "white":
            $cor = 'branco';
            break;
        case "black":
            $cor = 'preto';
            break;
        case "pink":
            $cor = 'rosa';
            break;
        case "blue":
            $cor = 'azul';
            break;
        case "yellow":
            $cor = 'amarelo';
            break;
        case "red":
            $cor = 'vermelho';
            break;
        case "green":
            $cor = 'verde';
            break;
    }

    $insertDados = 'INSERT INTO jogoadivinha(cor, palpite, acerto, id_usuario) 
                    VALUES(:cor, :palpite, :acerto, :id_usuario)';
    $insertDados = $conexao->prepare($insertDados);
    $insertDados->bindValue(':cor', $cor);
    $insertDados->bindValue(':palpite', $palpite);
    $insertDados->bindValue(':acerto', $pontos);
    $insertDados->bindValue(':id_usuario', $id_usuario);
    $insertDados->execute();
?>