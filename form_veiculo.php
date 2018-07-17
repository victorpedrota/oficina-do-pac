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
      <script
      src="https://code.jquery.com/jquery-3.2.0.min.js"
      integrity="sha256-JAW99MJVpJBGcbzEuXk4Az05s/XyDdBomFqNlM3ic+I="
      crossorigin="anonymous"></script>
      <script type="text/javascript" src="js/jquery.mask.min.js"></script>
      <div class="container" style="margin-top: 60px">
        <form method="POST" action="cadastrar_veiculo.php">

          <div class="row">
            <div class="col-sm">
              <div class="row">
                <div class="col-4">
                  Placa:<input type="form-control" class="form-control" id="placa" name="placa" required="">
                </div>
                <div class="col-4">
                  Cor:
                  <select name="cor" class="form-control" name="cor" id="cor" required>
                    <option>Selecione um cor</option>
                  </select>
                </div>
                <div class="col-4">
                  Ano:
                  <select name="ano" class="form-control" name="ano" id="ano" required>
                    <option>Selecione o ano</option>
                  </select>
                </div>
                
              </div>
              <div class="row">
                <div class="col-4">
                  Tipo:
                  <select name="tipo" class="form-control" id="tipo" required>

                    <option  value="carros">Carros</option>
                    <option  value="motos">Motos</option>
                    <option  value="caminhao">Caminhão</option>
                  </select>
                  </div>
                  <div class="col-4">
                    Marcas:
                  <select name="marcas" class="form-control" id="marcas" required>

                    <option  value="">selecione uma Marca</option>
                    </select>
                  </div>

                  <div class="col-4">
                    <div id="div"></div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-8">
                    <center><br><a  class="btn btn-secondary" href="login.php">Cancelar</a>
                      <button type="submit" class="btn btn-primary">Enviar</button></center></div></div>
                    </div>
                    <script>

                      $( document ).ready(function() {

                        $( "#tipo" )
                        .change(function () {

                          $( "#tipo option:selected" ).each(function() {

                            tipo = $( this ).val();
                            $('#marcas').children('option:not(:first)').remove();
                            $.getJSON('http://fipeapi.appspot.com/api/1/' + tipo +'/marcas.json', function(data) {

                          
                              for (var i in data) {
                                $('#marcas').append($("<option></option>").attr("value", data[i].id).text(data[i].fipe_name));
                              }

                      
                              var elect = 'Modelo:<select name="modelo" class="form-control"><option>Selecione um Modelo</option></select>' 
                              $('#div').html(elect);

                            });

                          });

                        })
                        .change();

                        $( "#marcas" )
                        .change(function () {
                          
                          $( "#marcas option:selected" ).each(function() {

                            str = $( this ).val();
                      
                            $.getJSON('http://fipeapi.appspot.com/api/1/'+tipo+'/veiculos/'+str+'.json', function(data) {

                              var select = 'Modelo:<select name="modelo" class="form-control">';
                              for (var i in data) {

                                select += '<option value="'+data[i].id +'">'+ data[i].name + '</option>';

                              }
                              select += '</select>';
                              $('#div').html(select);

                            });
                          });

                        })
                        .change();

                      });

                      $('#placa').mask('ZZZ-0000', { translation: {'Z': {pattern: /[a-z\s]/
                      }
                    }
                  });
                </script>

                <div class="col-sm">
                  One of three colsumns
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