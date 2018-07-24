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
                <a class="nav-link" href="form_veiculo.php">Gerenciar Veículos</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="#" id="btnchamados" >Iniciar Chamado
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="#" id="btnalterar" >Alterar veículo
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="#" id="btnexcluir" >Excluir veículo
                </a>
              </li>
              
            </ul>
          </div>
        </nav>

        <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">
          <!--AQUI ESTARÁ A PORRA DO CÓDIGO DA PORRA DO CHAMADO, PEDRO É UMA PUTA  -->
    <div id="chamados" style="display: none;">

      <form>
        <div class="row">
          <div class="col">
            Veiculo:
            <select class="form-control" id="veiculos" required>
              <option value="">Selecione um Veículo</option>
              <?php 
              while ($vetor_veiculo = mysqli_fetch_array($veiculo_resultado)) {
                echo "<option value=".$vetor_veiculo['modelo'].">Modelo:  ".$vetor_veiculo['modelo']."      Placa:  ".$vetor_veiculo['placa']."</option>";
              }
              ?>
            </select>
          </div>
          <div class="col">
            Tipo de serviço: <i class="fas fa-info-circle"></i>
            <select class="form-control">

            </select>
          </div>
        </div>
        Descrição do problema:<textarea style="border-radius: 1em;" class="form-control"></textarea> Serviço desejado:<textarea style="border-radius: 1em;" class="form-control"></textarea>
        <center><br><a class="btn btn-secondary" href="#">Cancelar</a>
          <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">Enviar</button></center>
        </form>


      </div>

    </div>
        </main>
      </div>
    </div>

    <div class="msg_box" id="mconversas" style="right: 10px;">
      <div class="msg_head">Conversas
      </div>
      <div class="msg_wrap" id="conversas">
        <div class="msg_body">

          <div class="msg_push"></div>
        </div>
        <div class="msg_footer"></div>
      </div>
    </div>


    
  </div>
  <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Escolha a(s) oficina(s)</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <div class="input-group mb-2">
            <div class="input-group-prepend">
              <div class="input-group-text"><i class="fas fa-plus"></i></div>
            </div>
            <select style="border-top-left-radius:0em;border-bottom-left-radius: 0em;" class="form-control" id="inlineFormInputGroup">
              <?php 
              while ($vetor_oficina = mysqli_fetch_array($oficinas_query)) {
                echo "<option value=''>Modelo:  ". $vetor_oficina['nome']."</option>";
              }
              ?>
            </select>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="button" class="btn btn-primary">Save changes</button>
        </div>
      </div>
    </div>
  </div>





  <script>
    $(document).ready(function() {
      $('#conversas').hide();
      $('#mconversas').on('click', function() {
        $('#conversas').slideToggle('slow');
      });
      $('#sidebarCollapse').on('click', function() {
        $('#sidebar').toggleClass('active');
      });
      $('#btnchamados').on('click', function() {
        $('#chamados').toggle(1000);
      });
      $(".flip").mouseenter(function() {
        $(".flip").animate({
          width: 200
        }, "fast");
        $(".panel").animate({
          width: 400
        }, "fast");
        $(".panel").delay(200).slideDown("fast");
      });

      var arr = [];

      $(document).on('click', '.msg_head', function() {
        var chatbox = $(this).parents().attr("rel");
        $('[rel="' + chatbox + '"] .msg_wrap').slideToggle('slow');
        return false;
      });


      $(document).on('click', '.close', function() {
        var chatbox = $(this).parents().parents().attr("rel");
        $('[rel="' + chatbox + '"]').hide();
        arr.splice($.inArray(chatbox, arr), 1);
        displayChatBox();
        return false;
      });

      $(document).on('click', '#sidebar-user-box', function() {

        var userID = $(this).attr("class");
        var username = $(this).children().text();

        if ($.inArray(userID, arr) != -1) {
          arr.splice($.inArray(userID, arr), 1);
        }

        arr.unshift(userID);
        chatPopup = '<div class="msg_box" style="right:270px" rel="' + userID + '">' +
        '<div class="msg_head">' + username +
        '<div class="close">x</div> </div>' +
        '<div class="msg_wrap"> <div class="msg_body"> <div class="msg_push"></div> </div>' +
        '<div class="msg_footer"><textarea class="msg_input" rows="4"></textarea></div>  </div>  </div>';

        $("body").append(chatPopup);
        displayChatBox();
      });


      $(document).on('keypress', 'textarea', function(e) {
        if (e.keyCode == 13) {
          var msg = $(this).val();
          $(this).val('');
          if (msg.trim().length != 0) {
            var chatbox = $(this).parents().parents().parents().attr("rel");
            $('<div class="msg-right">' + msg + '</div>').insertBefore('[rel="' + chatbox + '"] .msg_push');
            $('.msg_body').scrollTop($('.msg_body')[0].scrollHeight);
          }
        }
      });



      function displayChatBox() {
                i = 270; // start position
                j = 260; //next position

                $.each(arr, function(index, value) {
                  if (index < 4) {
                    $('[rel="' + value + '"]').css("right", i);
                    $('[rel="' + value + '"]').show();
                    i = i + j;
                  } else {
                    $('[rel="' + value + '"]').hide();
                  }
                });
              }


            });
          </script>
          <script>
            function update() {
              $.post("server.php", {}, function(data) {
                $("#screen ").text(data);
              });

              setTimeout('update()', 1000);
            }

            $(document).ready(

              function() {
                update();

                $("#send").click(
                  function() {
                    $.post("server.php", {
                      message: $("#message").val()
                    },
                    function(data) {


                      $("#screen").val(data);

                      $("#message").val("");

                    }
                    );
                  }
                  );
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