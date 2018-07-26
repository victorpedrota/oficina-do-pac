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
    $cod_servico = $_GET['cod_servico'];
    ?>

    <!DOCTYPE html>
    <html>

    <head>
      <style type="text/css">
      .tela{

        width: 95%;
        height: 500px;
        background: #d8c2c214;
        border-radius: 1em;
        margin: 15px;

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
              <a class="nav-link" href="form_veiculo.php">Gerenciar Veículos</a>
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
              <a class="nav-link" href="#" id="btnexcluir" >Excluir veículo
              </a>
            </li>

          </ul>
        </div>
      </nav>

      <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">
        <div id="screen" class="tela"> </div> <br>  
        <div class="form-row">
    <div class="col">
      <input class="form-control" id="message" size="40">
    </div>
    <div class="col">
      <button class="btn btn-primary" id="button"> Enviar </button>
      <input type="hidden" id="conversa" name="cod_servico" value='<?php echo $cod_servico; ?>'>
      <input type="hidden" id="codigo" name="cod_cliente" value='<?php echo $cod_login; ?>'>
    </div>
  </div>
          
          
          
        </main>
        <script type="text/javascript">  

          function update()
          {
            $.post("server.php", {}, function(data){

            var obj = jQuery.parseJSON(data);
            $('#screen').text('');

           for (var i in obj) {
      
            if ($('#conversa').val() == obj[i].codigo && $('#codigo').val() == obj[i].cod_autor) {$('#screen').append("<p style='float:left;'>Você:"+obj[i].texto + "</p><br><br>");}
            else if($('#conversa').val() == obj[i].codigo && $('#codigo').val() != obj[i].cod_autor){$('#screen').append("<p style='float:right;'>"+obj[i].texto + "</p><br><br>");}
            
                }
          });
            setTimeout('update()', 1000);
          }

          $(document).ready(

            function() 
            {
             update();

             $("#button").click(    
              function() 
              {         
               $.post("server.php", 
                { message: $("#message").val(), conversa: $("#conversa").val(), codigo: $("#codigo").val()},
                function(data){ 
                  $("#screen").val(data); 
                  $("#message").val("");
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


      ?>
      <script>
        alert("Acesso Inválido!");
        document.location.href = "login.php";
      </script>
      <?php
    }
  }
  ?>