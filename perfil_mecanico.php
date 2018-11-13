<?php
    //Mantendo a sessão/cria uma sessao
session_start();
if(!isset($_SESSION["system_control"]))
{
  ?>
  <html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<link rel="stylesheet" href="scss/main.css">
    

    <title>Acesso inválido</title>
  </head>
  <body>
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <div class="modal fade" id="exampleModalLong" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Acesso inválido</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        Você não tem acesso a esta página
      </div>
      <div class="modal-footer">
        
        <a  href="login.php" class="btn btn-primary">Voltar</a>
      </div>
    </div>
  </div>
</div>

<script>
  $(document).ready(function(){
    $('#exampleModalLong').modal('show')
    $('#exampleModalLong').on('hidden.bs.modal', function (e) {
 window.location.href = 'login.php';
})

  })
</script>
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    
  </body>
</html>
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
    $sql_servico1 ="SELECT * FROM `servico` WHERE `cod_oficina` = $cod_oficina && `status`=0";
    $query_servico1 = mysqli_query($conn,$sql_servico1); 
    $sql_pesquisa ="SELECT * FROM `mecanico` WHERE `cod_login` = $cod_login";
    $resultado = mysqli_query($conn,$sql_pesquisa);
    $vetor = mysqli_fetch_array($resultado);
    
    $_SESSION["nome"] = $vetor["nome"];
    
    ?>

    <!DOCTYPE html>
    <html>

    <head>
      <title></title>
      <link rel="stylesheet" href="scss/main.css">
      <link rel="stylesheet" href="css/chat.css">
      <link rel="stylesheet" type="text/css" href="css/style.css">
      <link rel="stylesheet" href="css/starrr.css">
      <style type="text/css">
      .yellow{
        color: yellow;
      }
    </style>
    <meta charset="utf-8">
  </head>

  <body style="overflow-x: hidden;">
    <?php
    header('Content-Type: text/html; charset=utf-8');
    require("navbar_mecanico.html");
    ?>
    <div class="row">
       <div class="modal fade" id="suceeso" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Concluido</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        Entrada do veículo confirmada
      </div>
      <div class="modal-footer">
        
        <a  href="perfil_mecanico.php" class="btn btn-primary">Voltar</a>
      </div>
    </div>
  </div>
</div>

      <div class="col">
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
                <a class="nav-link" href="#" id="feed">Feed</a>
              </li>



              <li class="nav-item">
                <a class="nav-link" href="#" id="chat">Chat
                </a>
              </li>

              <li class="nav-item">
                <a class="nav-link" href="#" id="servico">Serviço oficina
                </a>
                
              </li>
              <script type="text/javascript">
                $(function () {
                  $('[data-toggle="popover"]').popover()
                })
              </script>



            </ul>
          </div>
        </nav>

        <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">
          <div class="row">
            <div class="col-lg-8 col-sm-12" id="div_servicos" style="display: none;margin-top: 60px;">
              <ul style="text-align: left;" class="list-group">
                <center>
                  <h4 id="titulo " class="d-inline">Serviços em andamento na oficina</h4><button style="margin-top: -7px;" type="button" class="btn btn-link d-inline" data-toggle="popover" title="Serviços da oficina" data-content="Aqui estão os serviços em progresso da oficina"><i class="fas fa-info-circle"></i></button></center>
                  <?php
                  $sql_servico2 = "SELECT * FROM `servico` WHERE  `cod_oficina` = $cod_oficina && (`status`=1  || `status`=2 || `status`=3 ) && `cod_mecanico` != $cod_mecanico";
                  $query_servico2 = mysqli_query($conn, $sql_servico2);
                  $numero_servico2 = mysqli_num_rows($query_servico2); 
                  if ($numero_servico2 !=0) {
                    while ($vetor_servico2 = mysqli_fetch_array($query_servico2)) {
                      $veiculo2 = $vetor_servico2['cod_veiculo'];
                      $sql_veiculo2 ="SELECT * FROM `veiculo` WHERE `cod_veiculo` = $veiculo2" ;
                      $veiculo_resultado2 = mysqli_query($conn,$sql_veiculo2);
                      $vetor_veiculo2 = mysqli_fetch_array($veiculo_resultado2);
                      echo "<li class='list-group-item itens'><p style='display:block;'>
                      Veículo:".$vetor_veiculo2['placa']."<a href='chat_mecanico.php?cod_servico=".$vetor_servico2['cod_servico']."' style='float:right; right:0px;margin-left:5px;'><i class='fas fa-external-link-alt'></i></a>
                      Protocolo:   ".$vetor_servico2['protocolo']."<br>Serviço desejado:".$vetor_servico2['servico_desejado']."
                      </li>";
                    }
                  }else{
                    echo "<li class='list-group-item itens'>Não há veiculos nesta fase</li>";
                  }
                  ?>

                </ul></div>
                <div class="col-lg-8 col-sm-12" id="div2" style="display: none;margin-top: 60px;">
                  <ul style="text-align: left;" class="list-group">
                    <center>
                      <h4 id="d-inline">Chat<button style="margin-top: -7px;" type="button" class="btn btn-link d-inline" data-toggle="popover" title="Serviços da oficina" data-content="Aqui estão os serviços em progresso da oficina"><i class="fas fa-info-circle"></i></button></h4>  </center>
                      <?php
                      $sql_servico = "SELECT * FROM `servico` WHERE  `cod_oficina` = $cod_oficina && (`status`=1  || `status`=2 || `status`=3 )  && `cod_mecanico` = $cod_mecanico";
                      $query_servico = mysqli_query($conn, $sql_servico);
                      $numero_servico = mysqli_num_rows($query_servico); 
                      if ($numero_servico !=0) {
                        while ($vetor_servico = mysqli_fetch_array($query_servico)) {
                          $veiculo = $vetor_servico['cod_veiculo'];
                          $sql_veiculo ="SELECT * FROM `veiculo` WHERE `cod_veiculo` = $veiculo" ;
                          $veiculo_resultado = mysqli_query($conn,$sql_veiculo);
                          $vetor_veiculo = mysqli_fetch_array($veiculo_resultado);
                          echo "<li class='list-group-item itens'><p style='display:block;'>
                          Veículo:".$vetor_veiculo['placa']."<a href='chat_mecanico.php?cod_servico=".$vetor_servico['cod_servico']."' style='float:right; right:0px;margin-left:5px;'><i class='fas fa-external-link-alt'></i></a>
                          Protocolo:   ".$vetor_servico['protocolo']."<br>Serviço desejado:".$vetor_servico['servico_desejado']."
                          </li>";
                        }
                      }else{
                        echo "<li class='list-group-item itens'>Não há veiculos nesta fase</li>";
                      }
                      ?>

                    </ul></div>
                    <div class="col-lg-8 col-sm-12" id="div1">
                      <div class="col-sm" id="chamados" style="display: block; margin-top: 30px;"><br>
                        <center>
                          <h4 id="titulo">Serviço aguardando resposta</h4>
                          <div id="info"></div>
                          <ul style="text-align: left;" class="list-group">

                            <?php
                            $numero_servico1 = mysqli_num_rows($query_servico1);

                            if ($numero_servico1 == 0) {
                              echo "<li class='list-group-item itens'>Não há veiculos nesta fase</li>"; 
                            } else{while ($vetor_servico = mysqli_fetch_array($query_servico1)) {

                              $veiculo = $vetor_servico['cod_veiculo'];
                              $sql_veiculo_anda ="SELECT * FROM `veiculo` WHERE `cod_veiculo` = $veiculo" ;
                              $veiculo_resultado_anda = mysqli_query($conn,$sql_veiculo_anda);
                              $vetor_veiculo_anda = mysqli_fetch_array($veiculo_resultado_anda);
                              echo "<li class='list-group-item itens'><p style='display:inline-block;'>
                              Veículo:".$vetor_veiculo_anda['placa']."
                              Protocolo:   ".$vetor_servico['protocolo']."<br>Status: Aguardando aceitação da Oficina<br>
                              Serviço desejado:".$vetor_servico['servico_desejado']."
                              <br><br><a href='aceitar_chamado2.php?cod_servico=".$vetor_servico['cod_servico']."' class='btn btn-primary'>Aceitar</a>
                              </li>";
                            }

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
                              Veículo:".$vetor_veiculo['placa']."<a href='chat_mecanico.php?cod_servico=".$vetor_servico['cod_servico']."' style='float:right; right:0px;margin-left:5px;'><i class='fas fa-external-link-alt'></i></a>
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
                              Serviço desejado:".$vetor_servico['servico_desejado']."<br><button value=".$vetor_servico['cod_servico']." class='btn btn-primary codigo gambiarra2'>Confirmar entrada</button>
                              </li>";
                            }
                          }
                          else{
                            echo "<li class='list-group-item itens'>Não há veiculos nesta fase</li>";
                          }              
                          ?>

                        </ul>
                        <br>
                        <br>

                        <h4 id="titulo">Em andamento</h4>
                        <div id="info"></div>
                        <ul style="text-align: left;" class="list-group">
                          <?php
                          $sql_servico = "SELECT * FROM `servico` WHERE  `cod_mecanico` = $cod_mecanico && `status`=3";
                          $query_servico = mysqli_query($conn, $sql_servico);
                          $numero_servico = mysqli_num_rows($query_servico); 
                          if ($numero_servico !=0) {
                            while ($vetor_servico = mysqli_fetch_array($query_servico)) {
                              $veiculo = $vetor_servico['cod_veiculo'];
                              $sql_veiculo ="SELECT * FROM `veiculo` WHERE `cod_veiculo` = $veiculo" ;
                              $veiculo_resultado = mysqli_query($conn,$sql_veiculo);
                              $vetor_veiculo = mysqli_fetch_array($veiculo_resultado);
                              echo "<li class='list-group-item itens'><p style='display:block;'>
                              Veículo:".$vetor_veiculo['placa']."<a href='chat_mecanico.php?cod_servico=".$vetor_servico['cod_servico']."'style='float:right; right:0px;margin-left:5px;'><i class='fas fa-external-link-alt'></i></a> <a href='#' style='float:right;' data-toggle='modal' data-target='#exampleModal'><i class='fas fa-share-square'></i></a>
                              Protocolo:   ".$vetor_servico['protocolo']."<br>Status: Aguardando carro ser entregue<br>
                              Serviço desejado:".$vetor_servico['servico_desejado']."<br><button value=".$vetor_servico['cod_servico']." data-toggle='modal' data-target='#avaliacao' class='btn btn-primary codigof'>Finalizar serviço</button> <button value=".$vetor_servico['cod_servico']." class='btn btn-primary codigo atu' data-toggle='modal' data-target='#exampleModal'>Mandar atualização</button>
                              </li>";
                            }
                          }
                          else{
                            echo "<li class='list-group-item itens'>Não há veiculos nesta fase</li>";
                          }              
                          ?>

                        </ul>
                        <br>

                        <h4 id="titulo">Finalizados</h4>
                        <div id="info"></div>
                        <ul style="text-align: left;" class="list-group">
                          <?php
                          $sql_servico = "SELECT * FROM `servico` WHERE  `cod_mecanico` = $cod_mecanico && `status`=4";
                          $query_servico = mysqli_query($conn, $sql_servico);
                          $numero_servico = mysqli_num_rows($query_servico); 
                          if ($numero_servico !=0) {
                            while ($vetor_servico = mysqli_fetch_array($query_servico)) {
                              $veiculo = $vetor_servico['cod_veiculo'];
                              $sql_veiculo ="SELECT * FROM `veiculo` WHERE `cod_veiculo` = $veiculo" ;
                              $veiculo_resultado = mysqli_query($conn,$sql_veiculo);
                              $vetor_veiculo = mysqli_fetch_array($veiculo_resultado);
                              echo "<li class='list-group-item itens'><p style='display:block;'>
                              Veículo:".$vetor_veiculo['placa']."<a class='aexcluir' aria-label='Close'><i class='fas fa-times close' style='color:red;' href='excluir_veiculo.php?placa=".$vetor_servico['cod_servico']."'
                              ></i></a>
                              Protocolo:   ".$vetor_servico['protocolo']."<br>Status: Aguardando carro ser entregue<br>
                              Serviço desejado:".$vetor_servico['servico_desejado']."<br>
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
                  </div> 
                  <div class="col-lg-2 d-none d-sm-block d-sm-none d-md-block" style="margin-top: 60px;margin-bottom: 10px"><div class="card" style="width: 20rem;position: fixed;">
                    <img class="card-img-top" src="http://www.agenciamestre.com/anuncios-facebook/img/img-anuncios-patrocinados.jpg" style="filter: grayscale(100%);" alt="Card image cap">
                    <div class="card-body">
                      <h5 class="card-title">Anúncio</h5>
                      <p class="card-text">Espaço reservado para anúncio</p>

                    </div>
                  </div></div>
                </div>
              </div>

              <div class="modal fade" id="avaliacao" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title" id="exampleModalCenterTitle">Avaliar Usuário</h5>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                    <div class="modal-body">
                      <center>
                        <input type="hidden" value="" id="cod_serv" name="cod_serv">
                        <img src="" id="foto" style="border-radius: 50%;height: 80px;width: 80px;"><br><br>
                        <div id="vaiq"></div> </center>
                      </div>
                      <input type="hidden" id="nota" value="">
                      <div class="modal-footer">
                        <button type="button" class="btn btn-secondary"  data-dismiss="modal" id="fechar">Fechar</button>
                        <button type="button" id="envia" class="btn btn-primary">Enviar</button>
                      </div>
                    </div>
                  </div>
                </div>
              </main>
              <script src="js/starrr.js"></script>
              <script>
                $('#chat').on('click', function() {
                  $('#div2').css("display","block");
                  $('#div1').css("display","none");
                  $('#div_servicos').css("display","none");
                });
                $('#servico').on('click', function() {
                  $('#div_servicos').css("display","block");
                  $('#div1').css("display","none");
                  $('#div2').css("display","none");
                });
                $('#feed').on('click', function() {
                  $('#div1').css("display","block");
                  $('#div2').css("display","none");
                  $('#div_servicos').css("display","none");
                });
                $(".codigo.gambiarra2").click(function() {
                  $.post("dar_entrada.php", {
                    codigo: $(this).val()
                  }
                  )
                  $('#suceeso').modal('show')
                      $('#sucesso').on('hidden.bs.modal', function (e) {
                       window.location.href = 'perfil_mecanico.php';
                     })
                })
                $(".codigof").click(function() {
                  $("#cod_serv").val($(this).val())
                  $.post( "server.php", { tipo: "mecanico", codigo: $(this).val() } )
                  .done(function( data ) {

                    $( "#foto" ).attr( "src", data );  

                  })
                  $( ".starrr" ).remove();
                  $("#vaiq").append("<div class='starrr' id='star1'></div>")
                  $('.starrr').starrr({
                    change: function(e, value){
                      $("#nota").val(value)


                    }
                  })
                })


                $("#fechar").click(function(){

                  $( ".starrr" ).remove();
                })

                $("#envia").click(function(){
                  $.post( "server.php", {tipo: "mecanico" , nota: $("#nota").val(), cod: $("#cod_serv").val()} )
                  $.post("atualizacao.php", {
                    codigo: $("#cod_serv").val() , var: 0
                  },
                  );
                  location.reload();

                })


              </script>
              <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title" id="exampleModalLabel">Atualização</h5>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                    <div class="modal-body">
                      <form method="POST" action="atualizacao.php">
                        Assunto:
                        <input type="text" name="assunto" class="form-control">
                        Conteudo:
                        <textarea type="text" class="form-control" name="atualizacao"></textarea>
                        <input type="hidden" id="bot_cod" name="codigo" value="">
                        <input type="hidden" value="1" name="var">

                      </div>
                      <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                        <button type="submit" class="btn btn-primary">Enviar</button>
                      </div></form>
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
              <html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<link rel="stylesheet" href="scss/main.css">
    

    <title>Acesso inválido</title>
  </head>
  <body>
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <div class="modal fade" id="exampleModalLong" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Acesso inválido</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        Você não tem acesso a esta página
      </div>
      <div class="modal-footer">
        
        <a  href="login.php" class="btn btn-primary">Voltar</a>
      </div>
    </div>
  </div>
</div>
<script>
  $(document).ready(function(){
    $('#exampleModalLong').modal('show')
    $('#exampleModalLong').on('hidden.bs.modal', function (e) {
 window.location.href = 'login.php';
})

  })
</script>
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    
  </body>
</html>
              <?php           
            }
          }
          ?>