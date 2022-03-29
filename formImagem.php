<?php 
include "conexao1.php";
    
/*if(isset($_POST['cadastrarImagem'])) {
   
    // Count total files
    $countfiles = count($_FILES['files']);
    
    // Prepared statement
    $query = "INSERT INTO imagem(image) VALUES(?)";
   
    $statement = $conexao->prepare($query);
   
    // Loop all files
    for($i = 0; $i < $countfiles; $i++) {
   
        // File name
        $filename = $_FILES['files'][$i];
       
        // Location
        $target_file = 'upload/'.$filename;
       
        // file extension
        $file_extension = pathinfo(
            $target_file, PATHINFO_EXTENSION);
              
        $file_extension = strtolower($file_extension);
       
        // Valid image extension
        $valid_extension = array("png","jpeg","jpg");
       
        if(in_array($file_extension, $valid_extension)) {
   
            // Upload file
            if(move_uploaded_file(
                $_FILES['files'][$i],
                $target_file)
            ) {
  
                // Execute query
                $statement->execute(
                    array($filename,$target_file));
            }
        }
    }
      
    echo "Arquivo carregado com sucesso!";
}*/









//================================= tentativa 2 ========= /

var_dump($_FILES);


if(isset($_FILES['foto'])){
    $foto = $_FILES['foto'];

    if($foto['error'])
        echo "error ao enviar";

    $pasta = "img/";
    $nomeDaFoto = $foto['name'];

    $extensao = strtolower(pathinfo($nomeDaFoto,PATHINFO_EXTENSION));

    if($extensao !='jpg' && $extensao != 'png')
        echo "tipo de arquivo invalido";
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
        <a href="view.php">|Ver fotos|</a><br /><br />
        <a href="inicio.php">VOLTAR</a>
	</body>
</html>