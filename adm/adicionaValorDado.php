<?php 
	session_id();

	require "../conexao1.php";
    require '../Usuario.php';

	$u = new Usuario();
	$idDebita = $_SESSION['id'];
	$adm = $_SESSION['adm'];

	$u->validaUsuario($idDebita, $adm);

	if(isset($_POST['id']) && !empty($_POST['id']) && isset($_POST['valor']) && !empty($_POST['valor'])){
		
		$idValor = addslashes($_POST['id']);
		$valor = addslashes($_POST['valor']);
		$idDebita = $_SESSION['id'];

		if (is_numeric($valor) && is_numeric($idValor)){
			$u->adicionarValorDado($idValor,$valor, $idDebita);
		}else{
			echo "Digite um valor válido!";
		}
		
    }
?>
			<form method="POST" action="adicionaValorDado.php">
				<label><h3>Adicione valor ao Id:</h3></label>
				<input type="text" name="id" placeholder="digite o id"><br>
				<input type="text" name="valor" placeholder="digite o valor"><br><br>
				<button type="submit" name="enviar">Enviar valor</button>
			</form>
		<div>
			<p><a href="painelADM.php">Voltar para inicio</a></p>
		</div>
		