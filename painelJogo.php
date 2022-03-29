<?php
	include("conexao1.php");
	require 'Usuario.php';

	$u = new Usuario();
	$idDebita = $_SESSION['id'];
		$consulta1 = "SELECT id, saldo, nome FROM usuario WHERE id = :id";
			$consulta1 = $conexao->prepare($consulta1);
			$consulta1->bindValue(":id", $idDebita);
			$consulta1->execute();
			$mostra1 = $consulta1->fetch();
?>




<!DOCTYPE html>
<html lang="pt-br">
	<head>
    <title>Bem vindo <?php echo $_SESSION['nome']; ?></title>
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
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
					<?php echo 'Saldo:  R$ '.number_format($mostra1['saldo'] , 2, ',',' . ');?>
				</div>
				<div class="logout">
					<a style="color:yellow" href="inicio.php">Voltar</a>
				</div>
			</header>
            <section class="container-fluid boxSection">
                <div class="tituloPainelJogo">
                    <h3>Escolha seu jogo</h3>
                </div>
                <div class="blocoCards">
                    <div class ="cardPainelJogo">
                        <div class="cardImagem">
                            img
                        </div>
                        <div class="cardDescricao">
                            Descrição
                        </div>
                        <div>
                        <nav class="sub-menu1"><button onclick="window.location='./jogoAdivinha/jogoAdivinha.php';">Adivinha a cor</button></nav>
                        </div>
                    </div>
                    <div class ="cardPainelJogo">
                        <div class="cardImagem">
                            img
                        </div>
                        <div class="cardDescricao">
                            Descrição
                        </div>
                        <div>
                            botão
                        </div>
                    </div>
                    <div class ="cardPainelJogo">
                        <div class="cardImagem">
                            img
                        </div>
                        <div class="cardDescricao">
                            Descrição
                        </div>
                        <div>
                            botão
                        </div>
                    </div>
                    <div class ="cardPainelJogo">
                        <div class="cardImagem">
                            img
                        </div>
                        <div class="cardDescricao">
                            Descrição
                        </div>
                        <div>
                            botão
                        </div>
                    </div>
                </div>
            </section>
	</body>
</html>