<?php 

if(isset($_POST['email']) && !empty($_POST['email']) && isset($_POST['senha']) && !empty($_POST['senha'])){

	require "conexao1.php";
	require 'Usuario.php';

	$u = new Usuario();

	$nome =	filter_input(INPUT_POST, "nome", FILTER_DEFAULT);
	$email =	filter_input(INPUT_POST, "email", FILTER_VALIDATE_EMAIL);
	$telefone =	filter_input(INPUT_POST, "telefone", FILTER_DEFAULT);
	$senha =	filter_input(INPUT_POST, "senha", FILTER_DEFAULT);

	$u->cadastrar($nome,$email,$telefone,$senha);
}
?>