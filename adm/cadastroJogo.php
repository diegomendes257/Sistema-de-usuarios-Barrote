<?php
	include("../conexao1.php");

	$idDebita = $_SESSION['id_usuario'];
	$adm = $_SESSION['adm'];

	$consulta1 = "SELECT id_usuario, saldo, nome, adm FROM usuario WHERE id_usuario = :id";
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
						if(!isset($_SESSION['id_usuario']))
							header('Location: principal.php');
						
						if(isset($_GET['sair'])){
							unset($_SESSION['id_usuario']);
							header('Location: principal.php');
						}
					?>
					<div class="col-3" id="botaoVoltar">
				        <a href="javascript:void(0)" onClick="history.go(-1); return false;">Voltar</a>
				    </div>
				</div>
			</header>
			<nav class="nav p-1 mb-2" style='text-align:center'>
				<a href="consulta.php">Clique para consultar!</a> - /
				<a href="adicionaValor.php">Clique para creditar dinheiro para alguém!</a> - /
				<a href="adicionaValorDado.php">Clique para creditar e ser debitado!</a> - /
				<a href="formImagem.php">Carregar imagem!</a>
			</nav>
			<div class="container p-1 pt-3 pb-5 w-50">
                <form method="POST" action="inserirJogo.php" enctype="multipart/form-data" name="CadastraJogo">
                    <input type="text" name="nomeJogo" placeholder="Nome do jogo"/>
                    <input type="number" name="valorJogo" placeholder="valor do jogo"/>
                    <input type="text" name="premioJogo" placeholder="Prêmio"/>
                    <input type="date" name="dataInicio"/>
                    <input type="time" name="hora-inicio">
                    <input type="date" name="dataFim"/></br>
					<label>Ativado<input type="radio" name="ativo" value="1"/></label>
					<label>Desativado<input type="radio" name="ativo" value="0"/></label>
                    <input type="textArea" name="descricaoJogo" placeholder="Descrição do jogo"/>
					<input type="text" name="link" placeholder="Link do jogo"/>
                    <input type="file" name="foto"/><br />
                    <input type="submit" class="btn btn-primary text-dark" value="Cadastrar Jogo"/>
                </form>
			</div>
		</div>
	</body>
</html>