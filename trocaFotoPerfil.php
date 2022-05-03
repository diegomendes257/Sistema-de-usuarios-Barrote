<?php 
    include "conexao1.php";
    global $conexao;
    session_id();

    $id_usuario = $_SESSION['id_usuario'];

    //================================= TROCA FOTO DO PERFIL - UPLOAD SIMPLES DE IMAGEM ========= /
    var_dump($_FILES);
?>

<!DOCTYPE html>
<html>
    <head>
        <title>Troque sua foto de perfil</title>
    </head>
    <body>
        <h2>
            Troque sua foto de perfil abaixo.
        </h2>
        <form method="POST" action="" enctype="multipart/form-data" name="cadastroImg">
            <input type="file" name="foto" /><br />
            <input type="submit" name="cadastrarImagem" value="CadastrarImg" />
            <br>
        </form>
        <br />       
        <a href="mostrarFotos.php">|Ver fotos|</a><br /><br />
        <a href="inicio.php">VOLTAR</a>
    </body>
</html>

<?php
    if(isset($_FILES['foto'])){
        $foto = $_FILES['foto'];
        $nomeDaFoto = $foto['name'];
        $pasta = "img/";
        $extensao = strtolower(pathinfo($nomeDaFoto,PATHINFO_EXTENSION));
        if($extensao != 'jpg' && $extensao != 'png' && $extensao != 'jpeg'){
            die("tipo de arquivo invalido");
            $path =  $pasta . $nomeDaFoto;
            $aceito = move_uploaded_file($foto['tmp_name'], $path);
            if($aceito){
                //================================= CONSULTA TABELA FOTO PERFIL ========= /
                            $consultaFotoPerfil = "SELECT path_perfil, id_usuario FROM fotosperfil WHERE id_usuario = :id_user";
                            $consultaFotoPerfil = $conexao->prepare($consultaFotoPerfil);
                            $consultaFotoPerfil->bindValue(":id_user",$id_usuario);
                            $consultaFotoPerfil->execute();
                            if($consultaFotoPerfil->rowCount() > 0){
                                $atualizaImagem = "UPDATE fotosperfil set path_perfil = :path_atualiza WHERE id_usuario = :id_usuario";
                                $atualizaImagem = $conexao->prepare($atualizaImagem);
                                $atualizaImagem->bindValue(":path_atualiza", $path);
                                $atualizaImagem->bindValue(":id_usuario", $id_usuario);
                                $atualizaImagem->execute();
                                echo "<p>Foto atualizada com sucesso, para acessar a mudança: <a target=\"_blank\" href=\"img/$nomeDaFoto\">Clique Aqui</a>";
                            }else{
                                $insereImagem = "INSERT INTO fotosperfil(path_perfil, id_usuario) VALUE(:path, :id_usuario)";
                                $insereImagem = $conexao->prepare($insereImagem);
                                $insereImagem->bindValue(":path", $path);
                                $insereImagem->bindValue(":id_usuario", $id_usuario);
                                $insereImagem->execute();
                                echo "<p>Arquivo Sucesso, para acessar: <a target=\"_blank\" href=\"img/$nomeDaFoto\">Clique Aqui</a>";
                            }
                        }else{
                        return false;
                    }
        }else{
            return false;
        }
    }  
?>