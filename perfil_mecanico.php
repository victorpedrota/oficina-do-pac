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

    $sql_pesquisa ="SELECT * FROM `servico` WHERE `cod_oficina` = $cod_oficina";
    
    $resultado = mysqli_query($conn,$sql_pesquisa); 

    
    
    
    
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
      img{
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

    
    <div class="row" style="margin-top: 30px">

      <div class="col main-section text-center">
        <div class="row">
          <div class="col-lg-12 col-sm-12 col-12 profile-header"></div>
        </div>
        <div class="row user-detail">
          <div class="col">

            <div class="container-fluid" style="margin-top: 10px;  margin-left: 50px" >
              <img src="https://community.smartsheet.com/sites/default/files/default_user.jpg" class="rounded-circle img-thumbnail">
              <div class="row" style="margin-top: 10px;">

                <div class="col-9"><div class="jumbotron" style="height: 100%;">

                  <h1 class="display-4">Página inicial</h1>
                  <?php echo $cod_oficina; ?>


                  <p class="lead">Aqui vai estar toda a merda q tenho q pensar em colocar q por enquanto so vou colocar botao q vai pra pagina q eu quero e faz oq eu quero</p>
                  <hr class="my-4">
                  <p>vai serproblema do lucas arrumar essa caralha de um jeito bonito pq to com preguiça </p> 

                  <p class="lead">

                    <a style="color: white;" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">ver chamados</a> <a style="color: white;" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal1">Serviços em andamento</a> <a style="color: white;" class="btn btn-primary" href="chamados.php">Serviços em andamento</a>
                  </p>
                </div></div>
                <div class="col-2"><div style="height: 100%" class="jumbotron"></div></div>
              </div>


            </div>
          </div>
        </div>
        <div class="row user-social-detail">

          <div class="col" style="height: 45px">

          </div>
        </div>
      </div>
    </div>
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Ver chamado</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <?php 


            while ($vetor = mysqli_fetch_array($resultado)) {
              $cod_servico =$vetor['cod_servico'];
              $sql ="SELECT * FROM `status` WHERE `cod_servico` = $cod_servico";
              $resultado_sql = mysqli_query($conn,$sql); 
              $vetor1 = mysqli_fetch_array($resultado_sql);
              $status = $vetor1['status'];
              if ($status == 0) {
                $cod_cliente = $vetor['cod_cliente'];
                $cliente =" SELECT * FROM `cliente` WHERE `cod_cliente` = $cod_cliente";
                $resultado_cliente = mysqli_query($conn,$cliente); 
                $vetor_cliente = mysqli_fetch_array($resultado_cliente)
                ?>
                <div style="padding: 30px" class="alert alert-primary" role="alert">
                  Novo chamado de <?php echo $vetor_cliente['nome']; ?> <div style="float: right;"><a style="color: white;" class="btn btn-primary">Aceitar</a>  <a style="color: white;" class="btn btn-danger">Recusar</a></div>
                </div>

                <?php

              }
              else{

              }
              
              
              
            }

            ?>
          </div>
        </div>
      </div>
    </div>
    <div class="modal fade" id="exampleModal1" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Ver chamado</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            ll
            <?php 


            while ($vetor = mysqli_fetch_array($resultado)) {
              $cod_servico =$vetor['cod_servico'];
              $sql ="SELECT * FROM `status` WHERE `cod_servico` = $cod_servico";
              $resultado_sql = mysqli_query($conn,$sql); 
              $vetor1 = mysqli_fetch_array($resultado_sql);
              $status = $vetor1['status'];
              if ($status == 1) {
                $cod_cliente = $vetor['cod_cliente'];
                $cliente =" SELECT * FROM `cliente` WHERE `cod_cliente` = $cod_cliente";
                $resultado_cliente = mysqli_query($conn,$cliente); 
                $vetor_cliente = mysqli_fetch_array($resultado_cliente)
                ?>
                <div style="padding: 30px" class="alert alert-primary" role="alert">
                  Novo chamado de <?php echo $vetor_cliente['nome']; ?> <div style="float: right;"><a style="color: white;" class="btn btn-primary">Aceitar</a>  <a style="color: white;" class="btn btn-danger">Recusar</a></div>
                </div>

                <?php

              }
              else{

              }
              
              
              
            }

            ?>
          </div>
        </div>
      </div>
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