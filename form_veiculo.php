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
      <style type="text/css">
      .placa{

        text-transform: uppercase;
      }
      
    </style>

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

      <?php
      require("navbar_logout.html");
      ?>
      <div class="container-fluid">
        <div class="row">
          <nav class="col-md-2 d-none d-md-block bg-light sidebar">
            <div class="sidebar-sticky">
              <ul class="nav flex-column">
                <li class="nav-item">
                  <a class="nav-link active" href="#">
                    <span data-feather="home"></span>
                    Gerenciar veiculo <span class="sr-only">(current)</span>
                  </a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" id="aparecer2" href="#">Meus veículos</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="#" id="aparecer" >Cadastrar veículo
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
            <div class="row">
              <div class="col">
                <div class="row">
                  <div class="col-sm vamo" id="escondido" style="display: none;"><br>
                    <center>
                      <h4>Cadastrar novo carro</h4>
                    </center>
                    <form method="POST" action="cadastrar_veiculo.php">
                      <div class="row" >
                        <div class="col-4"> Placa:<input type="text" class="form-control inplaca" id="placa" name="placa" required></div>
                        <div class="col-4"> Cor: <select name="cor" style="" class="form-control" id="cor" required> <option value="">Selecione um cor
                        </option><option value="azul">azul
                        </option> </select> </div>
                        <div class="col-4"> Ano: <select  class="form-control year" name="ano" id="year" required>
                          <option value="">Selecione o ano</option> </select> </div>
                        </div>
                        <div class="row">
                          <div class="col-4">
                            Tipo:
                            <select name="tipo" class="form-control tipo" id="tipo" required>
                              <option value="">Selecione um Tipo</option>
                              <option value="carro">Carro</option>
                              <option value="motos">Motos</option>
                              <option value="caminhao">Caminhão</option>


                            </select>
                          </div>
                          <div class="col-4">
                            <input type="hidden" value="" name="marca" id="hmarca">
                            Marcas:
                            <select  class="form-control marcas selectpicker" data-live-search="true" id="marcas" required>

                              <option value="">Selecione uma Marca</option>
                            </select>
                          </div>

                          <div class="col-4">

                            Modelo:
                            <select class="form-control modelo" name="modelo" id="modelo" required>
                              <option value="">Selecione um modelo</option>
                            </select>


                          </div>
                        </div>
                        <div class="row">
                          <div class="col-sm">
                            <center><br><a class="btn btn-secondary" href="login.php">Cancelar</a>
                              <button type="submit" value="0" id= "btnenviar" name="opcao" class="btn btn-primary">Enviar</button></center>
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
                                  <select name="tipo"  class="form-control"required>

                                    <option value="carros">Carros</option>
                                    <option value="moto">Motos</option>
                                    <option value="caminhao">Caminhão</option>


                                  </select>
                                </div>
                                <div class="col-4">
                                  Marcas:
                                  <select name="marca" class="form-control" required>

                                    <option value="">Selecione uma Marca</option>
                                  </select>
                                </div>
                                <input type="hidden" value="" id="codigo" name="codigo">
                                <div class="col-4">
                                  Modelo:
                                  <select class="form-control modelo" name="modelo" id="modelo" required>
                                    <option value="">Selecione um modelo</option>
                                  </select>
                                </div>
                              </div>
                              <div class="row">
                                <div class="col-sm">
                                  <center><br><a class="btn btn-secondary btncancelar" href="#">Cancelar</a>
                                    <button type="submit" value="1" name="opcao"  class="btn btn-primary">Enviar</button></center>
                                  </div>
                                </form>
                              </div>
                            </div>

                            <div class="col-sm" id="escondido2" style="display: block;"><br>
                              <center>
                                <h4 id="titulo">Veículos Cadastrados</h4>
                                <div id="info"></div>
                                <ul style="text-align: left;" class="list-group">

                                  <?php
                                  $x = 0;
                                  while ($vetor_veiculo = mysqli_fetch_array($veiculo_resultado)) {

                                    echo "<li class='list-group-item itens'>Placa:<p style='display:inline-block;'  class='placa'> " . $vetor_veiculo['placa']. "</p><a class='aexcluir' style='display:none;' href='excluir_veiculo.php?placa=".$vetor_veiculo['placa']."'aria-label='Close'><i class='fas fa-times close'></i></a><button value= 'test".$x."' class='btn btn-primary aalterar' style='display:none;' href='#' aria-label='Edit'><i class='fas fa-pencil-alt edit'></i></button><br> Tipo: ". $vetor_veiculo['tipo']."  Modelo:  " . $vetor_veiculo['modelo']. " Marca: ".$vetor_veiculo['marca']." Ano: ".$vetor_veiculo['ano']."  Cor:".$vetor_veiculo['cor']."
                                    <div style='display:none;' id='oi".$x."' class='semvergonha info test".$x."'>
                                    <input type='hidden' name= 'plano'>

                                    <form method='POST' action='cadastrar_veiculo.php'>
                                    <input type='hidden' name='codigo' value=".$vetor_veiculo['cod_veiculo'].">
                                    <div class='row'>
                                    <div class='col-4'> Placa:<input value='".$vetor_veiculo['placa']."' type='text' class='form-control inplaca placa' id='placa' name='placa' required></div>
                                    <input type='hidden' value='".$vetor_veiculo['cor']."' name='altera_cor'>
                                    <div class='col-4'> Cor: <select name='cor' style='' class='form-control' id='cor' required> <option value=''>Selecione um cor
                                    </option><option value='azul'>azul
                                    </option> </select> </div>
                                    <div class='col-4'> Ano: <select  class='form-control year' name='ano' id='year' required>
                                    <option value=''>Selecione o ano</option> </select> </div>
                                    </div>
                                    <input type='hidden' value='".$vetor_veiculo['ano']."' name='altera_ano'>
                                    <div class='row'>
                                    <div class='col-4'>
                                    Tipo:
                                    <input type='hidden' value='".$vetor_veiculo['tipo']."' name='altera_tipo'>
                                    <select name='tipo' class='form-control tipo_alterar' id='tipo".$x."' required>

                                    <option value='carro'>Carro</option>
                                    <option value='motos'>Motos</option>
                                    <option value='caminhao'>Caminhão</option>


                                    </select>
                                    </div>
                                    <div class='col-4'>
                                    <input type='hidden' value='' name='marca' id='alterar_hmarca'>
                                    Marcas:
                                    <input type='hidden' value='".$vetor_veiculo['marca']."' name='altera_marca'>
                                    <select name='marcas' class='form-control alterar_marcas selectpicker' data-live-search='true' id='marcas' required>

                                    <option value=''>Selecione uma Marca</option>
                                    </select>
                                    </div>

                                    <div class='col-4'>

                                    Modelo:
                                    <input type='hidden' value='".$vetor_veiculo['modelo']."' name='altera_modelo'>
                                    <select class='form-control modelo_alterar' name='modelo'  required>
                                    <option value=''>Selecione um modelo</option>
                                    <option value=''>Selecione um modelo</option>
                                    </select>


                                    </div>
                                    </div>
                                    <div class='row'>
                                    <div class='col-sm'>
                                    <center><br><a href='#' class='btn btn-secondary cancel'>Cancelar</a>
                                    <button type='submit' value='1' id= 'btnenviar' name='opcao' class='btn btn-primary'>Enviar</button></center>
                                    </form> </div>

                                    </div>
                                    </div>
                                    <div class='col-sm' id='escondido3' style='display: none;'><br>

                                    <form method='POST' action='cadastrar_veiculo.php'>
                                    <center>
                                    <h4>Alterar informações do Veículo</h4>
                                    </center>
                                    <div class='row'>
                                    <div class='col-4'>Placa:<input type='form' class='form-control inplaca' id='placa' name='placa' required> </div>
                                    <div class='col-4'>Cor: <select name='cor' class='form-control' name='cor' id='cor' required> <option value=''>Selecione um cor
                                    </option><option value='azul'>azul
                                    </option> </select> </div>
                                    <div class='col-4'> Ano: <select name='ano' class='form-control year' name='ano' id='year' required>
                                    <option value=''>Selecione o ano</option> </select> </div>
                                    </div>
                                    <div class='row'>
                                    <div class='col-4'>
                                    Tipo:
                                    <select name='tipo'  class='form-control'required>

                                    <option value='carros'>Carros</option>
                                    <option value='moto'>Motos</option>
                                    <option value='caminhao'>Caminhão</option>


                                    </select>
                                    </div>
                                    <div class='col-4'>
                                    Marcas:
                                    <select name='marca' class='form-control alterar_marcas' required>

                                    <option value=''>Selecione uma Marca</option>
                                    </select>
                                    </div>
                                    <input type='hidden' value='' id='codigo' name='codigo'>
                                    <div class='col-4'>
                                    Modelo:
                                    <select class='form-control' name='modelo' id='modelo' required>
                                    <option value=''>Selecione um modelo</option>
                                    </select>
                                    </div>
                                    </div>
                                    <div class='row'>
                                    <div class='col-sm'>
                                    <center><br><a class='btn btn-secondary btncancelar' href='#'>Cancelar</a>
                                    <button type='submit' value='1' name='opcao'  class='btn btn-primary'>Enviar</button></center>
                                    </div>
                                    </form>



                                    </div>
                                    </li>

                                    

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

                    </main>

                  </div>

                </div>
              </div>
            </div>

            <script src="js/jquery.mask.min.js"></script>





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
                    var abc = $(".tipo option:selected").val();
                    var abc2 = $("#escondido").css("display");
                    if(abc != "" && abc2 != "none"){
                      $('.marcas').children('option:not(:first)').remove();
                      $.getJSON('http://fipeapi.appspot.com/api/1/' + tipo + '/marcas.json', function(data) {


                        for (var i in data) {
                          $('.marcas').append($("<option></option>").attr("value", data[i].id).text(data[i].fipe_name));

                        }




                      });
                    }


                  });

                })
                .change();

                $(".marcas")
                .change(function() {

                  $(".marcas option:selected").each(function() {

                    str = $(this).val();
                    text = $(this).text();
                    $("#hmarca").attr("value",text);
                    $('.modelo').children('option:not(:first)').remove();
                    var abc = $(".tipo option:selected").val();
                    var abc2 = $("#escondido").css("display");
                    if(abc != "" && abc2 != "none"){
                      $.getJSON('http://fipeapi.appspot.com/api/1/' + tipo + '/veiculos/' + str + '.json', function(data) {


                        for (var i in data) {

                          $('.modelo').append($("<option></option>").attr("value", data[i].fipe_name).text(data[i].fipe_name));

                        }


                      });
                    }
                  });

                })
                .change();

                $(".tipo_alterar")
                .change(function() {
                  var pai = $(this).parent().parent().parent();
                  
                  
                  $(this).each(function() {

                    tipo = $(this).val();
                   
                      $(pai.find('[name="marcas"]')).children('option:not(:first)').remove();
                      $.getJSON('http://fipeapi.appspot.com/api/1/' + tipo + '/marcas.json', function(data) {


                        for (var i in data) {
                          $(pai.find('[name="marcas"]')).append($("<option></option>").attr("value", data[i].id).text(data[i].fipe_name));

                        }




                      });
                    


                  });

                })
                .change();

                $(".alterar_marcas" )
                .change(function() {

                  $(this).each(function() {

                    str = $(this).val();
                    text = $(this).text();
                  
                    $("#hmarca").attr("value",text);
                     $('.modelo_alterar').children('option:not(:first)').remove();
                     
                      $.getJSON('http://fipeapi.appspot.com/api/1/' + tipo + '/veiculos/' + str + '.json', function(data) {


                        for (var i in data) {

                          $(".modelo_alterar").append($("<option></option>").attr("value", data[i].fipe_name).text(data[i].fipe_name));

                        }


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
  $("#placa").val("");

});
$("#aparecer2").click(function() {
  $("#escondido2").css("display", "none");
  $("#escondido2").slideDown(1000);
  $("#escondido").css("display", "none");
  $("#alterar").css("display", "none");
  $(".close").css("display", "none");
  $(".aalterar").css("display", "none");
  $("#escondido3").css("display", "none");
$(".info").hide();
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
  $("#titulo").text("Excluir Veículo");
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
  $("#titulo").text("Alterar Veículo");
});
$(".cancel").click(function(){
  
  
    $(".info").css("display","none")
  

})
$("#escondido3").appendTo("#cagada");
$(".aalterar").click(function() {
 
  var teste = $(this).val();
  var display = $('.'+teste).css('display');
  var pai = $(this).parent();

  if (display == "none") {
    $(".info").hide(1000);
  }
  $("."+teste).toggle(1000);
  var cor = pai.find('[name="altera_cor"]');
  $(pai.find('[name="cor"]')).val(cor.val());
  var ano = pai.find('[name="altera_ano"]');
  $(pai.find('[name="ano"]')).val(ano.val());

  var tipo = pai.find('[name="altera_tipo"]');
  $(pai.find('[name="tipo"]')).val(tipo.val());
  var marca = pai.find('[name="altera_marca"]');
  var modelo = pai.find('[name="altera_modelo"]');
  

 var oi = $(pai.find('[name="marcas"]')).find('option:contains('+marca.val()+')').val();
  $(pai.find('[name="marcas"]')).val(oi)
                
                  
                  
                   
                      
                      $.getJSON('http://fipeapi.appspot.com/api/1/' + tipo + '/marcas.json', function(data) {


                        for (var i in data) {
                          $(pai.find('[name="marcas"]')).append($("<option></option>").attr("value", data[i].id).text(data[i].fipe_name));

                        }




                      });
                    


              
                   var text = $(pai.find('[name="marcas"]'));
                   var sos = $(text = 'option:selected').val()
                    $("#alterar_hmarca").attr("value",sos);
                     $('.modelo_alterar').children('option:not(:first)').remove();
                     
                      $.getJSON('http://fipeapi.appspot.com/api/1/' + tipo + '/veiculos/' + marca.val() + '.json', function(data) {


                        for (var i in data) {

                          $(".modelo_alterar").append($("<option></option>").attr("value", data[i].fipe_name).text(data[i].fipe_name));

                        }


                      });
                    
                 $(".modelo_alterar").append("<option>"+modelo.val()+"</option>")

});

$(".btncancelar").click(function(){

  $("#escondido3").toggle(1000);
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
