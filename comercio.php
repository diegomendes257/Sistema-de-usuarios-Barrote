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
        $fotoId = 6;
		$id = $_SESSION['id_usuario'];
		$consultaFoto = 'SELECT path_perfil from fotosperfil WHERE id_perfil = :id';
		$consultaFoto = $conexao->prepare($consultaFoto);
		$consultaFoto->bindValue(':id', $fotoId);
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
            <div class="container p-4 h-auto">
                <div class="row pt-3 h-auto">
                    <p class="display-4">COMÉRCIO</p>
                </div>
                <hr class="p-3" />
                <div class="row">
                    <div class="col">
                        <h2 class="h2">O que é o comércio?</h2>
                        <hr>
                        <p>
                            O comércio é o lugar onde você vai poder comprar os seus materiais para trabalhar!<br />
                            Nele, você pode comprar e participar de disputas diversas. Use seu *barro para participar;
                        </p>
                    </div>
                    <div class="col p-2">
                        <p>Info</p>
                    </div>
                    <div class="col p-4">
                        <div>
                            <?php
                                echo "<img class='w-50 fotoPerfil' src='./".$exibeFoto['path_perfil']."'>";
                            ?>
                            <h5>Adivinha a cor</h5>
                            <p>
                                Inscrição: R$ 1,00<br />
                                20 de maio de 2022
                            </p>
                            <button class="btn btn-primary">CLIQUE PARA PARTICIPAR</button>
                        </div>
                    </div>
                </div>
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