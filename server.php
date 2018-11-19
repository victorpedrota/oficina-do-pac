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
		$cod_destinatario = $_POST['cod_destinatario'];
		$sql = "INSERT INTO `mensagens`(`text`,`cod_servico`,`cod_autor`,`cod_destinatario`,`mostra`) VALUES ('$message',$cod_servico,$cod_autor,$cod_destinatario,0)";
		$query = mysqli_query($conn,$sql);

	}
}
else if (isset($_POST['nav'])) {
	$nav = $_POST['nav'];
	$cod_cliente = $_POST['cod_cliente'];
	if ($nav==1) {
		$sql= "SELECT * FROM `servico` WHERE `status`!=0 && `cod_cliente` = $cod_cliente && `mostra` = 0 ";
		$query = mysqli_query($conn,$sql);
		$numero = mysqli_num_rows($query);
		if ($numero != 0) {
			echo 1;
		}
	}
}
else if (isset($_POST['msg'])) {
	$msg = $_POST['msg'];
	$cod_cliente = $_POST['cod_cliente'];
	if ($msg==1) {
		$sql= "SELECT * FROM `mensagens` WHERE `cod_destinatario` = $cod_cliente && `mostra` = 0";
		$query = mysqli_query($conn,$sql);
		$numero = mysqli_num_rows($query);
		if ($numero != 0) {
			echo 1;
		}
	}
}
else if(isset($_POST['seemsg'])){
	
	$cliente = $_POST['seemsg'];
	$tipo = $_POST['tipo'];
	$sql_foto = "SELECT * FROM `mensagens` WHERE `cod_destinatario` = $cliente";
	$query_foto = mysqli_query($conn,$sql_foto);
	$numero = mysqli_num_rows($query_foto);
	$x =1;
	
	echo "[";
	while($vetor_servico = mysqli_fetch_array($query_foto)){
		$cod_mecanico = $vetor_servico['cod_autor'];
		if ($tipo == "mecanico") {
			$sql = "SELECT * FROM `cliente` WHERE `cod_login` = $cod_mecanico";
		} else{
			$sql = "SELECT * FROM `mecanico` WHERE `cod_login` = $cod_mecanico";
		}
		
		$query = mysqli_query($conn,$sql);
		$vetor_mecanico = mysqli_fetch_array($query);
		$sql_login = "SELECT * FROM `login` WHERE `cod_login` = $cod_mecanico";
		$query_login = mysqli_query($conn,$sql_login);
		$vetor_login = mysqli_fetch_array($query_login);

		if ($numero != $x) {

			echo '{ "cod":"'.$vetor_servico['cod_destinatario'].'", "visto": "'.$vetor_servico['mostra'].'","img":"'.$vetor_login['imagem'].'","nome": "'.$vetor_mecanico['nome'].'","msg":"'.$vetor_servico['text'].'"},' ;

		}
		else{
			echo '{ "cod":"'.$vetor_servico['cod_destinatario'].'", "visto": "'.$vetor_servico['mostra'].'","img":"'.$vetor_login['imagem'].'","nome": "'.$vetor_mecanico['nome'].'","msg":"'.$vetor_servico['text'].'"}' ;
		}
		$x++;
	}
	echo "]";



	
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
else if (isset($_POST['msgvisto'])) {

	$cod = $_POST['msgvisto'];
	$sql = "UPDATE `mensagens` SET `mostra`= 1 WHERE `cod_destinatario` = $cod";
	$query = mysqli_query($conn,$sql);
}
else if(isset($_POST['valor'])){

	$valor = $_POST['valor'];
	$tipo = $_POST['tipo'];
	$hora = $_POST['hora'];
	$data = $_POST['data'];
	$data_termino = $_POST['data_termino'];
	$cod_autor = $_POST['codigo'];
	$detalhes = $_POST['detalhes'];
	$cod_destinatario = $_POST['cod_destinatario'];
	$cod_servico = $_POST['conversa'];
	$sql = "UPDATE `orcamento` SET `status`= 0 WHERE `status` = 1 && `cod_servico` = $cod_servico && `status` != 2";
	$query = mysqli_query($conn,$sql);
	$sql = "INSERT INTO `orcamento`(`valor`, `data`, `detalhes`,`status`,`cod_servico`,`tipo`) VALUES ($valor,'$data','$detalhes',1,$cod_servico,'$tipo')";
	$query = mysqli_query($conn,$sql);
	$cod_orcamento =  mysqli_insert_id($conn);
	$sql = "INSERT INTO `agenda`(`data_inicio`, `horario_inicio`, `data_termino`, `cod_orcamento`) VALUES ('$data','$hora','$data_termino',$cod_orcamento)";
	$query = mysqli_query($conn,$sql);
	$sql = "INSERT INTO `mensagens`(`cod_servico`,`cod_autor`,`cod_orcamento`,`cod_destinatario`) VALUES ($cod_servico,$cod_autor,$cod_orcamento,$cod_destinatario)";
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
			$sql_foto = "SELECT * FROM `login` WHERE `cod_login` = $cod_login";
			$query_foto = mysqli_query($conn,$sql_foto);
			$vetor_foto = mysqli_fetch_array($query_foto);

			
			echo $vetor_foto['imagem'];
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
			$sql_foto = "SELECT * FROM `login` WHERE `cod_login` = $cod_login";
			$query_foto = mysqli_query($conn,$sql_foto);
			$vetor_foto = mysqli_fetch_array($query_foto);

			
			echo $vetor_foto['imagem'];
		}
		else{
			echo "erro";
		}
	}
	
	


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
	
	


}

else if (isset($_POST['servicos'])) {
	$cod_servico = $_POST['servicos'];
	
	$sql = "SELECT * FROM `orcamento` WHERE `cod_servico` = $cod_servico";
	$query_orc = mysqli_query($conn,$sql);
	$numero = mysqli_num_rows($query_orc);
	$x =1;
	echo "[";
	while($vetor_orcamento = mysqli_fetch_array($query_orc)){
		$cod_orcamento = $vetor_orcamento['cod_orcamento'];
		$sql = "SELECT * FROM `agenda` WHERE `cod_orcamento` = $cod_orcamento";
		$query = mysqli_query($conn,$sql);
		$vetor_agenda = mysqli_fetch_array($query);

		if ($numero != $x) {

			echo '{ "tipo":"'.$vetor_orcamento['tipo'].'","data_inicio":"'.$vetor_agenda['data_termino'].'","status":'.$vetor_orcamento['status'].',"cod":'.$vetor_orcamento['cod_orcamento'].'},' ;

		}
		else{
			echo '{ "tipo":"'.$vetor_orcamento['tipo'].'","data_inicio":"'.$vetor_agenda['data_termino'].'","status":'.$vetor_orcamento['status'].',"cod":'.$vetor_orcamento['cod_orcamento'].'}' ;
		}
		$x++;
	}
	echo "]";
}
else{
	
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
				"tipo": "'.$vetor_orcamento['tipo'].'",
				"cod_destinatario": "'.$row['cod_destinatario'].'",
				"cod_orcamento": '.$row['cod_orcamento'].',
				"status": '.$vetor_servico['status'].',
				"orcamento": ["'.$vetor_orcamento["valor"].'","'.$vetor_orcamento["detalhes"].'","'.$vetor_orcamento["data"].'","'.$vetor_orcamento["status"].'","'.$vetor_servico['mostra'].'"]},';
			}
			else{
				echo '{
					"texto": "'.$row["text"].'",
					"codigo": '.$row["cod_servico"].',
					"cod_autor": "'.$row['cod_autor'].'",
					"tipo": "'.$vetor_orcamento['tipo'].'",
					"cod_destinatario": "'.$row['cod_destinatario'].'",
					"cod_orcamento": "'.$row['cod_orcamento'].'",
					"status": '.$vetor_servico['status'].',
					"orcamento": ["'.$vetor_orcamento["valor"].'","'.$vetor_orcamento["detalhes"].'","'.$vetor_orcamento["data"].'","'.$vetor_orcamento["status"].'"]}';
				}
				$x++;
			}

			echo ']';
		}

		?>