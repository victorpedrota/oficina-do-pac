<?php
// Incluir aquivo de conexão
include("connect.php");
 
// Recebe o valor enviado
$valor = $_GET['valor'];
 
// Procura titulos no banco relacionados ao valor
$sql_pesquisa	 = "SELECT * FROM `login` WHERE `login`  = '$valor'";
$resultado = mysqli_query($conn,$sql_pesquisa);
// Exibe todos os valores encontrados
while ($objeto = mysqli_fetch_object($resultado)) {
	echo  $objeto->login;
}
 
// Acentuação
header("Content-Type: text/html; charset=ISO-8859-1",true);
?>