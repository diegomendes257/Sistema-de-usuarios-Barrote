<?php
    require "../conexao1.php";
    session_id();

    global $conexao;

    $id_usuario = $_SESSION['id_usuario'];

    $insertDados = 'INSERT INTO jogada(pontos_jogo, id_usuario, id_jogo) 
                    VALUES(:pontos_jogo, :id_usuario, :id_jogo)';
    $insertDados = $conexao->prepare($insertDados);
    $insertDados->bindValue(':pontos_jogo', $pontos_jogo);
    $insertDados->bindValue(':id_usuario', $id_usuario);
    $insertDados->bindValue(':id_jogo', $id_jogo);
    $insertDados->execute();
?>



if(isset($_FILES['foto'])){
    $foto = $_FILES['foto'];

    $nomeDaFoto = $foto['name'];
    $pasta = "img/";

    $extensao = strtolower(pathinfo($nomeDaFoto,PATHINFO_EXTENSION));

    if($extensao != 'jpg' && $extensao != 'png' && $extensao != 'jpeg')
        die("tipo de arquivo invalido");

        $path =  $pasta . $nomeDaFoto;
    $aceito = move_uploaded_file($foto['tmp_name'], $path);
    if($aceito){
        if(!$exibeFoto){
           //$atualiza = 'UPDATE fotosperfil set path_perfil = :path WHERE id_usuario = :id_usuario';
           $insereImagem = "INSERT INTO fotosperfil(path_perfil, id_usuario) VALUE(:path_perfil, :id_usuario)";
           $insereImagem = $conexao->prepare($insereImagem);
           $insereImagem->bindValue(":path_perfil", $path);
           $insereImagem->bindValue(":id_usuario", $id_usuario);
           $insereImagem->execute();
           echo "<p>Arquivo Sucesso, para acessar: <a target=\"_blank\" href=\"img/$nomeDaFoto\">Clique Aqui</a>";
       
        }else{
            $atualiza = 'UPDATE fotosperfil set path_perfil = :path WHERE id_usuario = :id_usuario';
            $atualiza = $conexao->prepare($atualiza);
            $atualiza->bindValue(":path", $path);
            $atualiza->bindValue(":id_usuario", $id_usuario);
            $atualiza->execute();
            echo "<p>Arquivo atualizado com sucesso, para acessar: <a target=\"_blank\" href=\"img/$nomeDaFoto\">Clique Aqui</a>";
            }
    }else{
            echo "erro ao enviar!";
    }
}