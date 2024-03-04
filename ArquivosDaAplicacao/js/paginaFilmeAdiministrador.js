function confirmarExclusao(codigo) {
    debugger
	var resposta = confirm('Confirma a exclusão do filme?');

	if (resposta) {		
		//realiza uma requisição remota (assíncrona) 
		$.ajax({
			url  : 'filmeExcluir.php',
			type : 'post',
			data : {
				codFilme : codigo
			}
		})
		.done(function(resultado){
			if(resultado == 1){
				alert('Filme excluído com sucesso!');
				window.location.replace('paginaInicialAdiministrador.php');
			}else{
				alert('Erro ao excluir o filme');
			}
		});  		
	}
}