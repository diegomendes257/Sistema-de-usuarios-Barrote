<?php
    require "../conexao1.php";
    require "../Usuario.php";
    session_id();

    global $conexao;

    $id = $_SESSION['id_usuario'];

    if(isset($_POST['tem'])){

        $exibe = 'SELECT id_rodada, cor, palpite, jogada, acerto FROM jogoadivinha WHERE id_usuario = :id ORDER BY 1 DESC';
        $exibe = $conexao->prepare($exibe);
        $exibe->bindValue(":id", $id);
        $exibe->execute();

        while($exibeTudo = $exibe->fetch(PDO::FETCH_ASSOC)){
            echo '<div class="conteiner-fluid">';
            echo '<div class="row">';
            if($exibeTudo['acerto'] == 0){
                echo '<div class="col-1 text-center border-bottom bg-danger">'.$exibeTudo['id_rodada'].'</div>';
            }else if($exibeTudo['acerto'] == 1){
                echo '<div class="col-1 text-center border-bottom bg-primary">'.$exibeTudo['id_rodada'].'</div>';
            }
            $data = date_create($exibeTudo['jogada']);

            echo '<div class="col-2 text-center border-bottom">'.$exibeTudo['cor'].'</div>';
            echo '<div class="col-2 text-center border-bottom">'.$exibeTudo['palpite'].'</div>';
            echo '<div class="col-7 text-center border-bottom">'.date_format($data, 'd/m/Y').' às '.date_format($data, 'H:i:s').'</div>';
            echo '<hr>';
            echo '</div>';
            echo '</div>';
        }
    }
?>