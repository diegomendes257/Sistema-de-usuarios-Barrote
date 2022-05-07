<?php 
include "conexao1.php";
global $conexao;
session_id();

//================================= UPLOAD SIMPLES DE IMAGEM ========= /

var_dump($_FILES);
$id_usuario = $_SESSION['id_usuario'];


if(isset($_FILES['foto'])){
    $foto = $_FILES['foto'];

    $nomeDaFoto = $foto['name'];
    $pasta = "img/";

    $extensao = strtolower(pathinfo($nomeDaFoto,PATHINFO_EXTENSION));

    if($extensao != 'jpg' && $extensao != 'png' && $extensao != 'jpeg')
        die("tipo de arquivo invalido");

        $path =  $pasta . $nomeDaFoto;
    $aceito = move_uploaded_file($foto['tmp_name'], $path);
    if($aceito)
        $insereImagem = "INSERT INTO upload(path, id_usuario) VALUE(:path, :id_usuario)";
        $insereImagem = $conexao->prepare($insereImagem);
        $insereImagem->bindValue(":path", $path);
        $insereImagem->bindValue(":id_usuario", $id_usuario);
        $insereImagem->execute();
        echo "<p>Arquivo Sucesso, para acessar: <a target=\"_blank\" href=\"img/$nomeDaFoto\">Clique Aqui</a>";
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
            
        <div><img src="<?php echo $mostraImagem1['path']?>" alt=""></div>
        <a href="mostrarFotos.php">|Ver fotos|</a><br /><br />
        <a href="inicio.php">VOLTAR</a>
	</body>
</html>