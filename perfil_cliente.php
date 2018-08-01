<?php
    //Mantendo a sessão/cria uma sessao
session_start();

if(!isset($_SESSION["system_control"]))
{
  ?>
  <script>
    alert("Acesso Inválido!");
    document.location.href = "login.php";
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

    $sql_servico = "SELECT * FROM `servico` WHERE  `cod_cliente` = $cod_cliente";
    $query_servico = mysqli_query($conn, $sql_servico);
    $numero_servico = mysqli_num_rows($query_servico); 


    $_SESSION["nome"] = $vetor["nome"];
    ?>

    <!DOCTYPE html>
    <html>

    <head>
      <style type="text/css">
      div.panel,
      div.flip {
        width: 200px;
        padding: 5px;
        text-align: center;
        border: solid 1px #c3c3c3;
        position: fixed;
        right: 10px;
        bottom: -15px;
        z-index: 1;
      }

      div.panel {
        position: fixed;
        bottom: 29px;
        width: 200px;
        height: auto;
        display: none;
        text-align: left;
        z-index: 1;
      }
    </style>
    <title>Oficina Pro</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Bootstrap CSS CDN -->
    <link rel="stylesheet" href="scss/main.css">
    <link rel="stylesheet" href="css/chat.css">
    <!-- Our Custom CSS -->
    <link rel="stylesheet" type="text/css" href="css/style.css">


  </head>

  <body style="overflow-x: hidden;">


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
              <a class="nav-link" href="#" id="btnchamados">Iniciar Chamado
              </a>
            </li>


            <li class="nav-item">
              <a class="nav-link" href="#" id="btnandamento">Serviços em andamento
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="form_veiculo.php">Gerenciar Veículos</a>
            </li>


          </ul>
        </div>
      </nav>

      <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">
        <div class="row">

          <!--AQUI ESTARÁ A PORRA DO CÓDIGO DA PORRA DO CHAMADO, PEDRO É UMA PUTA  -->
          <div class="col-sm" id="andamento" style="display: none;"><br>
            <center>
              <h4 id="titulo">Serviço aguardando resposta</h4>
              <div id="info"></div>
              <ul style="text-align: left;" class="list-group">

                <?php

                while ($vetor_servico = mysqli_fetch_array($query_servico)) {
                  if ($vetor_servico['status'] == 0 ) {

                    $veiculo = $vetor_servico['cod_veiculo'];
                    $sql_veiculo_anda ="SELECT * FROM `veiculo` WHERE `cod_veiculo` = $veiculo" ;
                    $veiculo_resultado_anda = mysqli_query($conn,$sql_veiculo_anda);
                    $vetor_veiculo_anda = mysqli_fetch_array($veiculo_resultado_anda);
                    echo "<li class='list-group-item itens'><p style='display:inline-block;'>
                    Veículo:".$vetor_veiculo_anda['placa']."
                    Protocolo:   ".$vetor_servico['protocolo']."<br>Status: Aguardando aceitação da Oficina<br>
                    Serviço desejado:".$vetor_servico['servico_desejado']."
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
                $sql_servico = "SELECT * FROM `servico` WHERE  `cod_cliente` = $cod_cliente && `status`=1";
                $query_servico = mysqli_query($conn, $sql_servico);
                $numero_servico = mysqli_num_rows($query_servico); 
                if ($numero_servico !=0) {
                  while ($vetor_servico = mysqli_fetch_array($query_servico)) {

                    $veiculo = $vetor_servico['cod_veiculo'];
                    $sql_veiculo ="SELECT * FROM `veiculo` WHERE `cod_veiculo` = $veiculo" ;
                    $veiculo_resultado = mysqli_query($conn,$sql_veiculo);
                    $vetor_veiculo = mysqli_fetch_array($veiculo_resultado);
                    echo "<li class='list-group-item itens'><p style='display:block;'>
                    Veículo:".$vetor_veiculo['placa']."<a href='chat.php?cod_servico=".$vetor_servico['cod_servico']."' style='float:right; right:0px;'><i class='fas fa-external-link-alt'></i></a>
                    Protocolo:   ".$vetor_servico['protocolo']."<br>Status: Aguardando cliente finalizar o Chamado<br>
                    Serviço desejado:".$vetor_servico['servico_desejado']."
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

              <h4 id="titulo">Aguardando Veículo dar entrada na oficina</h4>
              <div id="info"></div>
              <ul style="text-align: left;" class="list-group">
                <?php

                $sql_servico = "SELECT * FROM `servico` WHERE  `cod_cliente` = $cod_cliente && `status`=2";
                $query_servico = mysqli_query($conn, $sql_servico);
                $numero_servico = mysqli_num_rows($query_servico); 
                if ($numero_servico !=0) {
                  while ($vetor_servico = mysqli_fetch_array($query_servico)) {

                    $veiculo = $vetor_servico['cod_veiculo'];
                    $sql_veiculo ="SELECT * FROM `veiculo` WHERE `cod_veiculo` = $veiculo" ;
                    $veiculo_resultado = mysqli_query($conn,$sql_veiculo);
                    $vetor_veiculo = mysqli_fetch_array($veiculo_resultado);
                    echo "<li class='list-group-item itens'><p style='display:block;'>
                    Veículo:".$vetor_veiculo['placa']."<a href='chat.php?cod_servico=".$vetor_servico['cod_servico']."' style='float:right; right:0px;'><i class='fas fa-external-link-alt'></i></a>
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
          <div class="d-flex justify-content-center"  style="margin-left: 30px;">
            <div id="chamados" style="display: none; margin-top: 60px;width: 800px; margin-right: 30px;">
              <center>
                <h3>Inicar Chamado</h3>
              </center>
              <form method="post" action="abrir_chamado.php" id="form">
                <div class="row">
                  <div class="col">

                    Veiculo:
                    <select name="veiculo" class="form-control" id="veiculos" required>
                      <option value="3">Selecione um Veículo</option>
                      <option value="2">d um tipo</option>
                      <?php 
                      while ($vetor_veiculo = mysqli_fetch_array($veiculo_resultado)) {
                        echo "<option value=".$vetor_veiculo['cod_veiculo'].">Modelo:  ".$vetor_veiculo['modelo']."      Placa:  ".$vetor_veiculo['placa']."</option>";
                      }
                      ?>
                    </select>
                  </div>
                  <div class="col">
                    Tipo de serviço: <i class="fas fa-info-circle"></i>
                    <select class="form-control" id="tipo" name="tipo" required>
                      <option value="">Selecione um tipo</option>
                      <option value="troca">troca de oleo</option>
                    </select>
                    <input type="hidden" name="n_oficina" id="n_oficina">
                  </div>
                </div>
                Descrição do problema:<textarea name="problema" id="descricao" style="border-radius: 1em;" class="form-control" required></textarea> Serviço desejado:<textarea name="servico"  id="servico" style="border-radius: 1em;" class="form-control" required></textarea>
                <center><br><a class="btn btn-secondary" href="#">Cancelar</a>
                  <button type="button" id="enviar" class="btn btn-primary">Enviar</button></center>
                  <input type="hidden" id="cod_cliente" value="<?php echo $cod_cliente;?>">
                </form>
              </div>

            </div>
            <div class="col-4"></div>
          </div>
        </main>
      </div>

    </div>
    <div class="modal fade" id="oficinas" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Escolha a(s) oficina(s)</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body" id="corpo">
            <div data-id="1" id="1">
              <div class="input-group">
                <input name="noficina"  id="nome_1" class="form-control nomes" data-live-search="true" style="border-top-left-radius:3px; border-bottom-left-radius:3px; border-top-right-radius: 0px;border-bottom-right-radius: 0px; margin-left: 5px;height: 36px;width: 362px;">



                <div class="input-group-btn">
                  <button class="btn btn-default" id="addoficina" style="border-top-left-radius:0px; border-bottom-left-radius:0px; border-top-right-radius: 3px;border-bottom-right-radius: 3px; height: 36px" type="submit">
                    <i class="fas fa-plus"></i>
                  </button>
                </div>
                <div id="lista_nomes_1"  style="color:black;border: 1px solid #000; margin-top:0px; width: 100%; background-color: white; position: relative;"></div>

              </div>
            </div>
          </div>

          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
            <button type="button" id="btnenviar" class="btn btn-primary">Continuar</button>
          </div>
        </div>
      </div>
    </div>
    <script src="js/validar_form2.js"></script>
    <script src="js/validar_form.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <script>
      $("#btnenviar").click(function() {
        var nome = $("#nomes").val();
        $("#n_oficina").attr("value", nome);
    
        var inputs = new Array();

        $(".hidden").each(function()
        {
          inputs.push($(this).val());
        });

        $.post( "abrir_chamado.php", { veiculo: $("#veiculos").val(), tipo: $("tipo").val(), problema: $("#descricao").val(), servico: $("#servico").val(),n_oficina: "["+inputs+"]", cod_cliente: $("#cod_cliente").val() } );
      });
      $('#btnchamados').on('click', function() {
        $('#chamados').show(1000);
        $('#andamento').css("display", "none");
      });
      $('#btnandamento').on('click', function() {
        $('#andamento').toggle(1000);
        $('#chamados').css("display", "none");
      });
      $("#enviar").click(function() {
        var form = $("#form");
        form.valid();
        if (form.valid() == true) {
          $("#oficinas").modal("show");
        }


        $('html').on('keyup', '.nomes', function (){
          var target = $(this).closest('[data-id]');
          $("#lista_nomes_"+target.data("id")+" button").remove();
          $.post("search.php", 
            { texto: $(this).val()},
            function(data){ 
              var obj = jQuery.parseJSON(data);
              for (var i in obj) {
                $("#lista_nomes_"+target.data("id")).append("<button  href='#' value='"+obj[i].codigo+"' id='botao"+i+"' class='escolha'>"+obj[i].nome+"</button>");
              }

            }
            );
        }).keydown(function(){
          var target = $(this).closest('[data-id]');
          $("#lista_nomes_"+target.data("id")+" button").remove();
        });



        $('html').on('click', '.escolha', function (){
          var target = $(this).closest('[data-id]');
          var botao = $(this).val();
          $("#teste"+target.data("id")).remove();
          alert(botao)
          var num =target.data("id");
          $("#nome"+target.data("id")).remove();
          $("#nome_"+target.data("id")).val($(this).text());
          $("#lista_nomes_"+target.data("id")).append("<input type='hidden' id='teste"+num+"' class='hidden' value='"+botao +"'>");

        })
        



        var id = 1;
        $('html').on('click', '#addoficina', function (){

          id++;
          var teste   ="<br><div  data-id="+ id +">"+
          "<div class='input-group'>"+
          "<input name='noficina' list='lista_nomes' id='nome_"+id+"' class='form-control nomes' data-live-search='true' style='border-top-left-radius:3px; border-bottom-left-radius:3px; border-top-right-radius: 0px;border-bottom-right-radius: 0px; margin-left: 5px;height: 36px;width: 362px;'>"+

          "<div class='input-group-btn'>"+
          "<button class='btn btn-default' id='addoficina' style='border-top-left-radius:0px; border-bottom-left-radius:0px;border-top-right-radius: 3px;border-bottom-right-radius: 3px; height: 36px' type='submit'>"+
          "<i class='fas fa-plus'></i>"+
          "</button></div></div><div  id=lista_nomes_"+id+"  style='border: 1px solid #000; margin-top:0px; width: 100%; background-color: white; position: relative;''></div></div></div>";
          $("#corpo").append(teste);

        });

      });
    </script>

  </body>

  </html>
  <?php
}
else
{

  session_destroy();


  ?>
  <script>
    alert("Acesso Inválido!");
    document.location.href = "login.php";
  </script>
  <?php
}
}
?>