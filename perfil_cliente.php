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
              <a class="nav-link" href="" id="feed">Feed</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#" id="btnchamados" >Iniciar Chamado
              </a>
            </li>
            
            
            <li class="nav-item">
              <a class="nav-link" href="#" id="btnandamento" >Serviços em andamento
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="form_veiculo.php">Gerenciar Veículos</a>
            </li>
            

          </ul>
        </div>
      </nav>

      <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">
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
                  Protocolo:   ".$vetor_servico['protocolo']."<br>Status: Aguardando aceitação da Oficina<br>
                  Serviço desejado:".$vetor_servico['servico_desejado']."
                  </li>";

                  
                  
                  
                }
              }else{

                echo "<li class='list-group-item itens'>Não há veiculos nesta fase</li>";

              }
              

              ?>

            </ul>

          </center>
        </div>
        <div class="d-flex justify-content-center " >
          <div id="chamados" style="display: none; margin-top: 60px;width: 800px">
            <center><h3>Inicar Chamado</h3></center>
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
                  <select class="form-control" name="tipo" required>
                    <option value="">Selecione um tipo</option> 
                    <option value="troca">troca de oleo</option>
                  </select>
                  <input type="hidden" name="n_oficina" id="n_oficina">
                </div>
              </div>
              Descrição do problema:<textarea name="problema" style="border-radius: 1em;" class="form-control" required></textarea>
              Serviço desejado:<textarea name="servico" style="border-radius: 1em;" class="form-control" required></textarea>
              <center><br><a class="btn btn-secondary" href="#">Cancelar</a>
                <button type="button" id="enviar" class="btn btn-primary">Enviar</button></center>
              </form>
            </div>
            
          </div>

        </div>
      </main>
    </div>
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
      <div class="modal-body">
        <div class="input-group">
          <select name="noficina" id="nomes" class="form-control" style="border-top-left-radius:3px; border-bottom-left-radius:3px; border-top-right-radius: 0px;border-bottom-right-radius: 0px; margin-left: 5px;height: 36px;width: 362px;">
            <?php 
            while ($vetor_oficina = mysqli_fetch_array($oficinas_query)) {
              echo "<option value=".$vetor_oficina['cod_oficina'].">". $vetor_oficina['nome']."</option>";
            }
            ?>
          </select>
          <div class="input-group-btn">
            <button class="btn btn-default" style="border-top-left-radius:0px; border-bottom-left-radius:0px; border-top-right-radius: 3px;border-bottom-right-radius: 3px; height: 36px" type="submit">
              <i class="fas fa-plus"></i>
            </button>
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" id="btnenviar" class="btn btn-primary">Save changes</button>
      </div>
    </div>
  </div>
</div>
<script src="js/validar_form2.js"></script>
<script src="js/validar_form.js"></script>

<script>
  $("#btnenviar").click(function(){
   var nome = $("#nomes").val();
   $("#n_oficina").attr("value", nome);
   $("form").submit();
 });
  $('#btnchamados').on('click', function() {
    $('#chamados').toggle(1000);
    $('#andamento').css("display","none");
  });
  $('#btnandamento').on('click', function() {
    $('#andamento').toggle(1000);
    $('#chamados').css("display","none");
  });
  $( "#enviar" ).click(function() {
    var form = $( "#form" );
    form.valid();
    if (form.valid() == true) {$("#oficinas").modal("show");}


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