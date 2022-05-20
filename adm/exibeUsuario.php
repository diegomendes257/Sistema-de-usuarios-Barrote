<?php

    include '../conexao1.php';
    include '../Usuario.php';

    session_id();

    global $conexao;

    $id = $_SESSION['id_usuario'];

    $exibeUsuario = 'SELECT usuario.nome, usuario.id_usuario, fotosperfil.path_perfil
                    from usuario 
                    INNER JOIN fotosperfil 
                    on usuario.id_usuario = fotosperfil.id_usuario ';
    $exibeUsuario = $conexao->prepare($exibeUsuario);
    //$exibeUsuario->bindValue(':usuarioId', $id);
    $exibeUsuario->execute();

?>

<!DOCTYPE html>
<html>
	<head>
		<title>BARROTÉ - Decora Cor - JOGO</title>
		<link rel="stylesheet" type="text/css" href="estiloAdivinha.css"/>
		<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
		<script type="text/javascript" src="adivinhaCor.js"></script>
	</head>
	<body>
        <p class='display-4 text-center'>PARTICIPANTES</p>
    <div style='display:flex; justify-content:center;' >
    <?php
        while($exibeTodos = $exibeUsuario->fetch()){
            $imgString = "<img class='fotoPerfil' src='../img/perfil_icon.png'>";
            $imgString;
            echo '<div style="margin: 0px 15px; padding:5px; text-align:center; background-color:#fff9e7;">';
            echo '<p>'.''.$exibeTodos['id_usuario'].' - '.$exibeTodos['nome'].'</p>';
            if($exibeTodos['path_perfil'] == ""){
                echo "<a target=\"_blank\" href=\"".$imgString."\"><img style='width:100px'  src='../".$imgString."'></a>";
                echo '</div>';
            }else{
                echo "<a target=\"_blank\" href=\"../".$exibeTodos['path_perfil']."\"><img style='width:100px'  src='../".$exibeTodos['path_perfil']."'></a>";
                echo '</div>';
            }
        }
    ?>
    </div>
        <div class='container-fluid'><a href="painelADM.php">Clique para voltar!</a></div>
    </body>
</html>