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
$orcamento = $_POST['valor'];
    $sql_pesquisa ="UPDATE `status` SET `status`=1 WHERE `cod_servico` = $codigo";
    $resultado = mysqli_query($conn,$sql_pesquisa); 
    $sql_pesquisa ="UPDATE `servico` SET `orcamento`=$orcamento WHERE `cod_servico` = $codigo";
    $resultado = mysqli_query($conn,$sql_pesquisa); 
?>
  <script>
    alert("Ormaçemnto enviado com sucesso!");
    document.location.href="chamados.php";
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