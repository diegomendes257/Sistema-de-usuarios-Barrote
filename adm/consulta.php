<?php
	include("../conexao1.php");
	require '../Usuario.php';
	$u = new Usuario();
	session_id();

	$idDebita = $_SESSION['id'];
	$adm = $_SESSION['adm'];

	$u->validaUsuario($idDebita, $adm);
?>

<!DOCTYPE html>
<html>
	<head>
		<title>Consultar dados</title>
	</head>
	<body>
		<form method="POST" action="consulta.php">
			<label>Consulte pelo Id:</label><br/><br/>
			<input type="text" name="id" placeholder="digite o id para consultar"><br><br>
			<button type="submit" name="consultar">Consultar</button>
		</form>
		<br />
		<br />

	<?php 
		if(isset($_POST['id']) && !empty($_POST['id'])){
			$id = addslashes($_POST['id']);
			$u->visualizarDados($id);
		}
	?>
	
	<div id="exibirdadosUser">
		<?php 
			$u->apertouLevou(); 
		?>
	</div>

		<hr>
		<div>
			<p><a href="painelADM.php">Voltar para inicio</a></p>
		</div>
	</body>
</html>