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

		$consultaTudo = "SELECT * FROM usuario";
		$consultaTudo = $conexao->prepare($consultaTudo);
		$consultaTudo->execute();

		//-------------- EXIBE FOTO -------------
		$id = $_SESSION['id_usuario'];
		$consultaFoto = 'SELECT path_perfil from fotosperfil WHERE id_usuario = :id';
		$consultaFoto = $conexao->prepare($consultaFoto);
		$consultaFoto->bindValue(':id', $id);
		$consultaFoto->execute();
		$exibeFoto = $consultaFoto->fetch();
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
					<span class="bem-vindo">Bem vindo(a) &nbsp</span>
					<?php 
						echo '  '.$_SESSION['nome'];
					?>
				</div>
				<div style="color:white;display:flex;align-items:center">
					<?php echo 'Barro: '.number_format($mostra1['saldo'] , 2, ',',' . ');?>
				</div>
				<div class="logout">
					<?php 
						if(!isset($_SESSION['id_usuario']))
							header('Location: principal.php');
						
						if(isset($_GET['sair'])){
							unset($_SESSION['id_usuario']);
							session_destroy();
							header('Location: principal.php');
						}
					?>
					
					<a style="color:yellow" href="inicio.php?sair=true">SAIR</a>
				</div>
			</header>
			<nav style='text-align:center'>
						<a href="./adm/consulta.php">Clique para consultar!</a> - /
						<a href="./adm/adicionaValor.php">Clique para creditar dinheiro para alguém!</a> - /
						<a href="./adm/adicionaValorDado.php">Clique para creditar e ser debitado!</a> - /
						<a href="formImagem.php">Carregar imagem!</a>
			</nav>
			<div class="meio">
				<section class="container-fluid bg-white banner">
					<h2>
						<b>Aqui é o início de tudo!!!</b>
					</h2>
					<p>Vá para a aba de salão para se divertir! Ganhe moedas fazendo as tarefas!</p>
				</section>
				<section id="dados" class="container-fluid bg-white">

					<style>
            			.fotoPerfil{
                				width: 150px;
								border-radius: 100%;
           			 		}
						.textoPerfil{
								color: white;
							}
        			</style>

					<div class="container bg-dark">
						<?php
							if($exibeFoto == true){
								echo '<p class="textoPerfil">SUA FOTO DE PERFIL - Ficou muito bom!<p>';
								echo "<img class='fotoPerfil' src='./".$exibeFoto['path_perfil']."'>";
							}else{
								echo '<p class="textoPerfil">SUA FOTO DE PERFIL - Adicione uma!</p>';
								echo "<img class='fotoPerfil' src='./img/perfil_icon.png'>";
							}
						?>
						<p class="textoPerfil"><a href="trocaFotoPerfil.php">TROCAR FOTO DE PERFIL</a></p>
					</div>
					<div class="container bg-success">
						<p>Aparecerá aqui as informações</p>
						<div id="recebe" style="display:none;"></div>
						<button style="padding:7px; border:1px #808080 solid;" onclick="exibeNome('recebe')">Clique para ver seus dados!</button>
						<script>
							function exibeNome(recebe) {
								var display = document.getElementById('recebe').style.display;
								
								if(display == "none"){
									let nome = "<?php echo $_SESSION['nome'] ?>";
									let saldo = "<?php echo $mostra1['saldo'] ?>";
									recebeDados = document.getElementById('recebe');
									recebeDados.innerHTML = "Seu nome: " + nome + "<br>" + "Seu saldo: " + saldo + "<br><br>";
									document.getElementById('recebe').style.display = 'block';
								}else{
									document.getElementById('recebe').style.display = 'none';
								}
							}
						</script>
					</div>
				</section>
			</div>
			<div class="menu">
				<nav class="sub-menu1"><button onclick="window.location='./inicio.php'"><img src="img/inicio_icon.png" alt="inicio"></button></nav>
				<nav class="sub-menu1"><button onclick="window.location='./painelJogo.php';"><img src="img/salao_icon.png" alt="salao"></button></nav>
				<nav class="sub-menu1"><button onclick="window.location='./comercio.php';"><img src="img/comercio_icon.png" alt="comercio"></button></nav>
				<nav class="sub-menu1"><button><img src="img/carteira_icon.png" alt="carteira"></button></nav>
				<nav class="sub-menu1"><button onclick="window.location='./painelUsuario';"><img src="img/perfil_icon.png" alt="perfil"></button></nav>
			</div>
		</div>
	</body>
</html>