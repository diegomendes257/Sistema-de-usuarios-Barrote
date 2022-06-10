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

		$ultimos5 = 'SELECT nome, criado FROM usuario order by id_usuario desc LIMIT 5';
		$consulta5 = $conexao->prepare($ultimos5);
		$consulta5->execute();
?>

<!DOCTYPE html>
<html lang="pt-br">
	<head>
		<title>Bem vindo <?php echo $_SESSION['nome']; ?></title>
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="stylesheet" type="text/css" href="estiloSistema.css"/>
		<link rel="stylesheet" href="./css/bootstrap.min.css">
		<script type="text/javascript" src="adivinhaCor.js"></script>
		<meta charset="utf-8">
	</head>	
	<body>
		<!--		TOPO		 -->
		<header class="container-fluid bg-success header">
			<div class="container">
				<div class="row">
					<div class="col">
						<span class="text-center text-nowrap titulo">
							<?php 
								echo 'BARROTÉ';
							?>
						</span>
					</div>
					<div class="col">
						<span class="text-center text-nowrap">
							<?php 
								echo 'Olá &nbsp<span class="titulo">'.$_SESSION['nome'].'</span>';
							?>
						</span>
					</div>
					<div class="col">
						<span class="text-center text-nowrap">
							<?php 
								echo 'Barro: <span class="saldo">'.number_format($mostra1['saldo'] , 2, ',',' . </span>');
							?>
						</span>
					</div>
					<div class="d-flex align-items-center">
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
				</div>
			</div>
		</header>

		<!--		FIM 	TOPO		 -->

		<!--		SEÇÃO 		 -->

		<div class="d-flex align-items-center">
			<div class="shadow p-5 mb-5 mt-5 rounded bg-success text-center">
				<div class="h2">
					SALDO:
				</div>
				<div class="h1" style="color:yellow;">
					<?php 
                        echo 'Barro: '." ".number_format($mostra1['saldo'] , 2, ',',' . ');
                    ?>
				</div>
				<div>
					<span>Este é seu saldo!</span>
				</div>
			</div>
		</div>

		<!--		FIM 	SEÇÃO 		 -->

		<!--		RODAPÉ 	SEÇÃO 		 -->

		<footer class="container-fluid footer bg-success mt-4">
			<div class="row footer align-items-center">
				<nav class="col text-center sub-menu1">
					<div>
						<button onclick="window.location='inicio.php'">
							<svg width="25" height="25" class="bi bi-house" viewBox="0 0 16 16">
								<path fill-rule="evenodd" d="M2 13.5V7h1v6.5a.5.5 0 0 0 .5.5h9a.5.5 0 0 0 .5-.5V7h1v6.5a1.5 1.5 0 0 1-1.5 1.5h-9A1.5 1.5 0 0 1 2 13.5zm11-11V6l-2-2V2.5a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5z"/>
								<path fill-rule="evenodd" d="M7.293 1.5a1 1 0 0 1 1.414 0l6.647 6.646a.5.5 0 0 1-.708.708L8 2.207 1.354 8.854a.5.5 0 1 1-.708-.708L7.293 1.5z"/>
							</svg>
							<div class="text_icon_rodape">INÍCIO</div>
						</button>
					</div>
				</nav>
				<nav class="col text-center sub-menu1">
					<div>
						<button onclick="window.location='painelJogo.php';">
							<svg width="25" height="25" class="bi bi-controller" viewBox="0 0 16 16">
								<path d="M11.5 6.027a.5.5 0 1 1-1 0 .5.5 0 0 1 1 0zm-1.5 1.5a.5.5 0 1 0 0-1 .5.5 0 0 0 0 1zm2.5-.5a.5.5 0 1 1-1 0 .5.5 0 0 1 1 0zm-1.5 1.5a.5.5 0 1 0 0-1 .5.5 0 0 0 0 1zm-6.5-3h1v1h1v1h-1v1h-1v-1h-1v-1h1v-1z"/>
								<path d="M3.051 3.26a.5.5 0 0 1 .354-.613l1.932-.518a.5.5 0 0 1 .62.39c.655-.079 1.35-.117 2.043-.117.72 0 1.443.041 2.12.126a.5.5 0 0 1 .622-.399l1.932.518a.5.5 0 0 1 .306.729c.14.09.266.19.373.297.408.408.78 1.05 1.095 1.772.32.733.599 1.591.805 2.466.206.875.34 1.78.364 2.606.024.816-.059 1.602-.328 2.21a1.42 1.42 0 0 1-1.445.83c-.636-.067-1.115-.394-1.513-.773-.245-.232-.496-.526-.739-.808-.126-.148-.25-.292-.368-.423-.728-.804-1.597-1.527-3.224-1.527-1.627 0-2.496.723-3.224 1.527-.119.131-.242.275-.368.423-.243.282-.494.575-.739.808-.398.38-.877.706-1.513.773a1.42 1.42 0 0 1-1.445-.83c-.27-.608-.352-1.395-.329-2.21.024-.826.16-1.73.365-2.606.206-.875.486-1.733.805-2.466.315-.722.687-1.364 1.094-1.772a2.34 2.34 0 0 1 .433-.335.504.504 0 0 1-.028-.079zm2.036.412c-.877.185-1.469.443-1.733.708-.276.276-.587.783-.885 1.465a13.748 13.748 0 0 0-.748 2.295 12.351 12.351 0 0 0-.339 2.406c-.022.755.062 1.368.243 1.776a.42.42 0 0 0 .426.24c.327-.034.61-.199.929-.502.212-.202.4-.423.615-.674.133-.156.276-.323.44-.504C4.861 9.969 5.978 9.027 8 9.027s3.139.942 3.965 1.855c.164.181.307.348.44.504.214.251.403.472.615.674.318.303.601.468.929.503a.42.42 0 0 0 .426-.241c.18-.408.265-1.02.243-1.776a12.354 12.354 0 0 0-.339-2.406 13.753 13.753 0 0 0-.748-2.295c-.298-.682-.61-1.19-.885-1.465-.264-.265-.856-.523-1.733-.708-.85-.179-1.877-.27-2.913-.27-1.036 0-2.063.091-2.913.27z"/>
							</svg>
							<div class="text_icon_rodape">JOGOS</div>
						</button>
					</div>
				</nav>
				<nav class="col text-center sub-menu1">
					<div>
						<button onclick="window.location='comercio.php';">
							<svg width="25" height="25" class="bi bi-shop-window" viewBox="0 0 16 16">
								<path d="M2.97 1.35A1 1 0 0 1 3.73 1h8.54a1 1 0 0 1 .76.35l2.609 3.044A1.5 1.5 0 0 1 16 5.37v.255a2.375 2.375 0 0 1-4.25 1.458A2.371 2.371 0 0 1 9.875 8 2.37 2.37 0 0 1 8 7.083 2.37 2.37 0 0 1 6.125 8a2.37 2.37 0 0 1-1.875-.917A2.375 2.375 0 0 1 0 5.625V5.37a1.5 1.5 0 0 1 .361-.976l2.61-3.045zm1.78 4.275a1.375 1.375 0 0 0 2.75 0 .5.5 0 0 1 1 0 1.375 1.375 0 0 0 2.75 0 .5.5 0 0 1 1 0 1.375 1.375 0 1 0 2.75 0V5.37a.5.5 0 0 0-.12-.325L12.27 2H3.73L1.12 5.045A.5.5 0 0 0 1 5.37v.255a1.375 1.375 0 0 0 2.75 0 .5.5 0 0 1 1 0zM1.5 8.5A.5.5 0 0 1 2 9v6h12V9a.5.5 0 0 1 1 0v6h.5a.5.5 0 0 1 0 1H.5a.5.5 0 0 1 0-1H1V9a.5.5 0 0 1 .5-.5zm2 .5a.5.5 0 0 1 .5.5V13h8V9.5a.5.5 0 0 1 1 0V13a1 1 0 0 1-1 1H4a1 1 0 0 1-1-1V9.5a.5.5 0 0 1 .5-.5z"/>
							</svg>
							<div class="text_icon_rodape">COMÉRCIO</div>
						</button>
					</div>
				</nav>
				<nav class="col text-center sub-menu1">
					<div>
						<button onclick="window.location='carteira.php';">
							<svg width="25" height="25" class="bi bi-wallet2" viewBox="0 0 16 16">
								<path d="M12.136.326A1.5 1.5 0 0 1 14 1.78V3h.5A1.5 1.5 0 0 1 16 4.5v9a1.5 1.5 0 0 1-1.5 1.5h-13A1.5 1.5 0 0 1 0 13.5v-9a1.5 1.5 0 0 1 1.432-1.499L12.136.326zM5.562 3H13V1.78a.5.5 0 0 0-.621-.484L5.562 3zM1.5 4a.5.5 0 0 0-.5.5v9a.5.5 0 0 0 .5.5h13a.5.5 0 0 0 .5-.5v-9a.5.5 0 0 0-.5-.5h-13z"/>
							</svg>
							<div class="text_icon_rodape">CARTEIRA</div>
						</button>
					</div>
				</nav>
				<nav class="col text-center sub-menu1">
					<div>
						<button onclick="window.location='painelUsuario/index.php';">
							<svg width="25" height="25" class="bi bi-person" viewBox="0 0 16 16">
								<path d="M8 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6zm2-3a2 2 0 1 1-4 0 2 2 0 0 1 4 0zm4 8c0 1-1 1-1 1H3s-1 0-1-1 1-4 6-4 6 3 6 4zm-1-.004c-.001-.246-.154-.986-.832-1.664C11.516 10.68 10.289 10 8 10c-2.29 0-3.516.68-4.168 1.332-.678.678-.83 1.418-.832 1.664h10z"/>
							</svg>
							<div class="text_icon_rodape">PERFIL</div>
						</button>
					</div>
				</nav>
			</div>
		</footer>
	</body>
</html>