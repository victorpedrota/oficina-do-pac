<?php


$conn = mysqli_connect("localhost", "root", "");


// Selecionando banco
$db = mysqli_select_db($conn,"bd_do_alex") or die("Não foi possível selecionar o Banco");



if(isset($_POST['message']))
{
	$message = $_POST['message'];

	$sql = "INSERT INTO `mensagens`(`text`) VALUES ('$message')";
	mysqli_query($conn,$sql);
}else{



	$sql = "SELECT `text` FROM `mensagens` ORDER BY `cod_mensagem` DESC";
	$result = mysqli_query($conn,$sql);

	while($row = mysqli_fetch_array($result))
		echo $row['text']."\n";
}

?>