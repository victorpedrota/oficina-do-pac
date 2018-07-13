<?php
// Conexão com o banco de dados
	$conn = mysqli_connect("localhost", "root", "");
	

// Selecionando banco
	$db = mysqli_select_db($conn,"bd_do_alex") or die("Não foi possível selecionar o Banco");

?>