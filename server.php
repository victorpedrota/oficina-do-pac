<?php


$conn = mysqli_connect("localhost", "root", "","bd_do_alex");



if(isset($_POST['message']))
{
	$message = $_POST['message'];
	$cod_servico = $_POST['conversa'];
	$cod_autor = $_POST['codigo'];
	$sql = "INSERT INTO `mensagens`(`text`,`cod_servico`,`cod_autor`) VALUES ('$message','$cod_servico',$cod_autor)";
	mysqli_query($conn,$sql);
}
else if(isset($_POST['valor']) && isset($_POST['data']) && isset($_POST['detalhes'])){
	$valor = $_POST['valor'];
	$data = $_POST['data'];
	$cod_autor = $_POST['codigo'];
	$detalhes = $_POST['detalhes'];
	$cod_servico = $_POST['conversa'];
	$sql = "INSERT INTO `orcamento`(`valor`, `data`, `detalhes`) VALUES ($valor,'$data','$detalhes')";
	$query = mysqli_query($conn,$sql);
	$cod_orcamento =  mysqli_insert_id($conn);
	$sql = "INSERT INTO `mensagens`(`cod_servico`,`cod_autor`,`cod_orcamento`) VALUES ($cod_servico,$cod_autor,$cod_orcamento)";
	$query = mysqli_query($conn,$sql);

}else{
	
	$sql = "SELECT * FROM `mensagens` ORDER BY `cod_mensagem` ASC ";
	$result = mysqli_query($conn,$sql);
	$numero = mysqli_num_rows($result);
	echo '[';
	$x = 1;

	while($row = mysqli_fetch_array($result)){
	$cod_orcamento = $row['cod_orcamento'];
	$sql_orcamento = "SELECT * FROM `orcamento` WHERE `cod_orcamento` = $cod_orcamento";
	$result_orcamento = mysqli_query($conn,$sql_orcamento);
	$vetor_orcamento = mysqli_fetch_array($result_orcamento);
	$cod_servico = $row['cod_servico'];
	$sql_servico = "SELECT * FROM `servico` WHERE `cod_servico` = $cod_servico";
	$result_servico = mysqli_query($conn,$sql_servico);
	$vetor_servico = mysqli_fetch_array($result_servico);
		if ($numero != $x) {
			echo '{
				"texto": "'.$row["text"].'",
				"codigo": '.$row["cod_servico"].',
				"cod_autor": "'.$row['cod_autor'].'",
				"cod_orcamento": '.$row['cod_orcamento'].',
				"status": '.$vetor_servico['status'].',
				"orcamento": ["'.$vetor_orcamento["valor"].'","'.$vetor_orcamento["detalhes"].'","'.$vetor_orcamento["data"].'"]},';
			}
			else{
				echo '{
					"texto": "'.$row["text"].'",
					"codigo": '.$row["cod_servico"].',
					"cod_autor": "'.$row['cod_autor'].'",
					"cod_orcamento": "'.$row['cod_orcamento'].'",
					"status": '.$vetor_servico['status'].',
					"orcamento": ["'.$vetor_orcamento["valor"].'","'.$vetor_orcamento["detalhes"].'","'.$vetor_orcamento["data"].'"]}';
				}
				$x++;
			}

			echo ']';
		}

		?>