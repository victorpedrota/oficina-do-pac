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
    $codigo = $_GET["codigo"];
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
      <style type="text/css">.thumbnail {
        position: relative;
        width: 40rem;
        height: 200px;
        overflow: hidden;
      }
      .thumbnail img {
        position: absolute;
        left: 50%;
        top: 50%;
        height: 100%;
        width: auto;
        -webkit-transform: translate(-50%,-50%);
        -ms-transform: translate(-50%,-50%);
        transform: translate(-50%,-50%);
      }
      .thumbnail img.portrait {
        width: 100%;
        height: auto;
      }</style>


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
                <a class="nav-link active" href="">
                  <span data-feather="home"></span>
                  Página inical <span class="sr-only">(current)</span>
                </a>

              </li>
              <li class="nav-item">
                <a class="nav-link" href="#" id="btnfeed">Feed</a>
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

        <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4" style="margin-top: 30px;">
          <?php
          $sql_servico = "SELECT * FROM `oficina` WHERE  `nome` LIKE  '%$codigo%'";
          $query_oficina = mysqli_query($conn, $sql_servico);
          if($codigo != ""){
            while ($vetor_oficina = mysqli_fetch_array($query_oficina)) {
             $imagem =  $vetor_oficina['cod_login'];
             $sql= "SELECT * FROM `login` WHERE  `cod_login` = $imagem";
             $query= mysqli_query($conn, $sql);
             $vetor_img = mysqli_fetch_array($query);
            $cod_oficina =  $vetor_oficina['cod_oficina'];
             echo "<div class='card' style='width: 40rem;'>

             <div class='thumbnail'>
             <img src='".$vetor_img['imagem']."' class='portrait' alt='Image' />
             </div>
             <div class='card-body'>
             <a data-toggle='modal' href='#' data-target='#".$vetor_oficina['cod_oficina']."'><h5 class='card-title'>".$vetor_oficina['nome']."</h5></a>" .
             $vetor_oficina['nome'] . "<br>Endereço: rua " . $vetor_oficina['rua'] . ", " . $vetor_oficina['numero'] . $vetor_oficina['bairro'] .", ".$vetor_oficina['cidade'].", ".$vetor_oficina['estado'] . "</p>

             </div>
             </div>

             <div class='modal fade bd-example-modal-lg' id='".$vetor_oficina['cod_oficina']."' tabindex='-1' role='dialog' aria-labelledby='myLargeModalLabel' aria-hidden='true' tabindex='-1' role='dialog'>
             <div class='modal-dialog modal-lg' role='document'>
             <div class='modal-content'>
             <div class='modal-header'>

             <div class='thumbnail'>
             <img src='".$vetor_img['imagem']."' class='portrait' alt='Image' />
             </div>
             <button type='button' class='close' data-dismiss='modal' aria-label='Close'>
             <span aria-hidden='true'>&times;</span>
             </button>
             </div>
             <div class='modal-body'>";


            $sql_servico = "SELECT * FROM `galeria` WHERE  `cod_oficina` = $cod_oficina";
            $query_servico = mysqli_query($conn, $sql_servico);
            $numero_servico = mysqli_num_rows($query_servico); 
            if ($numero_servico !=0) {
              while ($vetor_servico = mysqli_fetch_array($query_servico)) {

                echo "
                <div class='show-image' >
                <img  src='".$vetor_servico['imagem']."' class='cortar' style='height:100px;width:100px;'  >
                
                <i class='fas fa-times delete'></i>
                </div>";





              }


            }



            else{

              echo "<li class='list-group-item itens'>Não há imagens cadastradas</li>";

            }              


            echo "
             <h5>Descrição</h5><br>
             ".$vetor_oficina['descricao']."
             
            
    </div>
    <div class='modal-footer'>
    
    <button type='button' class='btn btn-secondary' data-dismiss='modal'>Fechar</button>
    </div>
    </div>
    </div>
    </div>

    <br>             ";

  }
  }else{
    echo "<ul class='list-group'>
    <li class='list-group-item'>resultado não encontrado</li>

    </ul>";
  }



  ?>
 <style type="text/css">#map {
        height: 100%;
      }
      /* Optional: Makes the sample page fill the window. */
      html, body {
        height: 100%;
        margin: 0;
        padding: 0;
      }</style>


  </main>
  </div>

 <script>
             var map;
             function initMap() {
              map = new google.maps.Map(document.getElementById('map'), {
                center: {lat: -34.397, lng: 150.644},
                zoom: 8
                });
              }
              </script>
    <script src='https://maps.googleapis.com/maps/api/js?key=AIzaSyArDLk6kB_mO1_1rKl5hFRtkNOGdHzJtVU&callback=initMap'
    async defer></script>


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