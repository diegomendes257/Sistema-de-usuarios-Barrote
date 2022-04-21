<?php 
	
	class Usuario{


//------------------------LOGAR--------------------------------------------------

	public function login($email, $senha){
		global $conexao;

		$consulta = "SELECT * FROM usuario WHERE email = :email AND senha = :senha";
		$consulta = $conexao->prepare($consulta);
		$consulta->bindValue(":email",$email);
		$consulta->bindValue(":senha",$senha);
		$consulta->execute();

		if($consulta->rowCount() > 0){
			$dado = $consulta->fetch();
				$_SESSION['id'] = $dado['id'];
				$_SESSION['email'] = $dado['email'];
				$_SESSION['nome'] = $dado['nome'];
				$_SESSION['telefone'] = $dado['telefone'];
				$_SESSION['saldo'] = $dado['saldo'];
				$_SESSION['adm'] = $dado['adm'];
				return true;
		}else{
			return false;
		}
	}

//------------------------CADASTRAR--------------------------------------------------

	public function cadastrar($nome,$email,$telefone,$senha){

		global $conexao;

		$consulta = "SELECT email FROM usuario WHERE email = :email";
		$consulta = $conexao->prepare($consulta);
		$consulta->bindValue(":email",$email);
		$consulta->execute();

		if($consulta->rowCount() > 0){
			$msg1 = "<p>Usuário já cadastrado!</p>";
			echo $msg1;
			return false;
		}else{
			$cadastro = "INSERT INTO usuario(nome, email, telefone, senha) VALUE(:nome,:email,:telefone,:senha)";
			$cadastro = $conexao->prepare($cadastro);
			$cadastro->bindValue(":nome",$nome);
			$cadastro->bindValue(":email",$email);
			$cadastro->bindValue(":telefone",$telefone);
			$cadastro->bindValue(":senha",$senha);
			$cadastro->execute();

			$msg2 = "<p>Usuário cadastrado com sucesso!</p><br><br>";
			echo $msg2;
			echo "<p><a href='principal.php'>clique aqui para fazer login!</a></p>";
			return true;
		}
			
	}

//------------------------ADICIONAR VALOR--------------------------------------------------

	public function adicionarValor($idValor, $valor){
		global $conexao;

		$id = $_SESSION['saldo'];
		$consulta = "SELECT id, saldo FROM usuario WHERE id = :id";
		$consulta = $conexao->prepare($consulta);
		$consulta->bindValue(":id", $idValor);
		$consulta->execute();
		$mostra = $consulta->fetch();

		if($valor > $id){
			echo 'Você não pode enviar esse valor. Saldo insuficiente!';
			return false;
		}else{
			echo 'Aguarde um instante...';

			echo '<div>Id do recebedor: '.$mostra['id'].'<br></div>';
			echo '<div>Saldo anterior do recebedor: '.number_format($mostra["saldo"], 2, ",", ".").'.<br></div>';
			$soma = $mostra['saldo'] + $valor;

			$insereValor = "UPDATE usuario set saldo = "."$soma"." WHERE id = :id";
			$insereValor = $conexao->prepare($insereValor);
			$insereValor->bindValue(":id",$idValor);
			$insereValor->execute();

			$consulta->execute();
			$mostra = $consulta->fetch();
			echo 'Seu saldo atual: '.number_format($mostra["saldo"], 2, ",", ".").'.';
			unset($insereValor); //fecha a consulta
			return true;
		}
			
	}

//------------------------ADICIONAR VALOR E DEBITA DO OUTRO--------------------------------------------------

	public function adicionarValorDado($idValor, $valor, $idDebita){
		global $conexao;
			
		//--------consulta os dados do recebedor
			
		$consulta = "SELECT id, saldo FROM usuario WHERE id = :id";
		$consulta = $conexao->prepare($consulta);
		$consulta->bindValue(":id", $idValor);
		$consulta->execute();
		$mostra = $consulta->fetch();
		echo '<div>Id do recebedor: '.$mostra['id'].'<br></div>';
		echo '<div>Saldo anterior do recebedor: <b>'.$mostra['saldo'].'</b><br></div>';
		$soma = $mostra['saldo'] + $valor;

		$consultaId = "SELECT id, saldo FROM usuario WHERE id = :id";
		$consultaId = $conexao->prepare($consultaId);
		$consultaId->bindValue(":id", $idDebita);
		$consultaId->execute();
		$mostra2 = $consultaId->fetch();

		if($valor > $mostra2['saldo']){
			echo 'Você não pode enviar esse valor. Saldo insuficiente!';
			return false;
		}else{
			//---------insere o valor na conta do recebedor
			$insereValor = "UPDATE usuario set saldo = "."$soma"." WHERE id = :id";
			$insereValor = $conexao->prepare($insereValor);
			$insereValor->bindValue(":id",$idValor);
			$insereValor->execute();

			//--------consulta os dados do pagador /////////////////////////////////////////////////
			$consulta1 = "SELECT id, saldo FROM usuario WHERE id = :id";
			$consulta1 = $conexao->prepare($consulta1);
			$consulta1->bindValue(":id", $idDebita);
			$consulta1->execute();
			$mostra1 = $consulta1->fetch();
			echo '<br /><div>Seu Id: '.$mostra1['id'].'<br></div>';
			echo '<div>Seu saldo anterior: <b>'.$mostra1['saldo'].'</b><br></div><br />';
			$debita = $mostra1['saldo'] - $valor;

			//---------atualiza (retira) o valor da conta do pagador /////////////////////////////////////////////////
			$retiraValor = "UPDATE usuario set saldo = "."$debita"." WHERE id = :id";
			$retiraValor = $conexao->prepare($retiraValor);
			$retiraValor->bindValue(":id",$idDebita);
			$retiraValor->execute();

			//---------consulta os valores das duas contas (recebedor e pagador) ///////////////////////////////////////////////// 
				$consulta1->execute();
				$mostra1 = $consulta1->fetch();
				$consulta->execute();
				$mostra = $consulta->fetch();
				echo '<div>Saldo atual do recebedor: <b>'.$mostra['saldo'].'</b></div><br/>';
				echo 'Seu saldo atual: <b>'.$mostra1['saldo'].'</b>';
				unset($insereValor); //fecha a consulta
				return true;
			}
		}

//------------------------VISUALIZAR DADOS--------------------------------------------------

	public function visualizarDados($id){
		global $conexao;
			
		$consulta = "SELECT id, nome, saldo, email FROM usuario WHERE id = :id";
		$consulta = $conexao->prepare($consulta);
		$consulta->bindValue(":id",$id);
		$consulta->execute();
		$mostra = $consulta->fetch();

		$idDebita = $_SESSION['id'];

		$nConsulta = "SELECT id, nome, saldo, email FROM usuario WHERE id = :id";
		$nConsulta = $conexao->prepare($nConsulta);
		$nConsulta->bindValue(":id",$idDebita);
		$nConsulta->execute();
		$mostra1 = $nConsulta->fetch();

		if(!isset($mostra['id'])){
			echo "<div>Esse conta não existe, infelizmente, tente novamente!</div>";
			return false;
		}else{
			$pega = number_format($mostra1['saldo'], 2, ',', '.');
			$pega1 = number_format($mostra1['saldo'], 2, ',', '.');
			echo "<h2>Seus dados: </h2>";
			echo "<div>Seu Id: ".$mostra1['id']."<br></div>";
			echo "<div>Seu nome: ".$mostra1['nome']."<br></div>";
			//echo "<div>Seu saldo atual: ".$mostra1['saldo']."</div>";
			echo "<div>Seu saldo atual: R$ ".$pega."</div>";
			echo "<h2>Você está consultando: </h2>";
			echo "<div>Id: ".$id."<br></div>";
			echo "<div>Nome: ".$mostra['nome']."<br></div>";
			echo "<div>E-mail: ".$mostra['email']."</div>";
			echo "<div>Saldo: R$ ".$mostra['saldo']."</div><br />";
			echo "<br /><b>MENSAGEM PARA VOCÊ!</b>";
			return true;
		}
		//unset($consulta); //fecha a consulta
	}

//------------------------VISUALIZAR DADOS--------------------------------------------------

	public function apertouLevou(){
		
		global $conexao;

		$id = $_SESSION['id'];

		$mensagemRefValor = "SELECT saldo FROM usuario WHERE id = :id";
		$mensagemRefValor = $conexao->prepare($mensagemRefValor);
		$mensagemRefValor->bindValue(":id", $id);
		$mensagemRefValor->execute();

		$saldo = $mensagemRefValor->fetch();

		if($saldo['saldo'] < 50){
			echo 'Você está precisando acumular mais!';
		}else{
			echo 'Você está indo bem, continue! <br />Seu saldo é: R$ <b>'.$saldo['saldo'].'</b>';
		}
	}

//------------------------VALIDA DADOS ADM OU USUARIO--------------------------------------------------

	public function validaUsuario($id, $adm){
		if($adm == 0){
			unset($adm);
			session_destroy();
			header('Location: ../principal.php');
		}
	}

//------------------------ ALTERA TABELA JOGO --------------------------------------------------

	/* TABELA JOGO SELECIONA */

//------------------------Adiciona pontos jogo ----------------------------------------
		/*public function adicionarValorJogo($id, $ganhou){
			global $conexao;
	
			//$id = $_SESSION['id'];
			$consulta = "SELECT id, saldo FROM usuario WHERE id = :id";
			$consulta = $conexao->prepare($consulta);
			$consulta->bindValue(":id", $id);
			$consulta->execute();
			$mostra = $consulta->fetch();
	
			$soma = $mostra['saldo'] + $ganhou;
	
			$insereValor = "UPDATE usuario set saldo = "."$soma"." WHERE id = :id";
			$insereValor = $conexao->prepare($insereValor);
			$insereValor->bindValue(":id",$id);
			$insereValor->execute();
	
			$consulta->execute();
			$mostra = $consulta->fetch();
			return true;
		}*/
	}
?>