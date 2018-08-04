
<?php
    //Mantendo a sessão/cria uma sessao
session_start();

if(!isset($_SESSION["system_control"]))
{
  ?>
  <script>
    alert("Acesso Inválido!");
    document.location.href="login.php";
  </script>
  <?php       
}
else{
        //Sessao já criada  
        //Recuperando as variaveis da sessão
  $system_control = $_SESSION["system_control"];   
  $cod_login = $_SESSION['cod_login'];
  $privilegio = $_SESSION["privilegio"];
  $cod_oficina = $_SESSION["cod_oficina"];
  $cod_mecanico = $_SESSION["cod_mecanico"];


  if($system_control == 1 && $privilegio == 1){
    require('connect.php');

    $sql_servico ="SELECT * FROM `servico` WHERE `cod_oficina` = $cod_oficina && `status`=0";
    $query_servico = mysqli_query($conn,$sql_servico); 

    $sql_pesquisa ="SELECT * FROM `mecanico` WHERE `cod_login` = $cod_login" ;
    $resultado = mysqli_query($conn,$sql_pesquisa);
    $vetor = mysqli_fetch_array($resultado);
    
    $_SESSION["nome"] = $vetor["nome"];
    
     $cod_servico = $_GET['cod_servico'];
    
	$sql = "UPDATE `servico` SET `status`= 1,`cod_mecanico` = $cod_mecanico WHERE `cod_servico` = $cod_servico";
	mysqli_query($conn,$sql);
	?>
	<script>
    alert("servico em discussão!");
    document.location.href="perfil_mecanico.php";
  </script>
  <?php  
}
else
{
            //Acesso Inválido

            //Finalizando a sessão
  session_destroy();

            //Mensagem para o Usuário
  ?>
  <script>
    alert("Acesso Inválido!");
    document.location.href="login.php";
  </script>
  <?php           
}
}
?>