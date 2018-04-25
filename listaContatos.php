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

		<div id="listaContatos">

			<h2 class="text-center">Contatos cadastrados</h2>
			
			<a href="index.php"><p class="text-right">Voltar a página inicial</p></a>

			<?php

				include "conexao.php";
				
				$query = "SELECT * FROM contato ORDER BY nomecontato";	//recebendo todos os contatos e ordenando-os pelo nome
				$result = mysqli_query($con, $query);
				if($result->num_rows){	//se existem contatos
					echo "<ul id='listaUsuarios'>";
					while($row = mysqli_fetch_assoc($result)){	//percorrendo todos os contatos cadastrados
						$id = $row['idcontato'];
						$nome = $row['nomecontato'];
						$email = $row['emailcontato'];
						$telefone = $row['telefonecontato'];
						$mensagem = $row['mensagemcontato'];

						//listando todos os atributos do contato
						echo "<li>Id: $id</li>
							  <li>Nome: $nome</li>
							  <li>Email: $email</li>
							  <li>Telefone: $telefone</li>
							  <li>Mensagem: $mensagem</li>
							  <hr>";
					}
					echo "</ul>";
				}else{	//não existem contato cadastrados ainda
					echo "Nenhum contato cadastrado.";
				}

			?>
			
		</div>

    </body>
</html>