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
    if (isset($_GET["codigo"])) {
      $codigo = $_GET["codigo"];
    }
    else{
      $codigo = "";
    }
    
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
                  Pesquisar <span class="sr-only">(current)</span>
                </a>

              </li>
              <li class="nav-item">
                <a class="nav-link" href="perfil_cliente.php" id="btnfeed"><i class="fas fa-arrow-left"></i> Voltar</a>
              </li>
            
              <li class="nav-item">
                <a class="nav-link" href="form_veiculo.php">Gerenciar Veículos</a>
              </li>


            </ul>
          </div>
        </nav>

        <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4" style="margin-top: 30px;">
          <div class="row">
            <div class="col-8">
              <div class="card" style="margin-bottom: 10px;">
                <div class="card-body" >
                 CEP: <input type="text" class="form-control d-inline" id="celval" style="border-radius: 3px; width: 8rem;" name=""> <button class="btn btn-primary" id="cepvai">Pesquisar</button>
               </div>
               <div class="vaiq"></div>

             </div>
             <?php
             $sql_servico = "SELECT * FROM `oficina` WHERE  `nome` LIKE  '%$codigo%'";
             $query_oficina = mysqli_query($conn, $sql_servico);
             $numero = mysqli_num_rows($query_oficina);

             if($codigo != "" && $numero != 0 ){
              while ($vetor_oficina = mysqli_fetch_array($query_oficina)) {
               $imagem =  $vetor_oficina['cod_login'];
               $sql= "SELECT * FROM `login` WHERE  `cod_login` = $imagem";
               $query= mysqli_query($conn, $sql);
               $vetor_img = mysqli_fetch_array($query);
               $cod_oficina =  $vetor_oficina['cod_oficina'];

               echo "<div class='card' style='width: 100%;'>
               ".$vetor_oficina['cep']."
               <input type='hidden' class='lat' value='".$vetor_oficina['cep']."''>
               <p id='kraio'></p>
               <div class='thumbnail'>
               <img src='".$vetor_img['imagem']."' class='portrait' width='auto' alt='Image' />
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
               <img src='".$vetor_img['imagem']."' class='portrait' alt='Image'>
               </div>
               <button type='button' class='close' data-dismiss='modal' aria-label='Close'>
               <span aria-hidden='true'>&times;</span>
               </button>
               </div>
               <div class='modal-body'><h4>".$vetor_oficina['nome']."</h4><br>Endereço: rua " . $vetor_oficina['rua'] . ", " . $vetor_oficina['numero'] . $vetor_oficina['bairro'] .", ".$vetor_oficina['cidade'].", ".$vetor_oficina['estado'] . "</p>
               <h6>Fotos da Oficina</h6>";



               $sql_servico = "SELECT * FROM `galeria` WHERE  `cod_oficina` = $cod_oficina";
               $query_servico = mysqli_query($conn, $sql_servico);
               $numero_servico = mysqli_num_rows($query_servico); 
               if ($numero_servico !=0) {
                while ($vetor_servico = mysqli_fetch_array($query_servico)) {

                  echo "

                  <img  src='".$vetor_servico['imagem']."' style='height:100px;width:100px;' style='display:inline;'>";





                }


              }




              else{

                echo "<li class='list-group-item itens'>Não há imagens cadastradas</li>";

              }              


              echo "
              <br> <h5>Descrição</h5><br>
              ".$vetor_oficina['descricao'];
              echo "<h6>Mecânicos</h6>";
              $sql_mecanico = "SELECT * FROM `mecanico` WHERE  `cod_oficina` = $cod_oficina";
              $query_mecanico = mysqli_query($conn, $sql_mecanico);
              $numero_mecanico = mysqli_num_rows($query_mecanico); 
              if ($numero_mecanico !=0) {
                while ($vetor_mecanico = mysqli_fetch_array($query_mecanico)) {
                  $cod_login_mecanico = $vetor_mecanico['cod_login'];
                  $sql_foto = "SELECT * FROM `login` WHERE  `cod_login` = $cod_login_mecanico";
                  $query_foto = mysqli_query($conn, $sql_foto);
                  $vetor_foto = mysqli_fetch_array($query_foto);

                  echo "

                  <img  src='".$vetor_foto['imagem']."' style='height:100px;width:100px;' style='display:inline;'>";





                }


              }




              else{

                echo "<li class='list-group-item itens'>Não há imagens cadastradas</li>";

              }      


              echo " </div>
              <div class='modal-footer'>

              <button type='button' class='btn btn-secondary' data-dismiss='modal'>Fechar</button>
              <button type='button' class='btn btn-primary' data-dismiss='modal' data-toggle='modal' data-target='#oi".$vetor_oficina["cod_oficina"]."'>
              Pedir Orçamento
              </button>
              </div>
              </div>
              </div>
              </div>

              <br>             


              <div class='modal fade' id='oi".$vetor_oficina["cod_oficina"]."' tabindex='-1' role='dialog' aria-labelledby='exampleModalLabel' aria-hidden='true'>
              <div class='modal-dialog' role='document'>
              <div class='modal-content'>
              <div class='modal-header'>
              <h5 class='modal-title'  id='exampleModalLabel'>Enviar Orçamento</h5>
              <button type='button' class='close' data-dismiss='modal' aria-label='Close'>
              <span aria-hidden='true'>&times;</span>
              </button>
              </div>
              <div class='modal-body'>
              <form method='post' action='gambiarra.php'>
              <div class='row'>
              <div class='col'>

              Veiculo:

              <select class='form-control' id='veiculos' name='veiculo' required>
              <option value=''>Selecione um Veículo</option>";

              $sql_vec ="SELECT * FROM `veiculo` WHERE `cod_cliente` = $cod_cliente" ;
              $veiculo_res = mysqli_query($conn,$sql_vec);
              while ($vetor_vec = mysqli_fetch_array($veiculo_res)) {
                echo "<option value=".$vetor_vec['cod_veiculo'].">Modelo:  ".$vetor_vec['modelo']."      Placa:  ".$vetor_vec['placa']."</option>";
              }
              echo "
              </select>
              </div>
              <div class='col'>
              Tipo de serviço: <i class='fas fa-info-circle'></i>
              <select class='form-control' id='tipo' name='tipo' required>
              <option value=''>Selecione um tipo</option>
              <option value='revisao'>revisão geral</option>
              <option value='troca'>troca de oleo</option>
              <option value='troca'>troca de pneu</option>
              <option value='troca'>troca de vidro</option>
              <option value='revisao'>revisão do motor</option>
              <option value='troca'>troca de freios</option>
              <option value='troca'>troca de amortecedores</option>
          

              </select>
              <input type='hidden' name='cod_oficina' value='".$vetor_oficina["cod_oficina"]."'>
              </div>
              </div>
              Descrição do problema:<textarea name='problema' id='descricao' style='border-radius: 1em;' class='form-control' required></textarea> Serviço desejado:<textarea name='servico' id='servico' style='border-radius: 1em;' class='form-control' required></textarea>

              <input type='hidden' id='cod_cliente' value='<?php echo $cod_cliente;?>'>
              </div>
              <div class='modal-footer'>


              <a class='btn btn-secondary' data-dismiss='modal' href='#'>Cancelar</a>
              <button type='submit' id='enviar' class='btn btn-primary'>Enviar</button></form>
              </div>
              </div>
              </div>
              </div>" ;

            }
          }else{
            echo "<ul class='list-group'>
            <li class='list-group-item'>resultado não encontrado</li>

            </ul>";
          }



          ?></div>
          <div class="col-2 d-none d-sm-block d-sm-none d-md-block"><div class="col-2" style="margin-bottom: 10px">
            <div class="card" style="width: 20rem;position: fixed;">
              <img class="card-img-top" src="http://www.agenciamestre.com/anuncios-facebook/img/img-anuncios-patrocinados.jpg" style="filter: grayscale(100%);" alt="Card image cap">
              <div class="card-body">
                <h5 class="card-title">Anúncio</h5>
                <p class="card-text">Espaço reservado para anúncio</p>

              </div>
            </div>
          </div>
        </div>
      </div>




      <script src="js/validar_form2.js"></script>
      <script src="js/validar_form.js"></script>


      <script>
        $("#enviar").click(function() {
          var form = $("#form");
          form.valid();
          if (form.valid() == true) {
            $.post("gambiarra.php", {
              veiculo: $("#veiculos").val(),
              tipo: $("tipo").val(),
              problema: $("#descricao").val(),
              servico: $("#servico").val(),
              n_oficina: "",
              cod_cliente: $("#cod_cliente").val()
            });
            
          }
        })
        $("#cepvai").click(function(){
          $.getJSON("https://viacep.com.br/ws/"+$('#celval').val()  +"/json/?callback=?", function(dados) {

            if (!("erro" in dados)) {
                alert(dados.localidade)

              $.post( "oficinas_proximas.php", { cidade: dados.localidade  })
              .done(function( data ) {
                $("#vaiq").append('<div class="card" style="margin-bottom: 10px;"><div class="card-body" >foi</div></div>')
                alert(data)
              });

            } 
            else {

            }
          });
        })

        $("#cepvai").click(function(){
          $.getJSON( "https://maps.googleapis.com/maps/api/geocode/json?address="+$("#celval").val()+"&key=AIzaSyDmLMwibNULHnJE5RJKhGo0i-q89LbbQGs", function( json ) {
            console.log( "JSON Data: " + json.results[0].geometry.location.lat);
            console.log( "JSON Data: " + json.results[0].geometry.location.lng);

            $( ".lat" ).each(function( index ) {
              $.getJSON( "https://maps.googleapis.com/maps/api/geocode/json?address="+$(this).val()+"&key=AIzaSyChZb-0uwRPMH036IbuTMAtm5tQuCstI8k", function( json ) {
                console.log( "JSON Data: " + json.results[0].geometry.location.lat);
                console.log( "JSON Data: " + json.results[0].geometry.location.lng);
                $("#kraio").text(json.results[0].geometry.location.lat);
              });

            });
          })
        })

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