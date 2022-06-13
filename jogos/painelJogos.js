$(document).ready(function(){
    $('#botaoCadastroJogo').click(function(){
		//validações para comparar valor de saldo com valor do ingresso
        //se ainda existe a rodada ou o prêmio

        var texto = 'Diego';
        let number = 1;

        $.ajax({
            url:'ingressoUsuario.php',
            type:'POST',
            data:{
                
            },
            success: function(data){

            }
        });
	});
});