<?php
	include("conexao1.php");
?>

<!DOCTYPE html>
<html>
	<head>
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="stylesheet" href="./css/bootstrap.min.css">
		<link rel="stylesheet" type="text/css" href="estiloSistema.css"/>
		<meta charset="utf-8">
		<title>Cadastre-se</title>
	</head>
	<body>
		<div class="box-principal">
			<h2>
				Cadastrar
			</h2>
			<form method="POST" action="cadastro.php">
				<input type="text" name="nome" placeholder="nome" maxlength="50"><br><br>
				<input type="text" name="email" placeholder="e-mail" maxlength="50"><br><br>
				<input type="text" name="telefone" placeholder="telefone" maxlength="15"><br><br>
				<input type="password" name="senha" placeholder="senha" maxlength="15"><br><br>
				<input type="password" name="confirmaSenha" placeholder="Confirmar senha"><br><br>
				<input type="submit" value="CADASTRAR"></input><br>
			</form>
		</div>
		<div>
			<br />
			<a style="font-family: arial;" href="principal.php">VOLTAR</a>
		</div>
	</body>
</html>