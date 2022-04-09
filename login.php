<?php
session_start();

	if(isset($_POST['email']) && !empty($_POST['email']) && isset($_POST['senha']) && !empty($_POST['senha'])){

		require "conexao1.php";
		require 'Usuario.php';

		$u = new Usuario();

		$email =	addslashes($_POST['email']);
		$senha =	addslashes($_POST['senha']);


		if($u->login($email, $senha) == true){
			if(isset($_SESSION['id'])){
				if($_SESSION['adm'] == 0){
					header("Location: inicio.php");
					$_SESSION['id'];
				}else{
					header("Location: ./adm/painelADM.php");
					$_SESSION['id'];
				}
			}else{
				header("Location: principal.php");
				$_SESSION['menError'] = "Você digitou algo errado ou o cadastro não existe, tente novamente";
			}
		}else{
			$_SESSION['menError'] = "Você digitou algo errado, tente novamente";
			header("Location: principal.php");
		}
		echo "Você digitou algo errado, tente novamente clicando aqui: "?><a href="principal.php">Voltar</a><?php
	}else{
		$_SESSION['menError'] = "Você precisa preencher os campos <b>email<b> e <b>senha<b>";
		header("Location: principal.php");
	}

?>