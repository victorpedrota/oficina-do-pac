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

  if($system_control == 1 && $privilegio == 2){
    require('connect.php'); 
    
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
                  <p class="lead">Aqui vai estar toda a merda q tenho q pensar em colocar q por enquanto so vou colocar botao q vai pra pagina q eu quero e faz oq eu quero</p>
                  <hr class="my-4">
                  <p>vai serproblema do lucas arrumar essa caralha de um jeito bonito pq to com preguiça</p>
                  <p class="lead">

                    <a class="btn btn-primary" href="form_mecanico.php">Cadastrar mecânico</a>
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
            <h5 class="modal-title" id="exampleModalLabel">Abrir chamado</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <form method="POST" action="abrir_chamado.php">
              Selecionar Oficina:
              <select name="n_oficina" class="form-control"> 
                <option>selecione uma oficina</option>
                <option>
                 <?php 
                  for ($i=0; $i < $numero_oficina ; $i++) {
                      $vetor_oficina = mysqli_fetch_array($oficinas_query);
                    echo " <option value=" . $vetor_oficina['cod_oficina'] . " > " . $vetor_oficina['nome']. "</option>";
                  }

                ?>

              </select>
              Selecionar Veiculo:
              <select class="form-control" name="veiculo" required> 
                <option>selecione seu veiculo</option>
                <option>
                 <?php 

                 while ($vetor_veiculo = mysqli_fetch_array($veiculo_resultado)) {
                  echo " <option value=" . $vetor_veiculo['cod_veiculo'] . " > " . $vetor_veiculo['modelo']. "</option>";
                }

                ?>

              </select>
              Tipo de Serviço:
              <input type="text" class="form-control" name="tipo" required>
            
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
            <button type="submit" class="btn btn-primary">Abrir</button></form>
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