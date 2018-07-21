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
      <title>Oficina Pro</title>
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
      <!-- Bootstrap CSS CDN -->
      <link rel="stylesheet" href="scss/main.css">
      <!-- Our Custom CSS -->
      <link rel="stylesheet" type="text/css" href="css/style.css">




    </head>
    <body>




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
      <div class="wrapper">
        <!-- Sidebar  -->
        <nav id="sidebar">
          <div class="sidebar-header">
            <h3>OficinaPro</h3>
          </div>

          <ul class="list-unstyled components">

            <li class="active">

              <li>
                <a id="aparecer2" href="#">Meus veículos</a>
              </li>
              <li>
                <a id="aparecer" href="#">Cadastrar veículo</a>
              </li>
              <li>
                <a id="btnalterar" href="#">Alterar veículos</a>
                
              </li>
              <li>
                <a id="btnexcluir" href="#">Excluir Veículos</a>
              </li>

            </li>

          </ul>

          <ul class="list-unstyled CTAs">
            <li><a>Configurações</a></li>
            <li>
              <a href="form_alterar_usuario.php">Alterar Informções de conta</a>
            </li>
            <li>
              <a>Ajuda</a>
            </li>
          </ul>
        </nav>

        <!-- Page Content  -->
        <div id="content">

          <?php
          require("navbar_logout.html");
          ?>

          <script src="js/jquery.mask.min.js"></script>
          
          <div class="row">
            <div class="col-sm" id="escondido" style="display: none;"><br>
              <center>
                <h4>Cadastrar novo carro</h4>
              </center>
              <form method="POST" action="cadastrar_veiculo.php">
                <div class="row">
                  <div class="col-4"> Placa:<input type="text" class="form-control inplaca" id="placa" name="placa" required></div>
                  <div class="col-4"> Cor: <select name="cor" class="form-control" id="cor" required> <option value="">Selecione um cor
                  </option><option value="azul">azul
                  </option> </select> </div>
                  <div class="col-4"> Ano: <select  class="form-control year" name="ano" id="year" required>
                    <option value="">Selecione o ano</option> </select> </div>
                  </div>
                  <div class="row">
                    <div class="col-4">
                      Tipo:
                      <select name="tipo" class="form-control tipo" required>

                        <option value="carro">Carros</option>
                        <option value="moto">Motos</option>
                        <option value="caminhão">Caminhão</option>


                      </select>
                    </div>
                    <div class="col-4">
                      Marcas:
                      <select  name="marca" class="form-control marcas selectpicker" data-live-search="true" id="marcas" required>

                        <option value="">Selecione uma Marca</option>
                      </select>
                    </div>

                    <div class="col-4">
                      <div class="div" id="div"></div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-sm">
                      <center><br><a class="btn btn-secondary" href="login.php">Cancelar</a>
                        <button type="submit" value="0" name="opcao" class="btn btn-primary">Enviar</button></center>
                      </form> </div>

                    </div>
                  </div>
                  <div class="col-sm" id="escondido3" style="display: none;"><br>
                    
                    <form method="POST" action="cadastrar_veiculo.php">
                    <center>
                      <h4>Alterar informações do Veículo</h4>
                    </center>
                    <div class="row">
                      <div class="col-4">Placa:<input type="form" class="form-control inplaca" id="placa" name="placa" required> </div>
                      <div class="col-4">Cor: <select name="cor" class="form-control" name="cor" id="cor" required> <option value="">Selecione um cor
                      </option><option value="azul">azul
                      </option> </select> </div>
                      <div class="col-4"> Ano: <select name="ano" class="form-control year" name="ano" id="year" required>
                        <option value="">Selecione o ano</option> </select> </div>
                      </div>
                      <div class="row">
                        <div class="col-4">
                          Tipo:
                          <select name="tipo"  class="form-control tipo" id="tipo" required>

                            <option value="carro">Carros</option>
                            <option value="moto">Motos</option>
                            <option value="caminhao">Caminhão</option>


                          </select>
                        </div>
                        <div class="col-4">
                          Marcas:
                          <select name="marca" class="form-control marcas" id="marcas" required>

                            <option value="">Selecione uma Marca</option>
                          </select>
                        </div>
                        <input type="hidden" value="" id="codigo" name="codigo">
                        <div class="col-4">
                          <div class="div" id="div"></div>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-sm">
                          <center><br><a class="btn btn-secondary" href="login.php">Cancelar</a>
                            <button type="submit" value="1" name="opcao" class="btn btn-primary">Enviar</button></center>
                          </div>
                        </form>
                      </div>
                    </div>

                    <div class="col-sm" id="escondido2" style="display: block;"><br>
                      <center>
                        <h4 id="titulo">ESSe TEXTO VAI MUDAR QUANDO CLICAR NO BOTAO AGUENTA AÍ</h4>
                        <ul style="text-align: left;" class="list-group">

                          <?php
                          $x = 0;
                          while ($vetor_veiculo = mysqli_fetch_array($veiculo_resultado)) {

                            echo "<li class='list-group-item itens'><p style='display:inline-block;'  class='placa'>Placa: " . $vetor_veiculo['placa']. "</p><a class='aexcluir' style='display:none;' href='excluir_veiculo.php?placa=".$vetor_veiculo['placa']."'aria-label='Close'><i class='fas fa-times close'></i></a><button value= 'edit".$x."' class='btn btn-primary aalterar' style='display:none;' href='#' aria-label='Edit'><i class='fas fa-pencil-alt edit'></i></button><br> Tipo: ". $vetor_veiculo['tipo']."  Modelo:  " . $vetor_veiculo['modelo']. " Marca: ".$vetor_veiculo['marca']." Ano: ".$vetor_veiculo['ano']."</li>


                              <input type='hidden' id='pedit".$x."' value='".$vetor_veiculo['placa']."''>
                              <input type='hidden' id='tedit".$x."' value='".$vetor_veiculo['tipo']."''>
                              <input type='hidden' id='medit".$x."' value='".$vetor_veiculo['marca']."''>
                              <input type='hidden' id='aedit".$x."' value='".$vetor_veiculo['ano']."''>
                              <input type='hidden' id='cedit".$x."' value='".$vetor_veiculo['cod_veiculo']."''>


                            ";
                            $x = $x + 1 ;

                            
                          }

                          ?>
                          <div id="cagada"></div>
                        </ul>

                      </center>
                    </div>

                  </div>
                </div>
              </div>
            </div>


            <script>
              $(document).ready(function () {
                $('#sidebarCollapse').on('click', function () {
                  $('#sidebar').toggleClass('active');
                });
              });
            </script>
            <script type="text/javascript">
              var today = new Date(),
              yyyy = today.getFullYear(),
              inpYear = $('#expYear'),
              html = '';

              for (var i = 0; i < 40; i++, yyyy--) {

                $('.year').append($("<option></option>").attr("value", yyyy).text(yyyy));
              };

              console.log(html);

            </script>
            <script>
              $(document).ready(function() {

                $(".tipo")
                .change(function() {

                  $(".tipo option:selected").each(function() {

                    tipo = $(this).val();
                    $('.marcas').children('option:not(:first)').remove();
                    $.getJSON('http://fipeapi.appspot.com/api/1/' + tipo + '/marcas.json', function(data) {


                      for (var i in data) {
                        $('.marcas').append($("<option></option>").attr("value", data[i].id).text(data[i].fipe_name));
                      }


                      var elect = 'Modelo:<select name="modelo" class="form-control"><option>Selecione um Modelo</option></select>'
                      $('.div').html(elect);

                    });

                  });

                })
                .change();

                $(".marcas")
                .change(function() {

                  $(".marcas option:selected").each(function() {

                    str = $(this).val();

                    $.getJSON('http://fipeapi.appspot.com/api/1/' + tipo + '/veiculos/' + str + '.json', function(data) {

                      var select = 'Modelo:<select name="modelo" class="form-control">';
                      for (var i in data) {

                        select += '<option value="' + data[i].id + '">' + data[i].name + '</option>';

                      }
                      select += '</select>';
                      $('.div').html(select);

                    });
                  });

                })
                .change();

              });
              $("#aparecer").click(function() {
                $("#escondido").css("display", "none");
                $("#escondido").slideDown(1000);
                $("#escondido2").css("display", "none");
                $("#alterar").css("display", "none");
              });
              $("#aparecer2").click(function() {
                $("#escondido2").css("display", "none");
                $("#escondido2").slideDown(1000);
                $("#escondido").css("display", "none");
                $("#alterar").css("display", "none");
                $(".close").css("display", "none");
                $(".aalterar").css("display", "none");
                $("#escondido3").css("display", "none");
              });
              $("#btnexcluir").click(function() {
                $("#escondido2").css("display", "none");
                $("#escondido2").slideDown(1000);
                $("#escondido").css("display", "none");
                $(".aexcluir").css("display", "inline-block");
                $(".aexcluir").css("float", "right");
                $(".aalterar").css("display", "none");
                $(".close").css("color", "red");
                $(".close").css("display", "block");
                $("#escondido3").css("display", "none");
              });
              $("#btnalterar").click(function() {
                $("#escondido2").css("display", "none");
                $("#escondido2").slideDown(1000);
                $("#escondido").css("display", "none");
                $(".aalterar").css("display", "inline-block");
                $(".aalterar").css("float", "right");
                $(".aexcluir").css("display", "none");
                $(".edit").css("color", "white");
                $(".edit").css("display", "block");
                $("#escondido3").css("display", "none");
              });
              $("#escondido3").appendTo("#cagada");
              $(".aalterar").click(function() {


              
                $("#cagada").insertAfter(this);
                $("#escondido3").css("display", "none");
                $("#escondido3").toggle(1000);
                var placa = "#p"+ $(this).val();
                var texto = $(placa).val();
                $(".inplaca").val(texto);
                var tipo = "#t"+ $(this).val();
                 texto = $(tipo).val();

                $('#tipo option').each(function() {

                  if($(this).val() == texto) {
                    $(this).attr('selected', true);
                  }
                });
                var marca = "#m"+ $(this).val();
                var codigo = "#c"+ $(this).val();
                var test = $(codigo).val();
                $("#codigo").attr('value', test );
                 texto = $(marca).text();

                $('.marcas option').each(function() {

                  if($(this).val() == texto) {
                    $(this).attr('selected', true);
                  }
                });

              });


            </script>
            <script>
              $('.inplaca').mask('ZZZ-0000', {
                translation: {
                  'Z': {
                    pattern: /[a-z\s]/
                  }
                }
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
