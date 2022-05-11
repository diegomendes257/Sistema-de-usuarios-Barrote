
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
		<link rel="stylesheet" type="text/css" href="../estiloSistema.css"/>
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
					<a style="color:yellow" href="../inicio.php?sair=true">SAIR</a>
				</div>
			</header>
			<div class="meio">
                <div class='container-fluid bg-warning'>
                    <p>
                        PAINEL DE JOGOS - JOGO PRINCIPAL OU SELECIONADO
                    </p>
                </div>
                <p>uma lista de jogos e o principal mostrando em cima, e quando alguém clicar em algum, o card do jogo ser destaque</p>
                <div class="blocoCards">
                    <div class ="cardPainelJogo">
                        <div class="cardImagem">
                            <img src="../img/img_jogoAdivinha.jpg" alt="">
                        </div>
                        <div class="cardDescricao">
                            <p>Acerte a cor da letra e ganhe moedas!</p>
                        </div>
                        <div class="botaoCard">
                            <nav class="">
                                <button onclick="window.location='../jogoAdivinha/jogoAdivinha.php';">COMPETIR</button>
                            </nav>
                        </div>
                    </div>
                </div>
			</div>
			<div class="menu">
				<nav class="sub-menu1"><button onclick="window.location='../inicio.php'"><img src="../img/inicio_icon.png" alt="inicio"></button></nav>
				<nav class="sub-menu1"><button onclick="window.location='../painelJogo.php';"><img src="../img/salao_icon.png" alt="salao"></button></nav>
				<nav class="sub-menu1"><button onclick="window.location='../comercio.php';"><img src="../img/comercio_icon.png" alt="comercio"></button></nav>
				<nav class="sub-menu1"><button><img src="../img/carteira_icon.png" alt="carteira"></button></nav>
				<nav class="sub-menu1"><button onclick="window.location='../painelUsuario';"><img src="../img/perfil_icon.png" alt="perfil"></button></nav>
			</div>
		</div>
	</body>
</html>