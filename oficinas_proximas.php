<?php


$conn = mysqli_connect("localhost", "root", "");


// Selecionando banco
$db = mysqli_select_db($conn,"bd_do_alex") or die("Não foi possível selecionar o Banco");


	$cidade = $_POST['cidade'];
	$sql = "SELECT * FROM `oficina` WHERE `cidade` = 'São José dos Campos'";
	$result = mysqli_query($conn,$sql);
	$numero = mysqli_num_rows($result);
	
	while($row = mysqli_fetch_array($result))
	{
		echo 1;
	}
			

	

		?>