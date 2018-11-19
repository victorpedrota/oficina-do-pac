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
    $cod_servico = $_GET['cod_servico'];
    ?>

    <!DOCTYPE html>
    <html>

    <head>

      <title>Oficina Pro</title>
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

      <link rel="stylesheet" href="scss/main.css">

      <link rel="stylesheet" type="text/css" href="css/style.css">
      <style type="text/css">
      
      .tela{

        width: 95%;
        height: 500px;
        
        
        
        overflow: scroll;
        overflow-x: hidden;

      }
      .rcorners1 {
       border-radius: 25px;
       color: white;
       background-color:#034752;
       width:200px;
       margin-right:5px;
       margin-top:5px;
       float:left;
       padding: 4px;
       border-bottom-right-radius: 0px;

     }
     .rcorners2 {
      border-radius: 25px;

      border-bottom-left-radius: 0px;
      background-color:#a3a2f1;
      width:200px;
      margin-left:5px;
      margin-top:5px;
      float:left;
      padding: 4px;

    }

    .tela::-webkit-scrollbar-track {
      background-color: #F4F4F4;
    }
    .tela::-webkit-scrollbar {
      width: 6px;
      background: #F4F4F4;
    }
    .tela::-webkit-scrollbar-thumb {
      background: #dad7d7;
    }
    .orcamento{

      border-radius: 10px;
      border-bottom-left-radius: 0px;
      background-color:#a3a2f1;
      width:200px;
      margin-left:5px;
      margin-top:5px;
      float:left;
      padding: 4px;

    }
    div.b {
      word-wrap: break-word;
    }

  </style>

</head>

<body style="overflow-x: hidden;">


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
              Chat <span class="sr-only">(current)</span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="perfil_cliente.php"><i style="margin-top: -2px;" class="fas fa-arrow-left"></i> Pagina Incial</a>
          </li>
          
          

        </ul>
      </div>
    </nav>

    <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">
      <div class="row">

        <div class="col-xl-8 col-lg-8 col-xs-12">
          <div id="screen" style="margin-top: 30px;" class="jumbotron jumbotron-fluid tela">

          </div> <br>  




          <footer class="footer" style="margin-top: -30px;">
            <div class="container">
             <div class="form-row">
              <div class="col-9">
                <input class="form-control" id="message" size="40">
              </div>


              <div class="col-xl-3 col-lg-3 ">
                <button class="btn btn-primary d-inline" id="button">Enviar</button>
                <input type="hidden" id="conversa" name="cod_servico" value='<?php echo $cod_servico; ?>'>
                <input type="hidden" id="codigo" name="cod_cliente" value='<?php echo $cod_login; ?>'>
              </div>
            </div>
          </footer>
        </div>
        <?php


        $sql ="SELECT * FROM `servico` WHERE `cod_servico` = $cod_servico" ;
        $resultado = mysqli_query($conn,$sql);
        $vetor_cliente = mysqli_fetch_array($resultado);
        $cod_mecanico = $vetor_cliente['cod_mecanico'];
        $cod_oficina = $vetor_cliente['cod_oficina'];
        $sql_pesquisa ="SELECT * FROM `mecanico` WHERE `cod_mecanico` = $cod_mecanico" ;
        $resultado_pesquisa = mysqli_query($conn,$sql_pesquisa);
        $vetor_imagem = mysqli_fetch_array($resultado_pesquisa);
        $cod_login_mecanico = $vetor_imagem['cod_login'];
        $sql_pesq ="SELECT * FROM `login` WHERE `cod_login` = $cod_login_mecanico" ;
        $resultado_pesq = mysqli_query($conn,$sql_pesq);
        $vetor_final= mysqli_fetch_array($resultado_pesq);
        $imagem_cliente = $vetor_final['imagem'];
        $sql ="SELECT * FROM `oficina` WHERE `cod_oficina` = $cod_oficina" ;
        $resultado = mysqli_query($conn,$sql);
        $vetor_veiculo = mysqli_fetch_array($resultado);
        $cod_servico = $_GET['cod_servico'];
        ?>
        <input type="hidden" id="cod_destinatario" value="<?php echo $cod_login_mecanico;?>" name="">
        <div class="col-4 d-none d-sm-block d-sm-none d-md-block">
          <div class="card" style="margin-top:30px;width: 18rem;">
            <div class="card"  style="width: 18rem;">
              <table>
                <tr>
                  <td><img  style="height: 50px;width: 50px;margin-top: 10px;margin-left: 20px;" src="<?php echo $imagem_cliente; ?>" alt="Card image cap"></td>

                  <td><?php
                  echo "<h5 style='margin-top:25px;'>" . $vetor_imagem['nome']. " " . $vetor_imagem['sobrenome'] . "</h5>";
                  ?></td> 
                </tr>

              </table><br> <h5 style="margin-left: 15px;">Informações do mecânico</h5>
              <?php
              echo "<h6 style='margin-left:15px;margin-top:10px;'>Nome oficina:".$vetor_veiculo['nome']. "<br>  Endereço: rua". $vetor_veiculo['rua'] .", ". $vetor_veiculo['numero'] . ",".$vetor_veiculo['bairro']."</h6>";
              ?>
              <div class="card-body">
                <p class="card-text">


                </p>
              </div>
            </div>

          </div>
          <div class="card" style="margin-top:30px;width: 18rem;height: 250px;max-height: 300px;">
            
              <h5 class="card-header">Resumo do chamado</h5>
            <div class="card-body" style=" max-height: 200px;overflow-y: scroll;">
            
              <?php
              $orcamento ="SELECT * FROM `orcamento` WHERE `cod_servico` = $cod_servico && `status` = 2";
              $query_orcamento = mysqli_query($conn,$orcamento);
              $vetor_orcmaneto = mysqli_fetch_array($query_orcamento);
              $valor_total = 0;
              $x=1;
              $numero_orcamento = mysqli_num_rows($query_orcamento);
              if ($numero_orcamento == 0) {
                 echo "Não há serviços em andamento";
              }
              else{
                while ($vetor_orcmaneto = mysqli_fetch_array($query_orcamento)) {
                  echo "Serviço".$x.":". $vetor_orcmaneto['tipo']."<br>Valor:<p class='valor'>".$vetor_orcmaneto['valor']."</p><br>";
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
    <div class="modal fade" id="horario" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Inicar Serviço</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            Deseja iniciar o Serviço?
            <form id="foi"><input type="hidden" id="cod_orcamento" value=""><input type="hidden" value="<?php echo $cod_servico;?>" id="cod_servico"></form>
          </div>
          <div class="modal-footer">


            <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
            <button type="button" id="aceita_chamado" class="btn btn-primary">Aceitar</button>
          </div>
        </div>
      </div>
    </div>

    <script type="text/javascript" src="js/chat.js"></script>

  </body>
  <script>
    $('.valor').mask('000.000.000.000.000,00', {reverse: true});
    $( "#message" ).keydown(function( event ) {
      if ( event.which == 13 ) {
       {       
        $("#screen").animate({scrollTop: $('#screen').prop("scrollHeight")}, 999);
        $.post("server.php", 
          { message: $("#message").val(), conversa: $("#conversa").val(), codigo: $("#codigo").val(),, cod_destinatario:$("#cod_destinatario").val()},
          function(data){ 
            $("#screen").val(data); 
            $("#message").val("");
          }
          );
      }
    }

  });
</script>

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