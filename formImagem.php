<?php 
include "conexao1.php";
global $conexao;

//================================= UPLOAD SIMPLES DE IMAGEM ========= /

var_dump($_FILES);


if(isset($_FILES['foto'])){
    $foto = $_FILES['foto'];

    if($foto['error'])
        echo "error ao enviar";

    $pasta = "img/";
    $nomeDaFoto = $foto['name'];

    $extensao = strtolower(pathinfo($nomeDaFoto,PATHINFO_EXTENSION));

    if($extensao !='jpg' && $extensao != 'png')
        die("tipo de arquivo invalido");

        $path =  $pasta . $nomeDaFoto;
    $aceito = move_uploaded_file($foto['tmp_name'], $path);
    if($aceito)
        $insereImagem = "INSERT INTO upload(path) VALUE(:path)";
        $insereImagem = $conexao->prepare($insereImagem);
        $insereImagem->bindValue(":path", $path);
        $insereImagem->execute();
        echo "<p>Arquivo Sucesso, para acessar: <a target=\"_blank\" href=\"img/$nomeDaFoto\">Clique Aqui</a>";
    }else{
        echo "erro ao enviar!";
    }

?>

<!DOCTYPE html>
<html>
	<head>
		<title>Cadastrar img</title>
	</head>
	<body>
		<h2>
			Cadastre sua imagem
		</h2>
		<form method="POST" action="" enctype="multipart/form-data" name="cadastroImg">
            <input type="file" name="foto" /><br />
            <input type="submit" name="cadastrarImagem" value="CadastrarImg" />
			<br>
		</form>
        <br />

        <?php
            $id = 2;
            $selecionaImagem = "SELECT * FROM upload where id = :id";
            $selecionaImagem = $conexao->prepare($selecionaImagem);
            $selecionaImagem->bindValue(":id", $id);
            $selecionaImagem->execute();
            $mostraImagem1 = $selecionaImagem->fetch();

            while($mostraImagem1 = $selecionaImagem->fetch()){
                echo '<br />';
                echo $mostraImagem1['path'];
                echo '<br />';
                echo $mostraImagem1['data'];
                echo '<hr />';
                echo '<img src="<?php echo'.$mostraImagem1["path"].';?>" alt="">';
            }
        ?>

            
        <div><img src="<?php echo $mostraImagem1["path"];?>" alt=""></div>
        <a href="view.php">|Ver fotos|</a><br /><br />
        <a href="inicio.php">VOLTAR</a>
	</body>
</html>