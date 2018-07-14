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
  $cod_cliente = $_SESSION["cod_cliente"];
  if($system_control == 1 && $privilegio == 0){
    require('connect.php');

    $sql_pesquisa ="SELECT * FROM `cliente` WHERE `cod_login` = $cod_login" ;
    $resultado = mysqli_query($conn,$sql_pesquisa); 
    $vetor = mysqli_fetch_array($resultado);
    

    $oficina ="SELECT * FROM `oficina` ORDER BY `nome`";
    $oficinas_query = mysqli_query($conn,$oficina); 
    $numero_oficina = mysqli_num_rows($oficinas_query);

    $sql ="SELECT * FROM `login` WHERE `cod_login` = $cod_login" ;
    $resultado_pesquisa = mysqli_query($conn,$sql); 
    $vetor_login = mysqli_fetch_array($resultado_pesquisa);

    $sql_veiculo ="SELECT * FROM `veiculo` WHERE `cod_cliente` = $cod_cliente" ;
    $veiculo_resultado = mysqli_query($conn,$sql_veiculo); 
    $numero_veiculos = mysqli_num_rows($veiculo_resultado);
    
    ?>

    <!DOCTYPE html>
    <html>
    <head>
      <title>Oficina Pro</title>
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
      <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">


    </head>
    <body>
      <?php
      require("navbar_logout.html");
      ?>
      
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