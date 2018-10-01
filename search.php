<?php


$conn = mysqli_connect("localhost", "root", "");


// Selecionando banco
$db = mysqli_select_db($conn,"bd_do_alex") or die("Não foi possível selecionar o Banco");




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
				echo '"text":"'.$row["nome"].'",';
				echo '"href":"'.$row["nome"].'",';
				echo '"id":'.$row["cod_oficina"];
				echo '},';
				
		}else
		
		{
				echo '{';	
				echo '"text":"'.$row["nome"].'",';
				echo '"id":'.$row["cod_oficina"];
				echo '}';

					
		}$x++;
	}
			echo ']';

	

		?>