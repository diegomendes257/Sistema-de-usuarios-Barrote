<?php

    include("../conexao1.php");

    global $conexao;

    if(isset($_POST['tem'])){

        $id = $_SESSION['id_usuario'];
        $consulta1 = "SELECT saldo FROM usuario WHERE id_usuario = :id";
        $consulta1 = $conexao->prepare($consulta1);
        $consulta1->bindValue(":id", $id);
        $consulta1->execute();
        $valor1 = $consulta1->fetch();
        
        echo '  '.number_format($valor1['saldo'] , 2, ',',' . ');

    }
?>