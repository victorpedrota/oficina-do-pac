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

  if($system_control == 1 && $privilegio == 1){
    require('connect.php'); 
    
    $codigo = $_POST['cod_servico'];

    ?>
    <?php require('navbar_logout.html');?>
<div class="container" style="margin-top: 70px">
  <form method="POST" action="envia_orcamento.php">
    Valor orçamento:
    <input  name="valor" class="form-control">
    Descrição do orçamento:
    <input type="text" class="form-control" name="">
    <input type="hidden" name="cod_servico" value=<?php echo $codigo; ?>>
    <input type="submit" class="btn btn-primary" name="">
  </form>
</div>

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