<?php


$conn = mysqli_connect("localhost", "root", "");


// Selecionando banco
$db = mysqli_select_db($conn,"bd_do_alex") or die("Não foi possível selecionar o Banco");



if(isset($_POST['texto']))
{
	$texto = $_POST['texto'];

	$sql = "SELECT * FROM `oficina`";
	$result = mysqli_query($conn,$sql);
	$numero = mysqli_num_rows($result);
	echo '[';
	$x =1;
	while($row = mysqli_fetch_array($result))
	{
		if ($numero != $x) 
		{
				echo '{';	
				echo '"nome":"'.$row["nome"].'",';
				echo '"codigo":'.$row["cod_oficina"];
				echo '},';
				
		}else
		
		{
				echo '{';	
				echo '"nome":"'.$row["nome"].'",';
				echo '"codigo":'.$row["cod_oficina"];
				echo '}';

					
		}$x++;
	}
			echo ']';
}
	else{


		}

		?>