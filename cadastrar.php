<?php
	include("conexao1.php");
?>

<!DOCTYPE html>
<html>
	<head>
		<title>Cadastrar</title>
	</head>
	<body>
		<h2>
			Cadastrar
		</h2>
		<form method="POST" action="cadastro.php">
			<input type="text" name="nome" placeholder="nome" maxlength="50"><br><br>
			<input type="text" name="email" placeholder="e-mail" maxlength="50"><br><br>
			<input type="text" name="telefone" placeholder="telefone" maxlength="15"><br><br>
			<input type="password" name="senha" placeholder="senha" maxlength="15"><br><br>
			<input type="password" name="confirmaSenha" placeholder="Confirmar senha"><br><br>
			<input type="submit" value="cadastrar"></input><br>
		</form>
	</body>
</html>