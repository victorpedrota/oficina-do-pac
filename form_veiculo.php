<?php

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
      <link href="sccs/main.css" type="text/css">
      <link rel="stylesheet" type="text/css" href="css/style.css">


    </head>
    <body>
     <?php
     require("navbar_logout.html");
     ?>
     <script src="https://code.jquery.com/jquery-3.2.0.min.js" integrity="sha256-JAW99MJVpJBGcbzEuXk4Az05s/XyDdBomFqNlM3ic+I=" crossorigin="anonymous"></script>
     <script type="text/javascript" src="js/jquery.mask.min.js"></script>

     <script type="text/javascript" >

      function limpa_formulário_cep() {
            //Limpa valores do formulário de cep.
            document.getElementById('rua').value=("");
            document.getElementById('bairro').value=("");
            document.getElementById('cidade').value=("");
            document.getElementById('uf').value=("");

          }

          function meu_callback(conteudo) {
            if (!("erro" in conteudo)) {
            //Atualiza os campos com os valores.
            document.getElementById('rua').value=(conteudo.logradouro);
            document.getElementById('bairro').value=(conteudo.bairro);
            document.getElementById('cidade').value=(conteudo.localidade);
            document.getElementById('uf').value=(conteudo.uf);

        } //end if.
        else {
            //CEP não Encontrado.
            limpa_formulário_cep();
            alert("CEP não encontrado.");
          }
        }

        function pesquisacep(valor) {

        //Nova variável "cep" somente com dígitos.
        var cep = valor.replace(/\D/g, '');

        //Verifica se campo cep possui valor informado.
        if (cep != "") {

            //Expressão regular para validar o CEP.
            var validacep = /^[0-9]{8}$/;

            //Valida o formato do CEP.
            if(validacep.test(cep)) {

                //Preenche os campos com "..." enquanto consulta webservice.
                document.getElementById('rua').value="...";
                document.getElementById('bairro').value="...";
                document.getElementById('cidade').value="...";
                document.getElementById('uf').value="...";


                //Cria um elemento javascript.
                var script = document.createElement('script');

                //Sincroniza com o callback.
                script.src = 'https://viacep.com.br/ws/'+ cep + '/json/?callback=meu_callback';

                //Insere script no documento e carrega o conteúdo.
                document.body.appendChild(script);

            } //end if.
            else {
                //cep é inválido.
                limpa_formulário_cep();
                alert("Formato de CEP inválido.");
              }
        } //end if.
        else {
            //cep sem valor, limpa formulário.
            limpa_formulário_cep();
          }
        };

      </script>

      <div class="container">
       <div id="wrapper">

        <div id="sidebar-wrapper">
          <ul class="sidebar-nav">
            <li class="sidebar-brand">
              <a>
                Configurações da Conta
              </a>
            </li>
            <li>
              <a id="aparecer" href="#">Cadastrar</a>

            </li>
            <li>
              <a id="aparecer2" href="#">Meus veículos</a>

            </li>
            <li>
              <a id="aparecer2" href="#">Alterar</a>

            </li>
            <li>
              <a id="aparecer2" href="#">Excluir</a>

            </li>


          </ul>
        </div>



        <br>
        <br>

        <form method="POST" action="cadastrar_veiculo.php">



          <div class="row">

            <div class="col-sm" id="escondido" style="display: block;"><br>
              <center>
                <h4>Cadastrar novo carro</h4>
              </center>
              <div class="row">
                <div class="col-4"> Placa:<input type="form-control" class="form-control" id="placa" name="placa" required> </div>
                <div class="col-4"> Cor: <select name="cor" class="form-control" name="cor" id="cor" required> <option value="">Selecione um cor
                </option><option value="azul">azul
                </option> </select> </div>
                <div class="col-4"> Ano: <select name="ano" class="form-control" name="ano" id="year" required>
                  <option value="">Selecione o ano</option> </select> </div>
                  <script type="text/javascript">
                    var today = new Date(),
                    yyyy = today.getFullYear(),
                    inpYear = $('#expYear'),
                    html = '';

                    for (var i = 0; i < 40; i++, yyyy--) {

                      $('#year').append($("<option></option>").attr("value", yyyy).text(yyyy));
                    };

                    console.log(html);

                  </script>
                </div>
                <div class="row">
                  <div class="col-4">
                    Tipo:
                    <select name="tipo" class="form-control" id="tipo" required>

                      <option value="carros">Carros</option>
                      <option value="motos">Motos</option>
                      <option value="caminhao">Caminhão</option>
                      

                    </select>
                  </div>
                  <div class="col-4">
                    Marcas:
                    <select name="marcas" class="form-control" id="marcas" required>

                      <option value="">selecione uma Marca</option>
                    </select>
                  </div>

                  <div class="col-4">
                    <div id="div"></div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-sm">
                    <center><br><a class="btn btn-secondary" href="login.php">Cancelar</a>
                      <button type="submit" class="btn btn-primary">Enviar</button></center>
                    </div>
                  </div>
                </div>

                <div class="col-sm" id="escondido2" style="display: none;"><br>
                  <center>
                    <h4>Carros ja cadastrados</h4>
                    <ul style="text-align: left;" class="list-group">

                      <?php

                      while ($vetor_veiculo = mysqli_fetch_array($veiculo_resultado)) {
                        echo "  <li class='list-group-item'>PLaca:" . $vetor_veiculo['placa']. " Modelo:" . $vetor_veiculo['modelo']. "<button style='color:red;' type='button' class='close' aria-label='Close'>
                        <span aria-hidden='true'>&times;</span>
                        </button></li> ";
                      }

                      ?>
                    </ul>
                  </center>
                </div>
              </div>
            </div>
            <script>
              $(document).ready(function() {

                $("#tipo")
                .change(function() {

                  $("#tipo option:selected").each(function() {

                    tipo = $(this).val();
                    $('#marcas').children('option:not(:first)').remove();
                    $.getJSON('http://fipeapi.appspot.com/api/1/' + tipo + '/marcas.json', function(data) {


                      for (var i in data) {
                        $('#marcas').append($("<option></option>").attr("value", data[i].id).text(data[i].fipe_name));
                      }


                      var elect = 'Modelo:<select name="modelo" class="form-control"><option>Selecione um Modelo</option></select>'
                      $('#div').html(elect);

                    });

                  });

                })
                .change();

                $("#marcas")
                .change(function() {

                  $("#marcas option:selected").each(function() {

                    str = $(this).val();

                    $.getJSON('http://fipeapi.appspot.com/api/1/' + tipo + '/veiculos/' + str + '.json', function(data) {

                      var select = 'Modelo:<select name="modelo" class="form-control">';
                      for (var i in data) {

                        select += '<option value="' + data[i].id + '">' + data[i].name + '</option>';

                      }
                      select += '</select>';
                      $('#div').html(select);

                    });
                  });

                })
                .change();

              });
              $("#aparecer").click(function() {
                $("#escondido").slideDown(1000);
                $("#escondido2").css("display", "none");
              });
              $("#aparecer2").click(function() {
                $("#escondido2").slideDown(1000);
                $("#escondido").css("display", "none");
              });

              $('#placa').mask('ZZZ-0000', {
                translation: {
                  'Z': {
                    pattern: /[a-z\s]/
                  }
                }
              });
            </script>

            <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
            <!-- Popper.JS -->
            <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js" integrity="sha384-cs/chFZiN24E4KMATLdqdvsezGxaGsi4hLGOzlXwp5UZB1LY//20VyM2taTB4QvJ" crossorigin="anonymous"></script>
            <!-- Bootstrap JS -->
            <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js" integrity="sha384-uefMccjFJAIv6A+rW+L4AHf99KvxDjWSu1z9VI8SKNVmz4sk7buKt/6v9KI65qnm" crossorigin="anonymous"></script>

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
            document.location.href = "login.php";
          </script>
          <?php
        }
      }
      ?>
