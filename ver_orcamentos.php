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

    $sql_pesquisa ="SELECT * FROM `servico` WHERE `cod_cliente` = $cod_cliente";
    $resultado = mysqli_query($conn,$sql_pesquisa); 
    $vetor = mysqli_fetch_array($resultado);
    $numero_veiculos = mysqli_num_rows($resultado);
    $cod_servico = $vetor['cod_servico'];
    $sql ="SELECT * FROM `status` WHERE `cod_servico` = $cod_servico && `status` = 1";
    $resultado = mysqli_query($conn,$sql); 
    $vetor_servico = mysqli_fetch_array($resultado);
    $resultado1 = mysqli_query($conn,$sql_pesquisa); 
    
    ?>

    <!DOCTYPE html>
    <html>
    <head>
      <title>Oficina Pro</title>
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
      <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
      <style type="text/css">
      
      .main-section{

        background-color: #fff;
      }
      .profile-header{
        background-color: #343a40;
        height:93px;
      }
      .user-detail{
        margin:-50px 0px 30px 0px;
      }
      .img{
        height:100px;
        width:100px;
      }
      .user-detail h5{
        margin:15px 0px 5px 0px;
      }
      .user-social-detail{

        background-color: #343a40;
      }
      .user-social-detail a i{
        color:#fff;
        font-size:23px;
        
      }

      
    </style>

  </head>
  <body>
    <?php
    require("navbar_logout.html");
    ?>

    
    <div class="container" style="margin-top: 70px;">
      <?php
      while ($vetor = mysqli_fetch_array($resultado1)) {
        $cod_servico =$vetor['cod_servico'];
        $veiculo =$vetor['cod_veiculo'];
        $sql ="SELECT * FROM `status` WHERE `cod_servico` = $cod_servico";
        $resultado_sql = mysqli_query($conn,$sql); 
        $vetor1 = mysqli_fetch_array($resultado_sql);
        $status = $vetor1['status'];
        $sql1 ="SELECT * FROM `veiculo` WHERE `cod_veiculo` = $veiculo";
        $resultado_sql1 = mysqli_query($conn,$sql1);
        $vetor2 = mysqli_fetch_array($resultado_sql1);

        if ($status == 1) {
          $cod_cliente = $vetor['cod_cliente'];
          $cliente =" SELECT * FROM `cliente` WHERE `cod_cliente` = $cod_cliente";
          $resultado_cliente = mysqli_query($conn,$cliente); 
          $vetor_cliente = mysqli_fetch_array($resultado_cliente)
          ?>
          <li class="list-group-item">
            Novo chamado de <?php echo $vetor_cliente['nome']; ?> 
            <form method="POST" action="form_orcamento.php">
              <div>Informações do chamado:<br><?php echo $vetor2['modelo'];echo $vetor2['ano'];  ?> <br>
                <h4>Orçamento</h4>
                <?php echo $vetor['orcamento']; ?>
                <br></div>
                <input type="hidden" name="cod_servico" value=<?php echo $vetor['cod_servico']; ?>>
                <div style="float: right;"><input type="submit" value="Aceitar ordem" style="color: white;" class="btn btn-primary"></div>
                <br>
                <br>
              </li>
            </form>
            <?php

          }
          else{

          }


        }?>

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