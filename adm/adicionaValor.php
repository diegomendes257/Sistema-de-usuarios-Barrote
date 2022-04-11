<?php
	require "../conexao1.php";
	require '../Usuario.php';

	session_id();

	$u = new Usuario();
	$idDebita = $_SESSION['id'];
	$adm = $_SESSION['adm'];
	$u->validaUsuario($idDebita, $adm);
	
	if(isset($_POST['id']) && !empty($_POST['id']) && isset($_POST['valor']) && !empty($_POST['valor'])){

		$idValor = addslashes($_POST['id']);
		$valor = addslashes($_POST['valor']);
		$u->adicionarValor($idValor,$valor);
    }else{
		echo 'Preencha todos os campos!';
	}
?>
	<form method="POST" action="adicionaValor.php">
		<label><h3>Deposite algum valor para alguém usando o Id:</h3></label>
		<input type="text" name="id" placeholder="digite o id"><br>
		<input type="text" name="valor" placeholder="digite o valor"><br><br>
		<button type="submit" name="enviar">Enviar valor</button>
	</form>
	<div>
		<p><a href="painelADM.php">Voltar para inicio</a></p>
	</div>
<br/>
<br/>
		