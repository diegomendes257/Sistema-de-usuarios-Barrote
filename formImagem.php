<?php 
include "conexao1.php";
require 'Imagem.php';
global $conexao;
session_id();

$i = new Imagem();

//var_dump($_FILES);
$id_usuario = $_SESSION['id_usuario'];

$i->insereImagem($id_usuario);
?>

<!DOCTYPE html>
<html>
	<head>
        <title>BARROTÉ - CADASTRAR IMAGENS NA GALERIA</title>
		<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
		<script type="text/javascript" src="logic.js"></script>
        <link rel="stylesheet" type="text/css" href="estiloImagem.css"/>
	</head>
	<body>
        <div class="container-fluid">
            <div class="container-fluid">
                <div class="row text-center">
                    <div class="col p-4">
                        <h2 class="h2">
                            Cadastre sua imagem
                        </h2>    
                    </div>
                </div>
                <div class="row d-flex justify-content-center">
                    <div class="col-9 col-lg-7 shadow p-3 mb-4 bg-white rounded text-center">
                        <div class="p-2 pt-4 p-md-4">
                            <form method="POST" action="" class="form-group" enctype="multipart/form-data" name="cadastroImg">
                                <input type="file" id="botaoEscolher" class="form-control-file" name="foto" /><br />
                                <div class="mensagem">
                                    <div class="alert alert-warning" role="alert">
                                        Sua foto foi carregada, CLIQUE EM ENVIAR 
                                    </div>
                                </div>
                                <input type="submit" class="btn btn-primary w-50 text-center" name="cadastrarImagem" value="CADASTRAR" />
                                <br>
                            </form>
                        </div> 
                    </div>
                    <div class="col-12 text-center mb-5 msg">
                        <p>
                            **Todas as fotos carregadas aqui são protegidas e nenhum usuário além de você podem ver essas fotos.
                        </p>
                    </div>
                </div>
                <div class="col-12 col-lg-3 shadow p-3 mb-4 bg-white rounded text-center">
                    <h5>
                    <b>Acessar suas fotos!!!</b>
                    </h5>
                    <p>Quer ver quais fotos já foram carregadas?</p>
                    <a class="btn btn-success w-100" href="mostrarFotos.php">VER GALERIA</a><br /><br />
                </div>
                <div class="container-fluid text-center mt-3 mb-5">
                    <a class="btn btn-danger w-md-100" href="inicio.php">VOLTAR</a>
                </div>
            </div>
        </div>     
	</body>
</html>