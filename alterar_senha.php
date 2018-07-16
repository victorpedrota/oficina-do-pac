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
      
  $system_control = $_SESSION["system_control"];   
  $cod_login = $_SESSION['cod_login'];
  $privilegio = $_SESSION["privilegio"];
  $cod_cliente = $_SESSION["cod_cliente"];

  if($system_control == 1 && $privilegio == 0){
    require('connect.php');
  $senha = $_POST['senha_nova'];
  $oficina ="UPDATE `login` SET `senha`='$senha' WHERE `cod_login` = $cod_login";
  $oficinas_query = mysqli_query($conn,$oficina); 
  ?>
    <script>
      alert("Senha alterada com sucesso!");
      document.location.href="form_alterar_usuario.php";
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