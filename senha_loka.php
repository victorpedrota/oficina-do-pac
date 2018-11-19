<?php 

$senha_nova = $_POST['senha_nova'];
$senha_antiga= $_POST['senha_antiga'];

$senha_nova1 = md5($senha_nova);
if($senha_nova1 == $senha_antiga){
	echo "foi";
}
echo $senha_nova1." /////";
echo $senha_antiga;

?>