<?php


$conn = mysqli_connect("localhost", "root", "","bd_do_alex");



	

	
    $data = $_POST['data'];
    $cod_servico = $_POST['cod_servico'];
    $cod_orcamento = $_POST['cod_orcamento'];
    $sql = "SELECT * FROM `servico` WHERE `cod_servico` = $cod_servico";
	$query = mysqli_query($conn,$sql);
	$vetor = mysqli_fetch_array($query);
	if ($vetor['status'] >= 2) {
		# code...
	}
	else{
		$sql = "UPDATE `servico` SET `status`= 2, `mostra` = 0 WHERE `cod_servico` = $cod_servico";
	mysqli_query($conn,$sql);
	}
	
	$sql = "UPDATE `orcamento` SET `status`= 2 WHERE `cod_orcamento` = $cod_orcamento";
	mysqli_query($conn,$sql);


		?>