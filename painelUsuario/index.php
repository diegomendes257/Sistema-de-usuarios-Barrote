<?php
	include("../conexao1.php");
	require '../Usuario.php';

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
						if(!isset($_SESSION['id']))
							header('Location: principal.php');
						
						if(isset($_GET['sair'])){
							unset($_SESSION['id']);
							session_destroy();
							header('Location: principal.php');
						}
					?>
					<a style="color:yellow" href="inicio.php?sair=true">SAIR</a>
				</div>
			</header>
            <div class="container-fluid bg-dark">
                <div>
                    <div style="color:white;">
                        <?php echo 'Barro: '.number_format($mostra1['saldo'] , 2, ',',' . ');?>
                    </div>
                    <div>
                        1h1h1h1h1
                    </div>
                </div>
            </div>
            <div class="menu">
				<nav class="sub-menu1"><button onclick="window.location='../inicio.php'"><img src="../img/inicio_icon.png" alt="inicio"></button></nav>
				<nav class="sub-menu1"><button onclick="window.location='../painelJogo.php';"><img src="../img/salao_icon.png" alt="salao"></button></nav>
				<nav class="sub-menu1"><button><img src="../img/comercio_icon.png" alt="comercio"></button></nav>
				<nav class="sub-menu1"><button><img src="../img/carteira_icon.png" alt="carteira"></button></nav>
				<nav class="sub-menu1"><button onclick="window.location='index.php';"><img src="../img/perfil_icon.png" alt="perfil"></button></nav>
			</div>
        </div>
	</body>
</html>