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
  $nome = $_SESSION["nome"];
  $cod_oficina = $_SESSION["cod_oficina"];

  if($system_control == 1 && $privilegio == 2){
    require('connect.php'); 
    
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
      <style type="text/css">

      div.show-image {
        position: relative;
        float:left;
        margin:5px;
      }
      div.show-image:hover img{
        opacity:0.5;
      }
      div.show-image:hover .delete {
        display: block;
      }
      div.show-image .delete {
        position:absolute;
        display:none;
      }
      
      div.show-image .delete {
        top:0;
        left:84%;
      }
      .cortar{
        object-fit: cover; object-position: center;
      }
    </style>


  </head>

  <body style="overflow-x: hidden;">


    <?php
    require("navbar_oficina.html");
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
              <a class="nav-link" href="#" id="btn_graph">Dashboard</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" id="imagens" href="#" data-toggle="modal" data-target="#ima">Galeria de imagens
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#" id="btn_mecanico">Cadastrar Mecânico</a>
            </li>




          </ul>
        </div>
      </nav>

      <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.4.0/Chart.min.js"></script>
      <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4" style="margin-top: 30px;">
        <div id="graph">
          <center><h3>Dashboard</h3></center>
          <br>
          <div class="row">
            <div class="col"><center><h5>Serviços realizados</h5></center>
              <div style="height: 400px;width: 400px;"><canvas id="myChart"></canvas></div>
            </div>    
            <div style="margin-left: -200px;" class="col"><center><h5>Lista de Mecanicos cadastrados</h5></center>
              <ul style="text-align: left;" class="list-group">
                <?php

                $cliente1 ="SELECT * FROM `mecanico` WHERE `cod_oficina` = $cod_oficina";
                $resultado_cliente1 = mysqli_query($conn,$cliente1);
                $num1 = mysqli_num_rows($resultado_cliente1);

                if ($num1 != 0) {
                  while ($vetor_veiculo = mysqli_fetch_array($resultado_cliente)) {
                    echo "<li class='list-group-item itens'><p>".$vetor_veiculo["nome"]."</p></li>";
                  }
                }
                else{
                  echo "<li class='list-group-item itens'><p>Não há Mecânicos cadastrados</p></li>";
                }
                



                ?>
              </ul>
            </div></div>
          </div>
          <script src="js/validar_form2.js"></script>
          <script src="js/validar_form.js"></script>
          <script type="text/javascript" src="js/jquery.mask.min.js"></script>
          <div class="" id="form_mecanico" style="display: none">
            <form action="cadastrar_mecanico.php" method="POST">
             <h3 >Formulário Cadastrar Usuário</h3>
             <label for="ex3">*Itens obrigatórios</label><br> 

             <div class="row">
              <div class="col ">
                <label for="ex3">Login:*</label><br>

                <input class="form-control"  name="login"  minlength="6" type="text" required>
              </div>
              <div class="col">
                <label for="ex3">Senha:*</label><br>

                <input class="form-control"  name="senha"  minlength="6" type="password" required>
              </div>

            </div>
            <div class="row">
              <div class="col ">
                <label for="ex3">Primeiro nome:*</label><br>

                <input class="form-control"   name="nome" type="text" pattern="[a-z\s]+$"   required>
              </div>
              <div class="col">
                <label for="ex3">Sobrenome:*</label><br>
                <input class="form-control"   name="sobrenome" pattern="[a-z\s]+$"  type="text" required></td>
              </div>
            </div>
            <div class="row">
              <div class="col ">
               <label for="ex3">Data de nascimento:*</label><br>
               <input class="form-control" type="date" name="data" maxlength="10" pattern="[0-9]{2}/[0-9]{2}/[0-9]{4}" placeholder="00/00/0000" OnKeyPress="formatar('##/##/####', this)" minlength="10" required>
             </div>
             <div class="col">
              <label for="ex3">Telefone:</label><br>
              <input class="form-control" type="text" name="telefone" maxlength="12" pattern="[0-9]{2} [0-9]{4}-[0-9]{4}" placeholder="00 0000-0000" OnKeyPress="formatar('## ####-####', this)" minlength="12">
            </div>
            <div class="col">
              <label for="ex3">Celular:</label><br>
              <input class="form-control" type="text" name="celular" maxlength="12" pattern="[0-9]{2} [0-9]{4}-[0-9]{4}" placeholder="00 0000-0000" OnKeyPress="formatar('## ####-####', this)" minlength="12">
            </div>

          </div>
          <div class="row">
            <div class="col ">
             <label for="ex3">RG:*</label><br>
             <input class="form-control" type="text" name="rg" maxlength="12" pattern="[0-9]{2}.[0-9]{3}.[0-9]{3}-[0-9]" placeholder="XX.XXX.XXX-X" OnKeyPress="formatar('##.###.###-#', this)" minlength="12" required >
           </div>
           <div class="col">
            <label for="ex3">CPF:*</label><br>
            <input class="form-control" type="text" name="cpf" maxlength="14" pattern="[0-9]{3}.[0-9]{3}.[0-9]{3}-[0-9]{2}" placeholder="XXX.XXX.XXX-XX" OnKeyPress="formatar('###.###.###-##', this)" minlength="14" required >
          </div>
          <div class="col">
            <label for="ex3">Estado:*</label><br>
            <select class="form-control" id="estados" name="estado"> 
              <option value=""></option>
            </select>
          </div>

        </div>
        <div class="row">
          <div class="col ">
            <label for="ex3">Cidade:*</label><br>
            <select id="cidades" name="cidade" class="form-control">
            </select>
          </div>
          <div class="col">
            <label for="ex3">Bairro:*</label><br>
            <input class="form-control"   name="bairro" type="text" required>
          </div>
          <div class="col">
            <label for="ex3">Rua:*</label><br>
            <input class="form-control"   name="bairro" type="text" required>
          </div>

        </div>
        <div class="row">
          <div class="col ">
            <label for="ex3">Numero:*</label><br>
            <input class="form-control"   name="numero" type="text" pattern="[0-9]+$" required>
          </div>
          <div class="col">
            <label for="ex3">Complemento:</label><br>
            <input class="form-control"  name="complemento" type="text">
          </div>
          <div class="col">
            <label for="ex3">cep:</label><br>
            <input class="form-control"  id="cep" type="text" required>
          </div>

        </div>

<script type="text/javascript">
  $(document).ready(function(){
    $('#cep').mask('00.000-000');
  })
</script>
        <br>
        <div><center><button class="btn btn-primary" type="submit" name=""> Enviar</button></center></div>
      </form>
    </div>

  </div>
  <div class="modal fade" id="ima" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Galeria de imagens</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <div class='card-group'>
            <?php 


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


            ?>
            
            <button class="btn btn-secondary" style="height: 40px; margin-top: 40px;margin-left: 35px;" data-toggle="modal" data-target="#envia_img" data-dismiss="modal"><i class="fas fa-plus"></i></button></div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>

          </div>
        </div>
      </div>
    </div>
    <div class="modal fade" id="envia_img" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Escolher imagens</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">

            <form method="post" enctype="multipart/form-data" action="foto_mecanico.php">

              <input type="file" class="form-control" name="arquivo">

            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
              <button type="submit" name="opcao" value="0" class="btn btn-primary">Enviar</button></form>
            </div>
          </div>
        </div>
      </div>
      <script type="text/javascript">
        var ctx = document.getElementById('myChart').getContext('2d');
        var chart = new Chart(ctx, {
    // The type of chart we want to create
    type: 'line',

    // The data for our dataset
    data: {
      labels: ["January", "February", "March", "April", "May", "June", "July"],
      datasets: [{
        label: "My First dataset",
        backgroundColor: 'rgb(255, 99, 132)',
        borderColor: 'rgb(255, 99, 132)',
        data: [0, 10, 5, 2, 20, 30, 45],
      }]
    },

    // Configuration options go here
    options: {}
  });
</script>
<script>
  $(document).ready(function () {
    $("#btn_mecanico").click(function(){
      if ($("#form_mecanico").css("display") == "none") {
        $("#graph").css("display", "none");
        $("#form_mecanico").css("display", "block");
      }
      
    })
    $("#btn_graph").click(function(){
      if ($("#graph").css("display") == "none") {
        $("#form_mecanico").css("display", "none");
        $("#graph").css("display", "block");
      }

    })
  });
</script>

</main>
</div>






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