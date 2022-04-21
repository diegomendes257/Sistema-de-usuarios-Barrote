<?php

    require "../conexao1.php";
    require "../Usuario.php";

    $insertDados = 'INSERT INTO jogoadivinha(cor, palpite, acerto, id) VALUES(":cor", ":palpite", :acerto, :id);';
    $insertDados = $conexao->repare($insertDados);
    $insertDados->bindValue(':cor', $cor);
    $insertDados->bindValue(':palpite', $palpite);
    $insertDados->bindValue(':acerto', $acerto);
    $insertDados->bindValue(':id', $id);