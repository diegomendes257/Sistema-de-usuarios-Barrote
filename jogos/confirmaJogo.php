<!-- aqui vai estar o depósito do participante, onde ele vai se inscrever no jogo, pagar e começar a concorrer!
vai ter uma descrição do jogo, o valor, o prêmio e muito mais. Um botão para anexar o arquivo do pagamento.

- Data do início da disputa
- valor da disputa
- Quantidade de jogadores
- Limite de pontos
- Apenas um vencedor
- 01 prêmio

-------------------------------------------
OBS: O valor para participar do jogo é de R$ 1,00, com prêmios de vários modelos.
Para o jogo, vai ser definido a data e hora do ínicio da partida, e nesse momento vai ser dado o início
do jogo, assim todos os jogadores concorrendo um contra o outro. Sendo ex

posto o prêmio
para quem concluir primeiro a meta
O jogador vai ficar na espera
Após o pagamento dos usuarios feito por PIX, eles vão jogar o jogo "Adivinha a cor" e vai acumulando pontos
até chegar em um limite definido pelo jogo, quem chegar nesse limite ganha o prêmio.

banco de dados DISPUTA

id_disputa
nome_jogo
qtd_usuario
valor_disputa
pago
ativo
data_inicio
data_termino
retorno
limite_pontos
vencedor
premio

-->

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
		<link rel="stylesheet" type="text/css" href="estiloJogos.css"/>
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
					<a style="color:white" href="index.php">VOLTAR</a>
				</div>
			</header>
			<div class="container border border-secondary mt-3 p-4">
                <div class="row">
					<div class='col text-center mt-4'>
                    	<p class="display-4">
                        	CONFIRME SUA PARTICIPAÇÃO
                    	</p>
					</div>
				</div>
                <div class="row justify-content-center">
					<div class="row flex-column m-5">
						<div class="col text-center">
							<span >ADIVINHA A COR</span>
						</div>
						<div class="col m-2">
							<img width="200px" src="../img/img_jogoAdivinha.jpg" alt="">
						</div>
            		</div>
					<div class="row">
						<div class="col m-5">
							<div><b>Data:</b> 25/05/2022 às 19h</div><br />
							<div><b>Prêmio:</b> Um cortador de unha</div><br />
							<div><b>Valor:</b> 30,00 barros</div><br />
							<div>Seja o primeiro e ganhe um lindo Cortador de unhas</div>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col mt-5 text-center">
						<button class="btn btn-success">Clique para começar</button>
					</div>
				</div>
			</div>
		</div>
	</body>
</html>