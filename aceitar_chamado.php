<?php


$conn = mysqli_connect("localhost", "root", "","bd_do_alex");



if(isset($_POST['hora']))
{
	

	$message = $_POST['hora'];
	$sql = "INSERT INTO `mensagens`(`text`,`cod_servico`,`cod_autor`) VALUES ('$message',2,2)";
	mysqli_query($conn,$sql);

}else{}
		?>