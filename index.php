<!DOCTYPE html>
<html lang="pt-br" class="no-js">
    <head>

        <meta charset="utf-8">
	    <meta http-equiv="X-UA-Compatible" content="IE=edge">
	    <meta name="viewport" content="width=device-width, initial-scale=1">
		<meta name="author" content="Jean Albano">
		<meta http-equiv="content-language" content="pt-br">
		<meta name="description" content="Teste prático da Virtualiza para desenvolver o front e back-end de um formulário">
	    <title>Virtualiza</title>

	    <!-- Bootstrap -->
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css">
		<link rel="stylesheet" href="css/bootstrap.css">
        <!-- Bootstrap -->
		<link href="css/style.css" rel="stylesheet">

		<!-- JQuery -->
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js"></script>
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js"></script>
		<!-- JQuery -->

    </head>
	 
    <body>
		
		<a href="listaContatos.php"><button class="btn-contatos text-right" type="button">Mostrar dados salvos no banco</button></a>

		<!-- Formulário de contato -->
		<div class="container-fluid">
			<div class="col-md-6 col-md-offset-3">

				<p id="tituloContato" class="text-center">CONTATO</p>

				<h1 class="text-center">Fale conosco</h1>

				<form id="formContato">
					<div class="form-group">
						<div class="col-md-12">
							<input type="text" class="form-control" placeholder="Nome*: escreva seu nome" name="nome" maxlength="95" required oninvalid="this.setCustomValidity('Informe seu nome completo!')" onchange="this.setCustomValidity('')">
							<div class="help-block"></div>
						</div>
					</div>
					
					<div class="form-group">	
						<div class="col-md-12">
							<input type="email" class="form-control" placeholder="Email*: contato@cliente.com.br" name="email" maxlength="45" required oninvalid="this.setCustomValidity('Informe um e-mail válido!')" onchange="this.setCustomValidity('')">
							<div class="help-block"></div>
						</div>
					</div>

					<div class="form-group">	
						<div class="col-md-12">
							<input type="text" class="form-control" placeholder="Telefone: (48) 3432-0029" name="telefone" maxlength="15">
							<div class="help-block"></div>
						</div>				
					</div>

					<div class="form-group">
						<div class="col-md-12">
							<textarea type="text" class="form-control" placeholder="Mensagem*: escreva sua mensagem" name="mensagem" maxlength="500" required oninvalid="this.setCustomValidity('Informe sua mensagem!')" onchange="this.setCustomValidity('')"></textarea>
							<div class="help-block"></div>
						</div>
					</div>

					<p>Campos com * são obrigatórios.</p>

					<div class="form-group">	
						<div class="col-md-12">
							<button type="submit" class="btn btn-primary btn-enviar">Enviar</button>
						</div>
					</div>
				</form>

			</div>	
		</div>
		<!-- Formulário de contato -->

		<!-- plugin para utilizar mascara nos números de telefone -->
		<script type="text/javascript" src="jQueryMaskPlugin/jquery.mask.min.js"></script>	
		<!-- plugin para utilizar mascara nos números de telefone -->
		
		<script>
			//função para validar o telefone.
			function validaNumero(tel){
				exp = /^\([1-9]{2}\) [2-9][0-9]{3}\-[0-9]{4}|(^\([1-9]{2}\) [2-9][0-9]{4}\-[0-9]{4})$/;	//expresão regular para (xx) xxxx-xxxx ou (xx) xxxxx-xxxx
				if(!exp.test(tel)){	//inválido
					return false;
				}else{	//válido
					return true;	
				}
			}

			$(document).ready(function(){
				//mascara para os números de telefone
				$("input[name=telefone]").mask("(00) 0000-00009");
				$("input[name=telefone]").blur(function(event) {
				   if($(this).val().length == 15){ // Celular com 9 dígitos + 2 dígitos DDD e 4 da máscara
					  $("input[name=telefone]").mask('(00) 00000-0009');
				   } else {
					  $("input[name=telefone]").mask('(00) 0000-00009');
				   }
				});

				$("#formContato").submit(function(e){	//validação do formulário de contato
					e.preventDefault();	//para evitar o submit do formulário
					var erro = 0;	//variavel para confirmar que não houve nenhum erro
					
					//campos obrigatorios
					var nome = $("input[name=nome]").val();
					var email = $("input[name=email]").val();
					var mensagem = $("textarea[name=mensagem]").val();

					//validação do nome
					if(nome.trim().length){		//verifica se não existem apenas espaços em branco
						$("input[name=nome]").parent().removeClass("has-error");	//removendo o erro se houver
						$("input[name=nome]").next().hide();
					}else{
						$("input[name=nome]").parent().addClass("has-error");
						$("input[name=nome]").next().show().html("Nome inválido!");	//informando o erro
						erro++;
					}

					//campo opcional
					var telefone = $("input[name=telefone]").val();

					//validação do telefone caso tenha sido informado
					if(telefone.trim().length){	//verifica se o campo esta preenchido
						if(!validaNumero(telefone)){	//telefone inválido
							$("input[name=telefone]").parent().addClass("has-error");
							$("input[name=telefone]").next().show().html("Telefone inválido!");	//informando o erro
							erro++;
						}else{
							$("input[name=telefone]").parent().removeClass("has-error");	//removendo o erro se houver
							$("input[name=telefone]").next().hide();
						}	
					}

					//se não houve nenhum erro nos inputs
					if(erro == 0){
						$.ajax({	//envia para página PHP que inserira os dados no banco de dados
							url: "insereContato.php",
							method: "POST",
							data:  { nome: nome, email: email, mensagem: mensagem, telefone: telefone},
							success: function(res){	//contato registrado
								if(res == 1){
									$("#formContato").html("<h4 class='alert alert-success'>Mensagem enviada.</h4>");
								}else{	//contato não registrado
									$("#formContato").html("<h4 class='alert alert-danger'>Mensagem não pode ser enviada.</h4>");
								}
							}
						});		
					}
				});	
			});
		</script>
		
		<!-- Rodape -->
		<div id="footer">
			<div class="left">Copyright 2016</div>
			<div class="right">Virtualiza</div>
		</div>
		<!-- Rodape -->

	</body>
</html>