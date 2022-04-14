<?php
	include("../conexao1.php");
	require('../Usuario.php');

	$u = new Usuario();
	$idDebita = $_SESSION['id'];
	$adm = $_SESSION['adm'];
	$u->validaUsuario($idDebita, $adm);

	$consulta1 = "SELECT id, saldo, nome, adm FROM usuario WHERE id = :id";
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
		<link rel="stylesheet" type="text/css" href="../estiloSistema.css"/>
		<script type="text/javascript" src="adivinhaCor.js"></script>
		<meta charset="utf-8">
	</head>
	<body>
		<div class="geral">
			<header class="topo">
				<div class="nome">
					<span class="bem-vindo">Bem vindo(a) &nbsp</span>
					<?php 
						echo '  '.$_SESSION['nome'];
					?>
				</div>
				<div style="color:white;display:flex;align-items:center">
					<?php echo 'Barro &nbsp'.number_format($mostra1['saldo'] , 2, ',',' . ');?>
				</div>
				<div class="logout">
					<?php 
						if(!isset($_SESSION['id']))
							header('Location: principal.php');
						
						if(isset($_GET['sair'])){
							unset($_SESSION['id']);
							header('Location: principal.php');
						}
					?>
					<a style="color:yellow" href="../inicio.php?sair=true">SAIR</a>
				</div>
			</header>
			<nav style='text-align:center'>
						<a href="consulta.php">Clique para consultar!</a> - /
						<a href="adicionaValor.php">Clique para creditar dinheiro para alguém!</a> - /
						<a href="adicionaValorDado.php">Clique para creditar e ser debitado!</a> - /
						<a href="formImagem.php">Carregar imagem!</a>
			</nav>
			<div class="meio">
				<section>
					<h2><b>Painel</b></h2>
					<p></p>
				</section>
				<section id="dados">
					dados
				</section>
			</div>
			<div class="menu">
			<nav class="sub-menu1"><button onclick="window.location='../inicio.php'"><img src="../img/inicio_icon.png" alt="inicio"></button></nav>
				<nav class="sub-menu1"><button onclick="window.location='../painelJogo.php';"><img src="../img/salao_icon.png" alt="salao"></button></nav>
				<nav class="sub-menu1"><button><img src="../img/comercio_icon.png" alt="comercio"></button></nav>
				<nav class="sub-menu1"><button><img src="../img/carteira_icon.png" alt="carteira"></button></nav>
				<nav class="sub-menu1"><button onclick="window.location='../painelUsuario';"><img src="../img/perfil_icon.png" alt="perfil"></button></nav>
			</div>
		</div>
	</body>
</html>