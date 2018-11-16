<?php
    //Mantendo a sessão/cria uma sessao
session_start();

if(!isset($_SESSION["system_control"]))
{
  ?>
  <!doctype html>
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



  $system_control = $_SESSION["system_control"];
  $cod_login = $_SESSION['cod_login'];
  $privilegio = $_SESSION["privilegio"];

  if($system_control == 1 && $privilegio == 1){
    require('connect.php');

    $sql_pesquisa ="SELECT * FROM `mecanico` WHERE `cod_login` = $cod_login" ;
    $resultado = mysqli_query($conn,$sql_pesquisa);
    $vetor = mysqli_fetch_array($resultado);
    $codigo_mecanico = $vetor['cod_mecanico'];
    $sql ="SELECT * FROM `login` WHERE `cod_login` = $cod_login" ;
    $resul = mysqli_query($conn,$sql);
    $vetor_login = mysqli_fetch_array($resul);

    
    $sql_pesquisa ="SELECT * FROM `mecanico` WHERE `cod_login` = $cod_login";
    $resultado = mysqli_query($conn,$sql_pesquisa);
    $vetor = mysqli_fetch_array($resultado);
    $cod_mecanico = $vetor['cod_oficina'];
    $sql_pesquisa3 ="SELECT * FROM `oficina` WHERE `cod_oficina` = $cod_mecanico";
    $resultado3 = mysqli_query($conn,$sql_pesquisa3);
    $vetor_oficina = mysqli_fetch_array($resultado3);


    ?>

    <!DOCTYPE html>
    <html>

    <head>
      <title></title>
      <link rel="stylesheet" href="scss/main.css">
      <link rel="stylesheet" type="text/css" href="css/style.css">
    </head>

    <body>
      <?php
      require("navbar_mecanico.html");
      ?>

      <nav class="col-md-2 d-none d-md-block bg-light sidebar">
        <div class="sidebar-sticky">
          <ul class="nav flex-column">
            <li class="nav-item">
              <a class="nav-link active" href="#">
                <span data-feather="home"></span>
                Alterar informações <span class="sr-only">(current)</span>
              </a>

            </li>
            <li class="nav-item">
              <a class="nav-link" href="" id="feed">Informações de conta</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" id="alterar_informacoess" href="#">Alterar informações
              </a>
            </li>


            <li class="nav-item">
              <a class="nav-link" href="#" data-toggle="modal" data-target="#alterar_senha">
                Alterar senha
              </a>
            </li>



          </ul>
        </div>
      </nav>

      <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">
        <div style="" class="container">
          <center>
            <br>
            <?php echo "<br><strong>".$vetor_oficina['nome']."</strong>"?>
            <div class="show-image" style="width: 100px;margin-top: 40px;">
              <img data-toggle="modal" data-target="#alterar_foto" src=<?php echo $vetor_login['imagem'];?> style="width: 100px;height: 100px; border-radius: 50%;">
              <?php
              
              $teste=0;
              $n=1;
              $sql_nota ="SELECT * FROM `servico` WHERE `cod_mecanico` = $codigo_mecanico" ;
              $resul_nota = mysqli_query($conn,$sql_nota);
              while ($vetor_nota = mysqli_fetch_array($resul_nota)) {
                $var = $vetor_nota['cod_servico'];
                $nota ="SELECT * FROM `avaliacao` WHERE `cod_servico` = $var";
                $resulta = mysqli_query($conn,$nota);

                $numero_nota =  mysqli_num_rows($resulta);
                $n = $numero_nota +$n;
                $vetor_nota2 = mysqli_fetch_array($resulta);
                $nota = $vetor_nota2['nota_usuario'];
                $teste = intval($nota)+intval($teste);

                

              }
              if ($teste == 0) {
                  echo "<i class='fas fa-star' style='color:yellow'></i><strong>Sem avaliações</strong>";
                }
                else{
                  echo "<i class='fas fa-star' style='color:yellow'></i><strong>" . ($teste/$n)."</strong>";
                }
              

              ?>
            </div>

            <h5 style="margin-top: ">

              <?php echo $vetor['nome'] . " " . $vetor['sobrenome']; ?>
            </h5>
          </center>
          <hr>

          <form method="POST" action="alterar_mecanico.php" id="alterar">
            <div id="erro_alterar"></div>

            <label for="inputPassword4">Telefone:</label>
            <div id="telefone" class="telefone"> <?php echo $vetor['telefone']; ?></div>


            <div class="form-row">
              <div class="col-md-6">
                <label for="inputAddress">Celular:</label>
                <div id="celular" class="telefone"> <?php echo $vetor['celular']; ?></div>

              </div>
              <div class="col-md-6">
                <label for="inputAddress2">CEP:</label>
                <div id="cep" class="cep"><?php echo $vetor['cep']; ?></div>
              </div>
            </div>
            <div class="form-row">
              <div class="form-group col-md-6">
                <label for="inputCity">Estado:</label>
                <div class="uf" id="uf"><?php echo $vetor['estado']; ?></div>
              </div>
              <div class="form-group col-md-4">
                <label for="inputState">Cidade:</label>
                <div id="cidade"><?php echo $vetor['cidade']; ?></div>
              </div>
              <div class="form-group col-md-2">
                <label for="inputZip">Bairro</label>
                <div id="bairro"><?php echo $vetor['bairro']; ?></div>
              </div>
            </div>
            <div class="form-row">
              <div class="form-group col-md-6">
                <label for="inputEmail4">Rua:</label>
                <div class="rua" id="rua"><?php echo $vetor['rua']; ?></div>
              </div>
              <div class="form-group col-md-4">
                <label for="inputPassword4">Numero:</label>
                <div id="numero"><?php echo $vetor['numero']; ?></div>
              </div>
              <div class="form-group col-md-2">
                <label for="inputPassword4">Comeplemento:</label>
                <div id="complemento"><?php echo $vetor['complemento']; ?></div>
                
              </div>

            </div>
            <div id="botoes" style="display: none">
              <center><a href="perfil_cliente.php" class="btn btn-primary">Voltar</a> <button type="button" class="btn btn-primary" id="enviar">
                Enviar
              </button></center></div>

            </form>
          </div>
        </div>
        <div class="modal fade" id="alterar_informacoes" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Autenticação de Usuário</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                <form id="validar">
                  <label for="inputPassword4">Senha:</label>
                  <div id="erro"></div>

                  <input name="senha_nova" id="v_senha" type="password" class="form-control" required>
                </form>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                <button type="button" onclick="enviar_informacoes();" class="btn btn-primary">Enviar</button>
              </div>
            </div>
          </div>
        </div>

      </div>
      <div class="modal fade" id="alterar_senha" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Alterar Senha</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <form method="post" action="alterar_mecanico.php" id="form">
                <label for="inputPassword4">Senha atual:</label>
                <input name="senha_antiga" id="senha_antiga" type="password" class="form-control" required>
                <label for="inputPassword4">Senha nova:</label>
                <input name="senha_nova" id="senha_nova" type="password" class="form-control" required>
                <label for="inputPassword4">Confirmar senha:</label>
                <input name="c_senha_nova" id="c_senha_nova" type="password" class="form-control" required>
                <input type="hidden" value="1" name="senha">
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                <button type="button" onclick="enviar();" class="btn btn-primary">Alterar senha</button></form>
              </div>
            </div>
          </div>
        </div>
        <div class="modal fade" id="alterar_foto" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Alterar Foto</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                <form method="post" enctype="multipart/form-data" action="foto_cliente.php">

                  <input type="file" class="form-control" name="arquivo">


                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                  <button type="submit" class="btn btn-primary">Alterar foto</button></form>
                </div>
              </div>
            </div>
          </div>
          <script src="js/jquery.mask.min.js">
          </script>

          <script type="text/javascript">
            function limpa_formulário_cep() {
                //Limpa valores do formulário de cep.
                document.getElementById('rua').value = ("");
                document.getElementById('bairro').value = ("");
                document.getElementById('cidade').value = ("");
                document.getElementById('uf').value = ("");

              }

              function meu_callback(conteudo) {
                if (!("erro" in conteudo)) {
                    //Atualiza os campos com os valores.
                    document.getElementById('rua').value = (conteudo.logradouro);
                    document.getElementById('bairro').value = (conteudo.bairro);
                    document.getElementById('cidade').value = (conteudo.localidade);
                    document.getElementById('uf').value = (conteudo.uf);

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
                    if (validacep.test(cep)) {

                        //Preenche os campos com "..." enquanto consulta webservice.
                        document.getElementById('rua').value = "...";
                        document.getElementById('bairro').value = "...";
                        document.getElementById('cidade').value = "...";
                        document.getElementById('uf').value = "...";


                        //Cria um elemento javascript.
                        var script = document.createElement('script');

                        //Sincroniza com o callback.
                        script.src = 'https://viacep.com.br/ws/' + cep + '/json/?callback=meu_callback';

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
              <script type="text/javascript">
                function enviar() {
                  var senha = "<?php print $vetor_login['senha']; ?>";
                  var form = document.getElementById("form");
                  var c_senha = document.getElementById("senha_antiga").value
                  var senha_nova = document.getElementById("senha_nova").value
                  var c_senha_nova = document.getElementById("c_senha_nova").value
                  if (senha == "" || senha_nova == "" || c_senha_nova == "") {
                    alert("Preencha todos os campos")
                  } else {
                    if (senha != c_senha) {
                      alert("senha incorreta")
                    } else if (senha_nova.length < 6) {
                      alert("a senha deve ter pelo menos 6 digitos")
                    } else {
                      if (senha_nova == c_senha_nova) {
                        form.submit();
                      } else {
                        alert("senhas não conferem")
                      }
                    }
                  }


                }



                function enviar_informacoes() {
                  var senha = "<?php print $vetor_login['senha']; ?>";
                  var form = document.getElementById("alterar");
                  var c_senha = document.getElementById("v_senha").value
                  if (senha != c_senha || c_senha == "") {
                    document.getElementById("erro").innerHTML = "<p style='color:red;'>Senha incorreta</p>";
                  } else {
                    var test = form.checkValidity();
                    if (test == true) {
                      form.submit();
                    } else {
                      document.getElementById("erro_alterar").innerHTML = "<p style='color:red;'>Preencha todos os campos corretamente</p>";
                    }



                  }
                }
              </script>
              <script src="js/validar_form2.js">
              </script>
              <script src="js/validar_form.js">
              </script>
              <script>

                $( "body" ).delegate( ".telefone", "myCustomEvent", function( e, myName, myValue ) {
                  $("#telefone").replaceWith("<input value='<?php echo $vetor['telefone']; ?>'' pattern='.{14,15}'' name='telefone' id='telefone' type='text' class='form-control telefone' required>");
                  $("#celular").replaceWith("<input value=1<?php echo $vetor['celular']; ?>1 pattern='.{14,15}' id='celular' name='celular' type='text' class='form-control telefone' required>");
                  $("#cep").replaceWith("<input value='<?php echo $vetor['cep']; ?>' id='cep' pattern='.{10}' onblur='pesquisacep(this.value);' name='cep' type='text' class='form-control cep' required>");
                  $("#cidade").replaceWith("<input value='<?php echo $vetor['cidade']; ?>' id='cidade' name='cidade' type='text' class='form-control' required>");
                  $("#rua").replaceWith("<input value='<?php echo $vetor['rua']; ?>' id='rua' name='rua' type='text' class='form-control'>");
                  $("#bairro").replaceWith("<input value='<?php echo $vetor['bairro']; ?>' id='bairro' name='bairro' type='text' class='form-control' required>");
                  $("#numero").replaceWith(" <input value='<?php echo $vetor['numero']; ?>' id='numero' name='numero' type='text' class='form-control'>");
                  $("#complemento").replaceWith("<input value='<?php echo $vetor['complemento']; ?>' type='text' name='complemento' class='form-control'>");
                  $("#uf").replaceWith("<select name='uf' id='uf' type='text' class='form-control' required>"+
                   "<option value='<?php echo $vetor['estado'];?>'>"+
                   " <?php echo $vetor['estado']; ?>"+
                   " </option>"+
                   "<option value='AC'>Acre</option>"+
                   "<option value='AL'>Alagoas</option>"+
                   " <option value='AP'>Amapá</option>"+
                   "<option value='AM'>Amazonas</option>"+
                   "<option value='BA'>Bahia</option>"+
                   "<option value='CE'>Ceará</option>"+
                   "<option value='DF'>Distrito Federal</option>"+
                   "<option value='ES'>Espírito Santo</option>"+
                   "<option value='GO'>Goiás</option>"+
                   "<option value='MA'>Maranhão</option>"+
                   "<option value='MT'>Mato Grosso</option>"+
                   "<option value='MS'>Mato Grosso do Sul</option>"+
                   "<option value='MG'>Minas Gerais</option>"+
                   "<option value='PA'>Pará</option>"+
                   "<option value='PB'>Paraíba</option>"+
                   "<option value='PR'>Paraná</option>"+
                   "<option value='PE'>Pernambuco</option>"+
                   "<option value='PI'>Piauí</option>"+
                   "<option value='RJ'>Rio de Janeiro</option>"+
                   "<option value='RN'>Rio Grande do Norte</option>"+
                   "<option value='RS'>Rio Grande do Sul</option>"+
                   "<option value='RO'>Rondônia</option>"+
                   "<option value='RR'>Roraima</option>"+
                   "<option value='SC'>Santa Catarina</option>"+
                   "<option value='SP'>São Paulo</option>"+
                   "<option value='SE'>Sergipe</option>"+
                   "<option value='TO'>Tocantins</option>"+  
                   "</select>");
                  $('.cep').mask('00.000-000');
                  $('.telefone').mask('(00) 0000-00009');
                  $('.telefone').blur(function(event) {
                    if ($(this).val().length == 15) { // Celular com 9 dígitos + 2 dígitos DDD e 4 da máscara
                      $('.telefone').mask('(00) 00000-0009');
                    } else {
                      $('.telefone').mask('(00) 0000-00009');
                      $('.cep').mask('00.000-000');
                      $('#numero').mask('0000000');
                    }
                  });
                });

                $( "#alterar_informacoess" ).click(function() {
                  $( "#telefone" ).trigger( "myCustomEvent" );
                  $("#botoes").css("display","block")
                });
                $("#enviar").click(function() {
                  var form = $("#alterar");
                  form.valid();
                  if (form.valid() == true) {
                    $("#alterar_informacoes").modal("show");
                  }


                });
              </script>


              <script>
                $(document).ready(function() {
                  $('.cep').mask('00.000-000');
                  
                  $('.telefone').mask('(00) 0000-00009');
                  $('.telefone').blur(function(event) {
                    if ($(this).val().length == 15) { // Celular com 9 dígitos + 2 dígitos DDD e 4 da máscara
                      $('.telefone').mask('(00) 00000-0009');
                    } else {
                      $('.telefone').mask('(00) 0000-00009');
                    }
                  });
                  $('#numero').mask('0000000');

                });
              </script>

            </main>

          </body>

          </html>
          <?php
        }
        else
        {

          session_destroy();


          ?>
          <!doctype html>
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