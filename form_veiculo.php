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

  if($system_control == 1 && $privilegio == 0){
    require('connect.php');



    ?>
<!DOCTYPE html>
<html lang="en">
<head>

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  
</head>
<body>
  <?php require("navbar_logout.html"); ?>

  <div class="container" style="margin-top: 60px">
    <h3 >Formulário Cadastrar veiculo</h3>
    
    <form action="cadastrar_veiculo.php" method="POST">
      <div class="col-xs-4">
        <label for="ex3">Modelo:</label>
        <input class="form-control" id="ex3" name="modelo"  type="text" required>
        <label for="ex3">Cor:</label>
        <input class="form-control" id="ex3" name="cor"  type="text" required>
        <label for="ex3">Ano:</label>
        <input class="form-control" id="ex3" name="ano" type="text" required>
        <label for="ex3">Placa:</label>
        <input class="form-control"  min="8" id="ex3" name="placa" type="text" required>
        <label for="ex3">Descrição:</label>
        <input class="form-control" id="ex3" name="descricao" type="text" required>

        <center> <button style="margin-top: 10px" type="submit" class="btn btn-primary">Submit</button></center>
      </div>

    </form>
  </div>
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
  ?>
  <script>
    alert("Acesso Inválido!");
    document.location.href="login.php";
  </script>
  <?php           
}
}
?>