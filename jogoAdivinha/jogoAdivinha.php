<?php 
	include("../conexao1.php");

	$idDebita = $_SESSION['id_usuario'];
	$consulta1 = "SELECT id_usuario, saldo, nome FROM usuario WHERE id_usuario = :id";
	$consulta1 = $conexao->prepare($consulta1);
	$consulta1->bindValue(":id", $idDebita);
	$consulta1->execute();
	$mostra1 = $consulta1->fetch();
	
?>

<!DOCTYPE html>
<html>
	<head>
		<title>BARROTÉ - Decora Cor - JOGO</title>
		<link rel="stylesheet" type="text/css" href="estiloAdivinha.css"/>
		<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
		<script type="text/javascript" src="adivinhaCor.js"></script>
	</head>
	<body>
		<header id="topo_adivinha" class="container-fluid text-center">		
			<div class="topoInterno">
					<!-- DIV TOPO HEADER -->
				<div class="col" id="logo">
					<h2>BARROTÉ</h2>
				</div>
				<div class="col-3 nome-valor">
					<span class="nome-Saldo">Barro &nbsp</span>
					<div class='valorExibe'>
						
					</div>
				</div>
				<div class="col-3" id="botaoVoltar">
				<a href="javascript:void(0)" onClick="history.go(-1); return false;">Voltar</a>
				</div>
			</div>
		</header>
		<section class="container-fluid" id="secao1">
			<div class="container-fluid" id="divJogoPrincipal">									<!-- DIV JOGO PRINCIPAL -->
				<div id="fundo">
					<div class="container-fluid text-center" id="divInternaTitulo">
						<span>ADIVINHE A COR DA LETRA!</span>
					</div>
					<div class="container text-center" id="divInternaDescricao">
						<p>Abaixo vai aparecer o nome de algumas cores com a fonte pintada de uma cor, diga abaixo qual é a cor da fonte</p>
					</div>	
					<div class="container mb-4 text-center" id="nome1">
						<script>
								//exibeNome(numeroAleatorio, numeroAleatorio2);					 
						</script>
					</div>
					<div class="container-fluid text-center" id="divFooterJogo">
						<h2>
							<strong>Qual a cor da fonte?</strong>
						</h2>
						<br>
						
						<div class="form-check form-check-inline">
							<input class="form-check-input" type="radio" name="esc1" id="inlineRadio1" value="green" />
							<label class="form-check-label" for="Verde">Verde</label>
						</div>
						<div class="form-check form-check-inline">
							<input class="form-check-input" type="radio" name="esc1" id="inlineRadio2" value="gray" />
							<label class="form-check-label" for="Cinza">Cinza</label>
						</div>
						<div class="form-check form-check-inline">
							<input class="form-check-input" type="radio" name="esc1" id="inlineRadio3" value="red" />
							<label class="form-check-label" for="Vermelho">Vermelho</label>
						</div>
						<div class="form-check form-check-inline">
							<input class="form-check-input" type="radio" name="esc1" id="inlineRadio3" value="yellow" />
							<label class="form-check-label" for="Amarelo">Amarelo</label>
						</div>
						<div class="form-check form-check-inline">
							<input class="form-check-input" type="radio" name="esc1" id="inlineRadio3" value="pink" />
							<label class="form-check-label" for="Rosa">Rosa</label>
						</div>
						<div class="form-check form-check-inline">
							<input class="form-check-input" type="radio" name="esc1" id="inlineRadio3" value="black" />
							<label class="form-check-label" for="Preto">Preto</label>
						</div>
						<div class="form-check form-check-inline">
							<input class="form-check-input" type="radio" name="esc1" id="inlineRadio3" value="white" />
							<label class="form-check-label" for="Branco">Branco</label>
						</div>
						<div class="form-check form-check-inline">
							<input class="form-check-input" type="radio" name="esc1" id="inlineRadio3" value="blue" />
							<label class="form-check-label" for="Azul">Azul</label>
						</div>
						<!-- -----------------------SUBSTITUIDO PELO BOOTSTRAP ACIMA -------------->
						<!--<form class="form-group" id="form_jogo">
							<input type="radio" id="pega" class="radio" name="esc1" value="green"><label>Verde</label></input>
							<br>
							<input type="radio" class="radio" name="esc1" value='gray'><label>Cinza</label></input>
							
							<input type="radio" class="radio" name="esc1" value="red"></input>
							<label>Vermelho</label>
							<input type="radio" class="radio" name="esc1" value="yellow"></input>
							<label>Amarelo</label>
							<input type="radio" class="radio" name="esc1" value="pink"></input>
							<label>Rosa</label>
							<input type="radio" class="radio" name="esc1" value="black"></input>
							<label>Preto</label>
							<input type="radio" class="radio" name="esc1" value="white"></input>
							<label>Branco</label>
							<input type="radio" class="radio" name="esc1" value="blue"></input>
							<label>Azul</label>
						</form> -->
						<div class="footer_adivinha">
							<div class="container-fluid p-2 mt-2">
								<button id="enviaResultado" class="enviar_Adivinha" value="enviar">ENVIAR RESPOSTA</button>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div>							<!-- DIV RESULTADO -->
				<div class="container-fluid" id="container_meioPrincipal">
					<div id="resultado_adivinhaCor" class="container-fluid">
						<p class="text-center"><b>O resultado vai ser mostrado aqui: </b></p>
						<div>
							
						</div>
					</div>
				</div>
			</div>
		</section>
	</body>
</html>