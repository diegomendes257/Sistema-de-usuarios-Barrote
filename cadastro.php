<?php 

if(isset($_POST['email']) && !empty($_POST['email']) && isset($_POST['senha']) && !empty($_POST['senha'])){

	require "conexao1.php";
	require 'Usuario.php';

	$u = new Usuario();

	$nome =	addslashes($_POST['nome']);
	$email =	addslashes($_POST['email']);
	$telefone =	addslashes($_POST['telefone']);
	$senha =	addslashes($_POST['senha']);

	$u->cadastrar($nome,$email,$telefone,$senha);
}
?>