<?php
    //Mantendo a sessão/cria uma sessao
session_start();

if(!isset($_SESSION["system_control"]))
{

	require('erro.php');    

}
else{
        //Sessao já criada  
        //Recuperando as variaveis da sessão
	$system_control = $_SESSION["system_control"];   
	$cod_login = $_SESSION['cod_login'];
	$privilegio = $_SESSION["privilegio"];


	if($system_control == 1 && $privilegio == 2){
		$nome = $_SESSION["nome"];
		$cod_oficina = $_SESSION["cod_oficina"];
		require('connect.php'); 
		$cod_mecanico = $_GET['codigo'];
		$cod_servico = $_GET['cod_servico'];
		$sql = "UPDATE `servico` SET `cod_mecanico`=$cod_mecanico WHERE `cod_servico` = $cod_servico";
		$query= mysqli_query($conn,$sql);
		?>

		<html">
		<head>
			<!-- Required meta tags -->
			<meta charset="utf-8">
			<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
			<link rel="stylesheet" href="scss/main.css">


			<title>Mecânico Alterado</title>
		</head>
		<body>
			<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
			<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
			<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
			<div class="modal fade" id="exampleModalLong" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
				<div class="modal-dialog" role="document">
					<div class="modal-content">
						<div class="modal-header">
							<h5 class="modal-title" id="exampleModalLongTitle">Sucesso</h5>
							<button type="button" class="close" data-dismiss="modal" aria-label="Close">
								<span aria-hidden="true">&times;</span>
							</button>
						</div>
						<div class="modal-body">
							Mecânico Alterado com sucesso
						</div>
						<div class="modal-footer">

							<a  href="login.php" class="btn btn-primary">Voltar</a>
						</div>
					</div>
				</div>
			</div>
			<script>
				$(document).ready(function(){
					$('#exampleModalLong').modal('show')
					$('#exampleModalLong').on('hidden.bs.modal', function (e) {
						window.location.href = 'login.php';
					})

				})
			</script>
			<!-- Optional JavaScript -->
			<!-- jQuery first, then Popper.js, then Bootstrap JS -->

		</body>
		</html>
		<?php

	}
	else
	{
            //Acesso Inválido

            //Finalizando a sessão
		session_destroy();

            //Mensagem para o Usuário


		require('erro.php');


	}
}
?>