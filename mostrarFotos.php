<?php 
    session_id();
    include("conexao1.php");

    global $conexao;
    
    $id = $_SESSION['id_usuario'];
    $consultaFoto = 'SELECT path from upload WHERE id_usuario = :id';
    $consultaFoto = $conexao->prepare($consultaFoto);
    $consultaFoto->bindValue(':id', $id);
    $consultaFoto->execute();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ver fotos</title>
</head>
<body>
    <?php 
        echo '<div class="display-3 text-center">Mural de fotos</div>';
        echo '<div class="container bg-white ">
                <a class="btn btn-success" href="formImagem.php">CLIQUE PARA VOLTAR</a>
              </div>';
        echo '<div class="text-center">Clique na foto para ampliar</div>';
    ?>
    <div class="container">
        <style>

            .container{
                display: flex;
                flex-wrap: wrap;
                justify-content: center;
                align-items: center;
                background-color: #225544;
                padding: 30px;
            }

            img {
                width: 200px;
                margin: 5px;
            }
        </style>
        <?php 
            while($exibeFoto = $consultaFoto->fetch()){
                echo '<div class="justify-start">';
                //echo '<div class="d-flex bg-success">';
                echo "<a target=\"_blank\" href=\"".$exibeFoto['path']."\"><img src='./".$exibeFoto['path']."'></a>";
                //echo '<br />';
                echo '</div>';
            }
        ?>
    </div><br />
</body>
</html>