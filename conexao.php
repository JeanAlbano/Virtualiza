<?php

	$servidor = "localhost";	//(modificar de acordo com as configurações do banco de dados)
	$usuario = "root";	//(modificar de acordo com as configurações do banco de dados)
	$senha = "12345";	//(modificar de acordo com as configurações do banco de dados)
	$dbname = "virtualiza";	//(modificar de acordo com as configurações do banco de dados)
	
	//criando a conexao
	$con = mysqli_connect($servidor, $usuario, $senha, $dbname);
	mysqli_set_charset($con,"utf8");
	if (mysqli_connect_errno()){
	  echo "Failed to connect to MySQL: " . mysqli_connect_error();
	}
	
?>