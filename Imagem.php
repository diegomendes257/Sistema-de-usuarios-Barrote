<?php 
	
	class Imagem{
//------------------------LOGAR--------------------------------------------------

        public function insereImagem($id_usuario){
            global $conexao;

            //================================= UPLOAD SIMPLES DE IMAGEM ========= /
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
        }
    }
?>