<?php
	include("../conexao1.php");
	require '../Usuario.php';

	$u = new Usuario();
	$idDebita = $_SESSION['id_usuario'];
		$consulta1 = "SELECT id_usuario, saldo, nome FROM usuario WHERE id_usuario = :id";
			$consulta1 = $conexao->prepare($consulta1);
			$consulta1->bindValue(":id", $idDebita);
			$consulta1->execute();
			$mostra1 = $consulta1->fetch();

	
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
		<link rel="stylesheet" href="../css/bootstrap.min.css">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="stylesheet" type="text/css" href="../estiloSistema.css"/>
		<meta charset="utf-8">
	</head>
	<body>
		<div class="geral">
			<header class="topo">
				<div class="nome">
					<span class="bem-vindo"></span>
					<?php 
						echo '  '.$_SESSION['nome'];
					?>
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
					<a style="color:yellow" href="../inicio.php?sair=true">SAIR</a>
				</div>
			</header>
<!-- FIM DA SEÇÃO 1------------------------------------------------------------------------>
<!-- COMEÇO DA SEÇÃO 1------------------------------------------------------------------------>
					<style>
            			.fotoPerfil{
                				width: 150px;
								border-radius: 100%;
           			 		}
						.textoPerfil{
								color: white;
							}

						.conta a{
							color: white;
							font-size: 20pt;
						}
        			</style>

			<div class="container p-3 mb-2 rounded text-center">
				<div class="row">
					<div class="col-md-4">
						<?php
							if($exibeFoto == true){
								echo '<p class="textoPerfil">SUA FOTO DE PERFIL - Ficou muito bom!<p>';
								echo "<img class='fotoPerfil' src='../".$exibeFoto['path_perfil']."'>";
							}else{
								echo '<p class="textoPerfil">SUA FOTO DE PERFIL - Adicione uma!</p>';
								echo "<img class='fotoPerfil' src='../img/perfil_icon.png'>";
							}
						?>
						<p class="textoPerfil"><a href="trocaFotoPerfil.php">TROCAR FOTO DE PERFIL</a></p>
					</div>
					<div class="d-flex align-items-center">
						<div class="shadow p-5 mb-5 rounded bg-success text-center">
							<div class="h2">
								SALDO:
							</div>
							<div class="h1" style="color:yellow;">
								<?php echo 'Barro: '." ".number_format($mostra1['saldo'] , 2, ',',' . ');?>
							</div>
							<div>
								<span>Este é seu saldo!</span>
							</div>
						</div>
					</div>
				</div>
			</div>
            <div class="container shadow p-3 mb-5 rounded bg-success text-center">
                <div>
					<div class="h2 text-warning">
                        CONTA
                    </div>
					<div class="hr bg-warning"><hr /></div>
                    <div class="conta">
						<a href="">Trocar senha</a><br />
						<a href="">Alterar nome</a><br />
						<a href="">Desativar conta</a><br />
						<a href="">Reportar um erro</a>
                    </div>
                </div>
            </div>

			<div class="container shadow p-3 mb-3 rounded bg-success text-center">
                <div>
				<div class="h2 text-warning">
                        SEUS DADOS
                    </div>
					<div class="hr bg-warning"><hr /></div>
                    <div class="" style="color:yellow;">
                        <span></span>
                    </div>
                    <div>
                        <span>Este é seu saldo!</span>
                    </div>
                </div>
            </div>

			

            <div class="menu">
				<nav class="sub-menu1"><button onclick="window.location='../inicio.php'"><img src="../img/inicio_icon.png" alt="inicio"></button></nav>
				<nav class="sub-menu1"><button onclick="window.location='../painelJogo.php';"><img src="../img/salao_icon.png" alt="salao"></button></nav>
				<nav class="sub-menu1"><button onclick="window.location='../comercio.php';"><img src="../img/comercio_icon.png" alt="comercio"></button></nav>
				<nav class="sub-menu1"><button><img src="../img/carteira_icon.png" alt="carteira"></button></nav>
				<nav class="sub-menu1"><button onclick="window.location='index.php';"><img src="../img/perfil_icon.png" alt="perfil"></button></nav>
			</div>
        </div>
	</body>
</html>