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
         <script
         src="https://code.jquery.com/jquery-3.2.0.min.js"
         integrity="sha256-JAW99MJVpJBGcbzEuXk4Az05s/XyDdBomFqNlM3ic+I="
         crossorigin="anonymous"></script>
         <script type="text/javascript" src="js/jquery.mask.min.js"></script>


         <form method="POST" action="cadastrar_veiculo.php">
           <div class="row">
            <div class="col-3">
              Placa:<input type="form-control" class="form-control" id="placa" name="placa">
            </div>
            <div class="col-3">
              Cor:
              <select name="cor" class="form-control" name="cor" id="cor">
                <option>Selecione um cor</option>
              </select>
            </div>
            <div class="col-2">
              Cor:
              <select name="ano" class="form-control" name="ano" id="ano">
                <option>Selecione o anox</option>
              </select>
            </div>

          </div>
          <div class="row">
            <div class="col-3">
              Marca:
              <select name="marca" class="form-control" id="marcas">
                <option  value="">Selecione uma Marca</option></select>
              </div>

              <div class="col-5">
                <div id="div"></div>
              </div>
            </div>
            <br>
            <div class="row">
              <div class="col-8">
                <center><a  class="btn btn-secondary" href="login.php">Cancelar</a>
                  <button type="submit" class="btn btn-primary">Enviar</button></center></div></div>
                </form>



                <script>

                  $( document ).ready(function() {

                    $.getJSON('http://fipeapi.appspot.com/api/1/carro/marcas.json', function(data) {
                      var select = ''

                      for (var i in data) {

                        select += '<option value="'+ data[i].id +'">'+ data[i].fipe_name + '</option>';

                      }

                      $('#marcas').append(select);
                      var elect = 'Modelo:<select name="modelo" class="form-control"><option>Selecione um Modelo</option></select>' 
                      $('#div').html(elect); 

                    });


                    $( "#marcas" )
                    .change(function () {

                      $( "#marcas option:selected" ).each(function() {

                        str = $( this ).val();

                        $.getJSON('http://fipeapi.appspot.com/api/1/carros/veiculos/'+str+'.json', function(data) {

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