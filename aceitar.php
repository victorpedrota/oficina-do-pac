<?php
    //Mantendo a sessão/cria uma sessao
session_start();

if(!isset($_SESSION["system_control"]))
{
  
 require('connect.php');
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
      <script type="text/javascript" src="https://code.jquery.com/jquery-2.2.4.min.js"></script>
      <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.11.4/jquery-ui.min.js"></script>

      <?php
      require("navbar_logout.html");
      $cod_servico = $_GET['cod_servico'];
      $cod_orcamento = $_GET['cod_orcamento'];
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
          <input type="hidden" id="cod_orcamento" name="cod_orcamento" value=<?php echo $cod_orcamento; ?>>
          <input type="hidden" id="cod_servico" name="cod_servico" value=<?php echo $cod_servico;?>>
          <div class="card text-center" style="margin-top: 30px;">
            <div class="card-header">
              Fechando Serviço
            </div>
            <div class="card-body">
              <h5 class="card-title">Agendando horário</h5>
              Confirme o horário estipulado pelo mecanico, ou escolha algum disponivel abaixo.<br>
              Data:
              <input type="date" class="form-control" id="data" name="">
              Horário:
              <input type="time" class="form-control" id="hora" name="">
              <br><button id="aceitar" class="btn btn-primary" onclick="window.history.go(-1);">Aceitar</button>
            </div>
            <div class="card-footer text-muted">

            </div>
          </div>
        </main>
      </div>
      <script type="text/javascript">



        $(document).ready(

          function() 
          {
            $("#aceitar").click(    
              function() 
              {       

                $.post("aceitar_chamado.php", 
                  { cod_servico: $("#cod_servico").val(), cod_orcamento: $("#cod_orcamento").val(), data: $("#data").val(), hora: $("#hora").val()},
                  function(data){ 
                    
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


    require('erro.php');
    }
  }
  ?>