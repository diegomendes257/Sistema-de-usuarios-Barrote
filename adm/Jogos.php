<?php 
	
	class Jogos{

//------------------------ADICIONA JOGO--------------------------------------------------

		public function criaJogo($nomeJogo, $valorJogo, $premio, $inicioJogo, $fimJogo, $descricao, $path_capa, $ativado, $link){
			global $conexao;

			$consulta = "SELECT nome_jogo FROM jogos_aposta WHERE nome_jogo = :nomeJogo";
			$consulta = $conexao->prepare($consulta);
			$consulta->bindValue(":nomeJogo",$nomeJogo);
			$consulta->execute();

			if($consulta->rowCount() > 0){
				$msg1 = "<p>Jogo já cadastrado!</p>";
				echo $msg1;
				return false;
			}else{
				$cadastroJogo = "INSERT INTO jogos_aposta(nome_jogo, valor_jogo, premio_jogo, inicio_jogo, fim_jogo, descricao, path_capa, ativado, link) VALUE(:nome_jogo, :valor_jogo, :premio_jogo, :inicio_jogo, :fim_jogo, :descricao, :path_capa, :ativado, :link)";
				$cadastroJogo = $conexao->prepare($cadastroJogo);
				$cadastroJogo->bindValue(":nome_jogo",$nomeJogo);
				$cadastroJogo->bindValue(":valor_jogo",$valorJogo);
				$cadastroJogo->bindValue(":premio_jogo",$premio);
				$cadastroJogo->bindValue(":inicio_jogo",$inicioJogo);
				$cadastroJogo->bindValue(":fim_jogo",$fimJogo);
				$cadastroJogo->bindValue(":descricao",$descricao);
				$cadastroJogo->bindValue(":path_capa",$path_capa);
				$cadastroJogo->bindValue(":ativado",$ativado);
				$cadastroJogo->bindValue(":link",$link);
				$cadastroJogo->execute();

				$msg2 = "<p>Jogo cadastrado com sucesso!</p><br><br>";
				echo $msg2;
				echo "<p><a href='../comercio.php'>clique aqui para ver o jogo!</a></p>";
				return true;
			}
		}




//------------------------CONSULTA JOGO--------------------------------------------------


		public function exibeJogo(){
			global $conexao;

			$exibe = 'SELECT nome_jogo, valor_jogo, inicio_jogo, path_capa, ativado, link FROM jogos_aposta';
			$exibe = $conexao->prepare($exibe);
			$exibe->execute();
			
	
			while($exibeTudo = $exibe->fetch(PDO::FETCH_ASSOC)){
				$dataCriadoJogo = date_create($exibeTudo['inicio_jogo']);
				echo "<div class='col-6 col-md-4'>
						<div class='d-flex p-2 align-items-center flex-column border rounded'>
							<img class='fotoPerfil mb-3 w-50' src='./adm/".$exibeTudo['path_capa']."' alt='Capa ".$exibeTudo['nome_jogo']."'>
							<h5 class='text-uppercase'>".$exibeTudo['nome_jogo']."</h5>
							<p class='text-center'>
								Inscrição: <b>Barro ".number_format($exibeTudo['valor_jogo'] , 2, ',',' . ')."</b><br />
								".date_format($dataCriadoJogo, 'd/m/Y').' às '.date_format($dataCriadoJogo, 'H:i')."
							</p>";
							if($exibeTudo['ativado'] == true){
								echo "<a href='".$exibeTudo['link']."' class='btn btn-primary w-75 btn-sm text-truncate'>PARTICIPAR</a>";
							}else{
								echo "<a href='".$exibeTudo['link']."' class='btn btn-danger w-75 btn-sm text-truncate disabled'>NÃO LIBERADO</a>";
							}
						echo "</div>
					</div>
				";				
			}
		} 
	}
?>

