$(document).ready(function(){
	
	let nomeCores = ['AZUL','AMARELO','VERDE','ROSA','CINZA','PRETO','BRANCO','VERMELHO'];
	var Cores = ['GRAY','WHITE','BLACK','PINK','BLUE','YELLOW','RED','GREEN'];

	var contAzul, contAmarelo, contVerde, contRosa, contCinza, contPreto, contBranco, contVermelho = 0;
	let numeroAleatorio = Math.floor(Math.random() * 8);
	let numeroAleatorio2 = Math.floor(Math.random() * 8);
	let rodadas = 1;
	var pegandoCorCss = document.getElementById('nome1');

	let erro = 0; 
	let acerto = 0;
	let pontos = 0;
	
	exibeNome(numeroAleatorio, numeroAleatorio2);

	function exibeNome(numeroAleatorio, numeroAleatorio2){
		numeroAleatorio = Math.floor(Math.random() * 8);
		numeroAleatorio2 = Math.floor(Math.random() * 8);
		pegandoCorCss = document.getElementById('nome1');
		
		var numero = numeroAleatorio;
		var numero2 = numeroAleatorio2;
		
		pegandoCorCss.style.color = Cores[numero2];
		coresNomeBack = pegandoCorCss.style.color = Cores[numero2];
		console.log(coresNomeBack);
		pegandoCorCss.innerHTML = nomeCores[numero];
		return (nomeCores[numero]);
	}


	$('#enviaResultado').click(function(){
		
		var pegandoCorCss = document.getElementById('nome1');
		pegandoCorCss.style.color;
		coresNomeBack = pegandoCorCss.style.color;
		selecao = document.querySelector('input[name=esc1]:checked').value;


		if(selecao === coresNomeBack){
			pontos = 1;
			acerto = acerto + 1;

			if(acerto <= 1){
				alert("Parabéns, você acertou! Você acertou " + acerto + " vez");
			}else{
				alert("Parabéns, você acertou! Você acertou " + acerto + " vezes");
			}
			divResultado = document.getElementById('resultado_adivinhaCor');
			divResultado.innerHTML += '<br><p><b>' + rodadas +'ª rodada:</b><br> <span style="color:green"> A cor é <b>'+ coresNomeBack + '</b>, e você ACERTOU!<br>"PARABÉNS"</span></p>'
			rodadas = rodadas + 1;

			$.ajax({
				url:'enviaBonus.php',
				type:'POST',
				data: {pontos: pontos},
				success: function(data){
					if(pontos == 1){
						alert("Você ganhou moedas");
						exibeNome(numeroAleatorio, numeroAleatorio2);
					}
				}
			});
			
		}else{
			pontos = 0;
			erro = erro + 1;

			if(erro <= 1){
				alert("Poxa, você errou! Você errou " + erro + " vez");
			}else{
				alert("Poxa, você errou! Você errou " + erro + " vezes");
			}
			
			divResultado = document.getElementById('resultado_adivinhaCor');
			divResultado.innerHTML += '<br><p><b>' + rodadas +'ª rodada:</b><br> <span style="color:red"> A cor era <b>'+ coresNomeBack + '</b>, e você chutou <b>'+ selecao + '</b><br>Infelizmente você ERROU!</span></p>';
			rodadas = rodadas + 1;

			$.ajax({
				url:'enviaBonus.php',
				type:'POST',
				data: {pontos: pontos},
				success: function(data){
					if(pontos == 0){
						alert("Você perdeu moedas!");
					}


				}
			});
		}
	});
});