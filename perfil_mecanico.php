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
    
    ?>

  <!DOCTYPE html>
  <html>
  <head>
    <title></title>
    <!-- Bootstrap CSS CDN -->
    <link rel="stylesheet" href="scss/main.css">
    <link rel="stylesheet" href="css/chat.css">
    <!-- Our Custom CSS -->
    <link rel="stylesheet" type="text/css" href="css/style.css">
  </head>
  <body>
    <?php
    require("navbar_logout.html");
    ?>
    <div class="row">
      <nav class="col-md-2 d-none d-md-block bg-light sidebar">
        <div class="sidebar-sticky">
          <ul class="nav flex-column">
            <li class="nav-item">
              <a class="nav-link active" href="#">
                <span data-feather="home"></span>
                Página inical <span class="sr-only">(current)</span>
              </a>
            
            </li>
            <li class="nav-item">
              <a class="nav-link" href="" id="feed">Feed</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#" id="btnchamados" >Ver Serviços
              </a>
            </li>
            
            
            <li class="nav-item">
              <a class="nav-link" href="#" id="btnandamento" >Serviços em andamento
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="form_veiculo.php">Gerenciar Veículos</a>
            </li>
            

          </ul>
        </div>
      </nav>

      <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">
        <div class="col-sm" id="chamados" style="display: none;"><br>
          <center>
            <h4 id="titulo">Serviço aguardando resposta</h4>
            <div id="info"></div>
            <ul style="text-align: left;" class="list-group">

              <?php
              
              while ($vetor_servico = mysqli_fetch_array($query_servico)) {
                

                  $veiculo = $vetor_servico['cod_veiculo'];
                  $sql_veiculo_anda ="SELECT * FROM `veiculo` WHERE `cod_veiculo` = $veiculo" ;
                  $veiculo_resultado_anda = mysqli_query($conn,$sql_veiculo_anda);
                  $vetor_veiculo_anda = mysqli_fetch_array($veiculo_resultado_anda);
                  echo "<li class='list-group-item itens'><p style='display:inline-block;'>
                  Veículo:".$vetor_veiculo_anda['placa']."
                  Protocolo:   ".$vetor_servico['protocolo']."<br>Status: Aguardando aceitação da Oficina<br>
                  Serviço desejado:".$vetor_servico['servico_desejado']."
                  <br><br><a href='aceitar_chamado.php?cod_servico=".$vetor_servico['cod_servico']."' class='btn btn-primary'>Aceitar</a>
                  </li>";
                

                
              }

              ?>

            </ul>
            <br>
            <br>

            <h4 id="titulo">Serviços em discussão</h4>
            <div id="info"></div>
            <ul style="text-align: left;" class="list-group">

              <?php
              $sql_servico = "SELECT * FROM `servico` WHERE  `cod_oficina` = $cod_oficina && `status`=1 && `cod_mecanico` = $cod_mecanico";
              $query_servico = mysqli_query($conn, $sql_servico);
              $numero_servico = mysqli_num_rows($query_servico); 
              if ($numero_servico !=0) {
                while ($vetor_servico = mysqli_fetch_array($query_servico)) {

                  $veiculo = $vetor_servico['cod_veiculo'];
                  $sql_veiculo ="SELECT * FROM `veiculo` WHERE `cod_veiculo` = $veiculo" ;
                  $veiculo_resultado = mysqli_query($conn,$sql_veiculo);
                  $vetor_veiculo = mysqli_fetch_array($veiculo_resultado);
                  echo "<li class='list-group-item itens'><p style='display:block;'>
                  Veículo:".$vetor_veiculo['placa']."<a href='chat_mecanico.php?cod_servico=".$vetor_servico['cod_servico']."' style='float:right; right:0px;'><i class='fas fa-external-link-alt'></i></a>
                  Protocolo:   ".$vetor_servico['protocolo']."<br>Status: Aguardando aceitação da Oficina<br>
                  Serviço desejado:".$vetor_servico['servico_desejado']."
                  </li>";
 
                  
                  
                  
                }
              }else{

                echo "<li class='list-group-item itens'>Não há veiculos nesta fase</li>";

              }
              

              ?>

            </ul>

             <br>
                <br>

                <h4 id="titulo">Aguardando Veículo dar entrada na oficina</h4>
                <div id="info"></div>
                <ul style="text-align: left;" class="list-group">
                  <?php

                  $sql_servico = "SELECT * FROM `servico` WHERE  `cod_mecanico` = $cod_mecanico && `status`=2";
                  $query_servico = mysqli_query($conn, $sql_servico);
                  $numero_servico = mysqli_num_rows($query_servico); 
                  if ($numero_servico !=0) {
                    while ($vetor_servico = mysqli_fetch_array($query_servico)) {

                      $veiculo = $vetor_servico['cod_veiculo'];
                      $sql_veiculo ="SELECT * FROM `veiculo` WHERE `cod_veiculo` = $veiculo" ;
                      $veiculo_resultado = mysqli_query($conn,$sql_veiculo);
                      $vetor_veiculo = mysqli_fetch_array($veiculo_resultado);
                      echo "<li class='list-group-item itens'><p style='display:block;'>
                      Veículo:".$vetor_veiculo['placa']."<a href='chat_mecanico.php?cod_servico=".$vetor_servico['cod_servico']."' style='float:right; right:0px;'><i class='fas fa-external-link-alt'></i></a>
                      Protocolo:   ".$vetor_servico['protocolo']."<br>Status: Aguardando carro ser entregue<br>
                      Serviço desejado:".$vetor_servico['servico_desejado']."
                      </li>";




                    }

                  }



                  else{

                    echo "<li class='list-group-item itens'>Não há veiculos nesta fase</li>";

                  }              


                  ?>

                </ul>

          </center>
        </div>

      </main>
      <script>
        
    $('#btnchamados').on('click', function() {
    $('#chamados').toggle(1000);
  });
      </script>
  
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