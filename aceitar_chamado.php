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
    $cod_servico = $_GET['cod_servico'];
    $sql_pesquisa ="UPDATE `servico` SET `status`=1 WHERE `cod_servico` = $cod_servico" ;
    $resultado = mysqli_query($conn,$sql_pesquisa);
      ?>
  <script>
    alert("Acesso Inválido!");
    document.location.href="perfil_mecanico.php";
  </script>
  <?php  
    
    
    
    ?>

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