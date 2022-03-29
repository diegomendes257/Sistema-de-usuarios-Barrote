<?php

	session_start();

	$localhost = "localhost";
	$user = "root";
	$pass = "";
	$banco = "testando";

		global $conexao;

		try {

			$conexao = new PDO("mysql:dbname=".$banco."; localhost=".$localhost,$user,$pass);
			$conexao->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

		} catch (Exception $e) {
			echo "Deu erro".$e->getMessage();
			exit;
		}
?>