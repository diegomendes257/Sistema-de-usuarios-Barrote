<?php
	include("conexao1.php");
	require 'Usuario.php';

	$u = new Usuario();
	$idDebita = $_SESSION['id_usuario'];
		$consulta1 = "SELECT id_usuario, saldo, nome FROM usuario WHERE id_usuario = :id";
			$consulta1 = $conexao->prepare($consulta1);
			$consulta1->bindValue(":id", $idDebita);
			$consulta1->execute();
			$mostra1 = $consulta1->fetch();
?>

<!DOCTYPE html>
<html lang="pt-br">
	<head>
    	<title>Bem vindo <?php echo $_SESSION['nome']; ?></title>
		<link rel="stylesheet" href="./css/bootstrap.min.css">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="stylesheet" type="text/css" href="estiloSistema.css"/>
		<script type="text/javascript" src="adivinhaCor.js"></script>
		<meta charset="utf-8">
	</head>
	<body>
		<div class="geral">
			<header class="topo">
				<div class="nome">
					<span class="bem-vindo"></span>
					<?php 
						echo 'Salão de Jogos';
					?>
				</div>
				<div style="color:white;display:flex;align-items:center">
					<?php echo 'Barro &nbsp '.number_format($mostra1['saldo'] , 2, ',',' . ');?>
				</div>
				<div class="logout">
					<a style="color:yellow" href="javascript:void(0)" onClick="history.go(-1); return false;">VOLTAR</a>
				</div>
			</header>
            <section class="container-fluid boxSection">
                <div class="tituloPainelJogo">
                    <h3>Escolha seu jogo</h3>
                </div>
                <div class="blocoCards">
                    <div class ="cardPainelJogo">
                        <div class="cardImagem">
                            <img src="./img/img_jogoAdivinha.jpg" alt="">
                        </div>
                        <div class="cardDescricao">
                            <p>Acerte a cor da letra e ganhe moedas!</p>
                        </div>
                        <div class="botaoCard">
                            <nav class="">
                                <button onclick="window.location='./jogoAdivinha/jogoAdivinha.php';">Adivinha a cor</button>
                            </nav>
                        </div>
                    </div>
                </div>
            </section>
	</body>
</html>