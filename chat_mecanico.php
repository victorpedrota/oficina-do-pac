<?php
    //Mantendo a sessão/cria uma sessao
session_start();

if(!isset($_SESSION["system_control"]))
{
  require('erro.php');
}
else{
        //Sessao já criada
        //Recuperando as variaveis da sessão
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
    $cod_servico = $_GET['cod_servico'];
    ?>

    <!DOCTYPE html>
    <html>

    <head>

      <title>Oficina Pro</title>
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

      <link rel="stylesheet" type="text/css" href="scss/main.css">

      <link rel="stylesheet" type="text/css" href="css/style.css">
      <link rel="stylesheet" type="text/css" href="css/chat.css">

    </head>

    <body style="overflow-x: hidden;">


      <?php
      require("navbar_mecanico.html");
      ?>

      <script src="js/validar_form2.js"></script>
      <script src="js/validar_form.js"></script>
      <div class="row">
        <nav class="col-md-2 d-none d-md-block bg-light sidebar">
          <div class="sidebar-sticky">
            <ul class="nav flex-column">
              <li class="nav-item">
                <a class="nav-link active" href="#">
                  <span data-feather="home"></span>
                  Chat <span class="sr-only">(current)</span>
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="perfil_mecanico.php">Pagina inicial</a>
              </li>



            </ul>
          </div>
        </nav>


        <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">
          <div class="row">

            <div class="col-8">
              <div id="screen"  style="margin-top: 30px;" class="tela"></div> <br>  



              <footer class="footer">
                <div class="container">
                 <div class="form-row">
                  <div class="col-9">
                    <input class="form-control" id="message" size="40">
                  </div>


                  <div class="col-3">
                    <button type="button" style="margin-right: 10px" class="btn btn-default" data-toggle="modal" data-target="#tools"><i class="fas fa-wrench"></i></button><button class="btn btn-primary" id="button"> Enviar </button>
                    <input type="hidden" id="conversa" name="cod_servico" value='<?php echo $cod_servico; ?>'>
                    <input type="hidden" id="codigo" name="cod_cliente" value='<?php echo $cod_login; ?>'>
                  </div>
                </div></footer>
              </div>

              <?php


              $sql ="SELECT * FROM `servico` WHERE `cod_servico` = $cod_servico" ;
              $resultado = mysqli_query($conn,$sql);
              $vetor_cliente = mysqli_fetch_array($resultado);
              $cod_cliente = $vetor_cliente['cod_cliente'];
              $cod_veiculo = $vetor_cliente['cod_veiculo'];
              $cod_mec = $vetor_cliente['cod_cliente'];
              $sql_pesquisa ="SELECT * FROM `cliente` WHERE `cod_cliente` = $cod_cliente" ;
              $resultado_pesquisa = mysqli_query($conn,$sql_pesquisa);
              $vetor_imagem = mysqli_fetch_array($resultado_pesquisa);
              $cod_login_usuario = $vetor_imagem['cod_login'];
              $sql_pesq ="SELECT * FROM `login` WHERE `cod_login` = $cod_login_usuario" ;
              $resultado_pesq = mysqli_query($conn,$sql_pesq);
              $vetor_final= mysqli_fetch_array($resultado_pesq);
              $imagem_cliente = $vetor_final['imagem'];
              $sql ="SELECT * FROM `veiculo` WHERE `cod_veiculo` = $cod_veiculo" ;
              $resultado = mysqli_query($conn,$sql);
              $vetor_veiculo = mysqli_fetch_array($resultado);

              ?>
              <div class="col-4">
                <input type="hidden" value="<?php echo $cod_login; ?>" id="verdadeiro">
                <div class="card" style="margin-top:30px;width: 20rem;">
                  <div class="card"  style="width: 20rem;">
                    <table>
                      <tr>
                        <td><img  style="height: 50px;width: 50px;margin-top: 10px;margin-left: 20px;" src="<?php echo $imagem_cliente; ?>" alt="Card image cap"></td>

                        <td><?php
                        echo "<h5 style='margin-top:25px;'>" . $vetor_imagem['nome']. " " . $vetor_imagem['sobrenome'] . "</h5>";
                        ?></td> 
                      </tr>
                      <input type="hidden" id="cod_destinatario" value="<?php echo $cod_login_usuario;?>" name="">
                    </table><br> <h5 style="margin-left: 15px;">Informações do veículo</h5>
                    <?php
                    echo "<h6 style='margin-left:15px;margin-top:10px;'>Placa:".$vetor_veiculo['placa']. "  Marca:". $vetor_veiculo['marca'] ."<br>Modelo:". $vetor_veiculo['modelo'] . "</h6>";
                    ?>
                    <div class="card-body">
                      <p class="card-text">


                      </p>
                    </div>
                  </div>

                </div><input type="hidden"  id="cod_mec" value="<?php echo $cod_cliente; ?>">
                <div class="card" style="margin-top:30px;width: 20rem;height: 250px;max-height: 300px;">
            
              <h5 class="card-header">Resumo do chamado</h5>
            <div class="card-body" style=" max-height: 300px;overflow-y: scroll;">
            
              <?php
              $orcamento ="SELECT * FROM `orcamento` WHERE `cod_servico` = $cod_servico";
              $query_orcamento = mysqli_query($conn,$orcamento);
              
              $valor_total = 0;
              $x=1;
              $numero_orcamento = mysqli_num_rows($query_orcamento);
              if ($numero_orcamento == 0) {
                 echo "Não há serviços em andamento";
              }
              else{
                while ($vetor_orcmaneto = mysqli_fetch_array($query_orcamento)) {
                  if ($vetor_orcmaneto['status'] ==2) {
                    echo "Serviço".$x.":". $vetor_orcmaneto['tipo']."<a style='float:right;' href='excluir_orcamento.php?cod_orcamento=".$vetor_orcmaneto['cod_orcamento']."'><i class='fas fa-times'></i></a><br>Valor:".$vetor_orcmaneto['valor']."<br>";
                  }else if ($vetor_orcmaneto['status'] ==3) {
                    echo "Serviço".$x.":". $vetor_orcmaneto['tipo']."<a style='float:right;'><i class='fas fa-check' style='color:green;'></i></a><br>Valor:".$vetor_orcmaneto['valor']."<br>";
                  }
                  
                  $x++;
                  $valor_total = $valor_total + $vetor_orcmaneto['valor'];
                }
              }
              ?>

              

              
            </div>
 <div class="card-footer text-muted">
    Valor total: <a href="#" class="card-link"><?php echo $valor_total; ?></a>
  </div>
          </div>
            </div>
          </div>

        </main>
        <div class="modal fade" id="tools" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Ferramentas</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">

                <button id="orcamento" class="btn btn-default">Enviar orçamento</button>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Sair</button>

              </div>
            </div>
          </div>
        </div>
        <div class="modal fade" id="form_orcamento" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Enviar proposta para inicar pedido</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                <form id="form_orcamento2">

                  Valor:<input id="valor" type="text" class="form-control" required>
                  Escolha a data para inicio:<div class="row">

                    <div class="col"> <input type="date" class="form-control" id="data_inicio" required></div>
                    <div class="col"><input type="time" class="form-control" id="horario_inicio" required></div>

                  </div>
                  <div class="row">
                    <div class="col">
                      Término:<input type="date" id="data_termino" class="form-control" required>
                     
                  </div>
                    <div class="col">
                      Tipo serviço:<select class="form-control" id="tipo" required>
                      <option value="troca de oleo">Troca de óleo</option>
                    </select>
                  </div>
                    

                  

                </div>
                  Detalhes do serviço:<textarea id="detalhes" class="form-control" required></textarea>
                <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Sair</button>
                  <button type="button" id="envia_orcamento" class="btn btn-secondary"">Enviar</button>
                </form>
              </div>
            </div>
          </div>
        </div>



        <script type="text/javascript" src="js/chat.js"></script>
        <script type="text/javascript" src="js/jquery.mask.min.js"></script>
        <script>
          $('#valor').mask('000.000.000.000.000,00', {reverse: true});

        </script>


      </body>

      </html>
      <?php
    }
    else
    {

      session_destroy();


     require('erro.php');
    }
  }
  ?>