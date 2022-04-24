<?php
    require "../conexao1.php";
    require "../Usuario.php";
    session_id();

    global $conexao;

    $id_usuario = $_SESSION['id_usuario'];
    $cor = $_POST['cor'];
    $palpite = $_POST['palpite'];
    $acerto = $_POST['acerto'];

    $insertDados = 'INSERT INTO jogoadivinha(cor, palpite, acerto, id_usuario) 
                    VALUES(:cor, :palpite,:acerto, :id_usuario)';
    $insertDados = $conexao->prepare($insertDados);
    $insertDados->bindValue(':cor', $cor);
    $insertDados->bindValue(':palpite', $palpite);
    $insertDados->bindValue(':acerto', $acerto);
    $insertDados->bindValue(':id_usuario', $id_usuario);
    $insertDados->execute();
?>