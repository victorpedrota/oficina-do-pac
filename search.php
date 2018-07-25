<?php


$conn = mysqli_connect("localhost", "root", "");


// Selecionando banco
$db = mysqli_select_db($conn,"bd_do_alex") or die("Não foi possível selecionar o Banco");



if(isset($_POST['texto']))
{
	$texto = $_POST['texto'];

	$sql = "SELECT `nome` FROM `oficina` ";
	$result = mysqli_query($conn,$sql);
	$item = array();
	while($row = mysqli_fetch_array($result))
	array_push($item,$row['nome']);
	echo $item[0];
	echo $item[1];
}else{


}

?>