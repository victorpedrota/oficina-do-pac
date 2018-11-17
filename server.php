<?php


$conn = mysqli_connect("localhost", "root", "","bd_do_alex");



if(isset($_POST['message']))
{
	$message = $_POST['message'];
	if ($message == "") {
		
	}

	else

	{

		$cod_servico = $_POST['conversa'];
		$cod_autor = $_POST['codigo'];
		$sql = "INSERT INTO `mensagens`(`text`,`cod_servico`,`cod_autor`) VALUES ('$message',$cod_servico,$cod_autor)";
		$query = mysqli_query($conn,$sql);

	}
}
else if(isset($_POST['cliente'])){
	
	$cliente = $_POST['cliente'];
	$sql_foto = "SELECT * FROM `servico` WHERE `cod_cliente` = $cliente";
	$query_foto = mysqli_query($conn,$sql_foto);
	$numero = mysqli_num_rows($query_foto);
	$x =1;
	
	echo "[";
	while($vetor_servico = mysqli_fetch_array($query_foto)){
	$cod_oficina = $vetor_servico['cod_oficina'];
	$sql_oficina = "SELECT * FROM `oficina` WHERE `cod_oficina` = $cod_oficina ORDER BY `cod_oficina` DESC";
	$query_oficina = mysqli_query($conn,$sql_oficina);
	$vetor_oficina = mysqli_fetch_array($query_oficina);
	$cod_login = $vetor_oficina['cod_login'];
	$sql_login = "SELECT * FROM `login` WHERE `cod_login` = $cod_login";
	$query_login = mysqli_query($conn,$sql_login);
	$vetor_login = mysqli_fetch_array($query_login);

		if ($numero != $x) {

			echo '{ "cod":"'.$vetor_servico['cod_servico'].'", "visto": "'.$vetor_servico['mostra'].'","img":"'.$vetor_login['imagem'].'","nome": "'.$vetor_oficina['nome'].'","serv":"'.$vetor_servico['servico_desejado'].'","status":"'.$vetor_servico['status'].'"},' ;

		}
		else{
			echo '{ "cod":"'.$vetor_servico['cod_servico'].'", "visto": "'.$vetor_servico['mostra'].'","img":"'.$vetor_login['imagem'].'","nome":"'.$vetor_oficina['nome'].'","serv": "'.$vetor_servico['servico_desejado'].'","status":"'.$vetor_servico['status'].'"}' ;
		}
		$x++;
	}
	echo "]";



	
}
else if (isset($_POST['visto'])) {

	$cod = $_POST['visto'];
	$sql = "UPDATE `servico` SET `mostra`= 1 WHERE `cod_servico` = $cod";
	$query = mysqli_query($conn,$sql);
}
else if(isset($_POST['valor'])){

	$valor = $_POST['valor'];
	$data = $_POST['data'];
	$cod_autor = $_POST['codigo'];
	$detalhes = $_POST['detalhes'];
	$cod_servico = $_POST['conversa'];
	$sql = "UPDATE `orcamento` SET `status`= 0 WHERE `status` = 1 && `cod_servico` = $cod_servico && `status` != 2";
	$query = mysqli_query($conn,$sql);
	$sql = "INSERT INTO `orcamento`(`valor`, `data`, `detalhes`,`status`,`cod_servico`) VALUES ($valor,'$data','$detalhes',1,$cod_servico)";
	$query = mysqli_query($conn,$sql);
	$cod_orcamento =  mysqli_insert_id($conn);

	$sql = "INSERT INTO `mensagens`(`cod_servico`,`cod_autor`,`cod_orcamento`) VALUES ($cod_servico,$cod_autor,$cod_orcamento)";
	$query = mysqli_query($conn,$sql);

}
else if(isset($_POST['codigo'])){

	
	$codigo = $_POST['codigo'];
	$tipo = $_POST['tipo'];
	$sql = "SELECT * FROM `servico` WHERE `cod_servico` = $codigo";
	$query = mysqli_query($conn,$sql);
	$vetor_cliente = mysqli_fetch_array($query);
	if ($tipo == "cliente") {
		$cod_cliente = $vetor_cliente['cod_mecanico'];
		$sql_cliente = "SELECT * FROM `mecanico` WHERE `cod_mecanico` = $cod_cliente";

		$query_cliente = mysqli_query($conn,$sql_cliente);
		if (mysqli_num_rows($query_cliente) !=0) {

			$vetor = mysqli_fetch_array($query_cliente);
			$cod_login = $vetor['cod_login'];
		}
		else{
			echo "erro";
		}
		
	}else{
		$cod_cliente = $vetor_cliente['cod_cliente'];
		$sql_cliente = "SELECT * FROM `cliente` WHERE `cod_cliente` = $cod_cliente";
		$query_cliente = mysqli_query($conn,$sql_cliente);
		if (mysqli_num_rows($query_cliente) !=0) {

			$vetor = mysqli_fetch_array($query_cliente);
			$cod_login = $vetor['cod_login'];
		}
		else{
			echo "erro";
		}
	}
	
	$sql_foto = "SELECT * FROM `login` WHERE `cod_login` = $cod_login";
	$query_foto = mysqli_query($conn,$sql_foto);
	$vetor_foto = mysqli_fetch_array($query_foto);

	
	echo $vetor_foto['imagem'];


}
else if(isset($_POST['nota'])){

	$nota = $_POST['nota'];
	$tipo = $_POST['tipo'];
	$cod_servico = $_POST['cod'];
	$excluido = $_POST['excluido'];
	if ($excluido ==1 ) {
		$sql_cliente = "DELETE FROM `avaliacao` WHERE `cod_servico` = $cod_servico";
		$query_cliente = mysqli_query($conn,$sql_cliente);
	}else{
		$sql = "SELECT * FROM `avaliacao` WHERE `cod_servico` = $cod_servico";
		$query = mysqli_query($conn,$sql);
		$numero = mysqli_num_rows($query);
		if ($numero == 0) {
			if ($tipo=="cliente") {
				$sql_cliente = "INSERT INTO `avaliacao`(`cod_servico`, `nota_usuario`) VALUES ($cod_servico,$nota)";
				$query_cliente = mysqli_query($conn,$sql_cliente);
			}else{
				$sql_cliente = "INSERT INTO `avaliacao`(`cod_servico`, `nota_mecanico`) VALUES ($cod_servico,$nota)";
				$query_cliente = mysqli_query($conn,$sql_cliente);
			}
		}else{
			if ($tipo=="cliente") {
				$sql_cliente = "UPDATE `avaliacao` SET `nota_usuario`=$nota WHERE `cod_servico` = $cod_servico";
				$query_cliente = mysqli_query($conn,$sql_cliente);
			}else{
				$sql_cliente = "UPDATE `avaliacao` SET `nota_mecanico`=$nota WHERE `cod_servico` = $cod_servico";
				$query_cliente = mysqli_query($conn,$sql_cliente);
			}
		}
	}
	
	


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
				"orcamento": ["'.$vetor_orcamento["valor"].'","'.$vetor_orcamento["detalhes"].'","'.$vetor_orcamento["data"].'","'.$vetor_orcamento["status"].'","'.$vetor_servico['mostra'].'"]},';
			}
			else{
				echo '{
					"texto": "'.$row["text"].'",
					"codigo": '.$row["cod_servico"].',
					"cod_autor": "'.$row['cod_autor'].'",
					"cod_orcamento": "'.$row['cod_orcamento'].'",
					"status": '.$vetor_servico['status'].',
					"orcamento": ["'.$vetor_orcamento["valor"].'","'.$vetor_orcamento["detalhes"].'","'.$vetor_orcamento["data"].'","'.$vetor_orcamento["status"].'"]}';
				}
				$x++;
			}

			echo ']';
		}

		?>