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
     
    <title>Oficina Pro</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link rel="stylesheet" href="scss/main.css">
    
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <style type="text/css">
      
      .tela{

        width: 95%;
        height: 500px;
        background: #d8c2c247;
        border-radius: 1em;
        margin: 15px;
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
      <div class="row">

        <div class="col-8">
          <div id="screen" style="margin-top: 30px;" class="tela"></div> <br>  



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
          $cod_mecanico = $vetor_cliente['cod_mecanico'];
          $cod_oficina = $vetor_cliente['cod_oficina'];
          $sql_pesquisa ="SELECT * FROM `mecanico` WHERE `cod_mecanico` = $cod_mecanico" ;
          $resultado_pesquisa = mysqli_query($conn,$sql_pesquisa);
          $vetor_imagem = mysqli_fetch_array($resultado_pesquisa);
          $cod_login = $vetor_imagem['cod_login'];
          $sql_pesq ="SELECT * FROM `login` WHERE `cod_login` = $cod_login" ;
          $resultado_pesq = mysqli_query($conn,$sql_pesq);
          $vetor_final= mysqli_fetch_array($resultado_pesq);
          $imagem_cliente = $vetor_final['imagem'];
          $sql ="SELECT * FROM `oficina` WHERE `cod_oficina` = $cod_oficina" ;
          $resultado = mysqli_query($conn,$sql);
          $vetor_veiculo = mysqli_fetch_array($resultado);

          ?>
          <div class="col-4">
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
            <div class="card" style="margin-top:30px;width: 18rem;">
              <div class="card-body">
                <h5 class="card-title">Informar progresso</h5>
                <h6 class="card-subtitle mb-2 text-muted">ferramentas</h6>
                <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                <a href="#" class="card-link">Card link</a>
                <a href="#" class="card-link">Another link</a>
              </div>

            </div>
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

              if (obj[i].cod_orcamento!=0) {

                if ($('#conversa').val() == obj[i].codigo && $('#codigo').val() != obj[i].cod_autor) {$('#screen').append("<div class='orcamento b' style='float:left;height200px;'>Valor:"+obj[i].orcamento[0]+"<br>Detalhes:"+obj[i].orcamento[1]+"<br>Data de entrega:"+obj[i].orcamento[2]+ "<br><button class='btn btn-default'>Recusar</button><a style='color:white;' href='aceitar.php?cod_servico="+obj[i].codigo+"&cod_orcamento="+obj[i].cod_orcamento+"' class='btn btn-primary' value="+obj[i].cod_orcamento+">aceitar</a></div><br><br><br><br><br><br><br>");}
                else if($('#conversa').val() == obj[i].codigo && $('#codigo').val() == obj[i].cod_autor){$('#screen').append("<div class='orcamento b' style='float:right;height200px;'>Valor:"+obj[i].orcamento[0]+"<br>Detalhes:"+obj[i].orcamento[1]+"<br>Data de entrega:"+obj[i].orcamento[2]+ "</div><br><br><br><br><br><br>");}

              }
              else{

                if ($('#conversa').val() == obj[i].codigo && $('#codigo').val() == obj[i].cod_autor) {$('#screen').append("<div class='rcorners1 b' style='float:right;'>Você:"+obj[i].texto + "</div><br><br><br>");}
                else if($('#conversa').val() == obj[i].codigo && $('#codigo').val() != obj[i].cod_autor){$('#screen').append("<div class='rcorners2 b' style='float:left;'>"+obj[i].texto + "</div><br><br><br>");}
              }


            }
          });
        setTimeout('update()', 1000);
      }

      $(document).ready(

        function() 
        {
          $("#screen").scrollTop($(this)[0].scrollHeight);
         update();

         $("#button").click(    
          function() 
          {       
          $("#screen").animate({scrollTop: $('#screen').prop("scrollHeight")}, 999);
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