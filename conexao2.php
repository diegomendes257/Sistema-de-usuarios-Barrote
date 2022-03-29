<?php

	session_start();

	$localhost = "DESKTOP-F3LBL52";
	try{

		$conexao = new PDO("sqlsrv:server=$localhost;Database=testando","","");
		echo "conectado com sucesso";
		//$conexaoInfo = array("Database"=>"testando", "UID"=>"DESKTOP-F3LBL52\DIEGO MENDES", "PWD"=>"");
    	//$con = sqlsrv_connect($localhost, $conexaoInfo);
		$conexao->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

	} catch (Exception $e) {
		echo "Deu erro".$e->getMessage();
		exit;
	}
    //if($con){
    //    echo "Deu certo";
    //}else{
    //    echo "Falhou!";
    //}

        /*try {

			//$conexao = new PDO("mysql:dbname=".$banco."; localhost=".$localhost,$user,$pass);
			//$conexao->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

		} catch (Exception $e) {
			echo "Deu erro".$e->getMessage();
			exit;
		}*/
?>