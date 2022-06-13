<?php
	session_start();
?>

<!DOCTYPE html>
<html lang="pt-br">
	<head>
		<title>Barroté</title>
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="stylesheet" href="./css/bootstrap.min.css">
		<link rel="stylesheet" type="text/css" href="estiloSistema.css"/>
		<meta charset="utf-8">
	</head>
	<body>
		<div class="box-principal">
			<h2>BARROTÉ</h2>
			<hr>
			<form method="POST" action="login.php"><br>
				<input type="email" name="email" placeholder="e-mail"><br><br>
				<input type="password" name="senha" placeholder="senha"><br><br>
				<input type="submit" value="ENTRAR"></input><br><br>
				<span>Esqueceu a senha? <a href="cadastrar.php"><strong>Clique aqui!</strong></a></span>
			</form>
		</div>
		<div class="menError" style="width: 315px; height: 20px; padding-top: 5px; border: none; text-align: center;">
			<?php
				if(isset($_SESSION['menError'])){
					echo $_SESSION['menError'];
					unset($_SESSION['menError']);
				}
			?>
		</div>
		<div class="box-link-cadastrar">
			<span>Ainda não é inscrito?</span><br>
			<a href="cadastrar.php"><strong>CADASTRE-SE!</strong></a></span>
		</div>
	</body>
</html>