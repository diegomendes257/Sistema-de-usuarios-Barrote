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
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ver fotos</title>
</head>
<body>
    <div class="container">
        <style>
            img {
                width: 200px;
            }
        </style>
        <?php 
            while($exibeFoto = $consultaFoto->fetch()){
                echo "<img src='./".$exibeFoto['path']."'>";
                echo '<br />';
            }
        ?>
    </div><br />
    <a href="javascript:void(0)" onClick="history.go(-1); return false;">CLIQUE PARA VOLTAR</a>
</body>
</html>