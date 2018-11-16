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
  require("connect.php");
  $system_control = $_SESSION["system_control"];   
  $cod_login = $_SESSION['cod_login'];
  $privilegio = $_SESSION["privilegio"];
  //$cod_cliente = $_SESSION['cod_cliente'];      
  $cliente ="select * from `cliente` where `cod_login` = $cod_login";
  $resultado_cliente = mysqli_query($conn,$cliente);
  $vetor_cliente = mysqli_fetch_array($resultado_cliente);
  $cod_cliente = $vetor_cliente['cod_cliente'];
  if($system_control == 1 && $privilegio == 0){
    $modelo = $_POST['modelo'];
    $marca = $_POST['marca'];
    $cor = $_POST['cor'];
    $ano = $_POST['ano'];
    $placa = $_POST['placa'];
    $tipo = $_POST['tipo'];
    $opcao = $_POST['opcao'];
    $sql ="select * from `veiculo` where  `placa` = '$placa'" ;
    $resultado_sql = mysqli_query($conn,$sql); 
    $numero_veiculo = mysqli_num_rows($resultado_sql);
    if ($opcao == 1) {
      $codigo = $_POST['codigo'];
      $sql = "UPDATE `veiculo` SET `modelo`='$modelo',`cor`='$cor',`ano`='$ano',`placa`='$placa',`marca`='$marca',`tipo`='$tipo' WHERE `cod_veiculo` = $codigo";
      $insere = mysqli_query($conn,$sql);
      ?>
       <!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<link rel="stylesheet" href="scss/main.css">
    

    <title>Sucesso</title>
  </head>
  <body>
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <div class="modal fade" id="exampleModalLong" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Concluído</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        Veículo alterado com sucesso
      </div>
      <div class="modal-footer">
        
        <a  href="form_veiculo.php" class="btn btn-primary">Voltar</a>
      </div>
    </div>
  </div>
</div>
<script>
  $(document).ready(function(){
    $('#exampleModalLong').modal('show')
    $('#exampleModalLong').on('hidden.bs.modal', function (e) {
 window.location.href = 'form_veiculo.php';
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
      if( $numero_veiculo == 0){
        $sql = "INSERT INTO `veiculo`(`modelo`, `cor`, `ano`, `marca`,`placa`,`cod_cliente`,`tipo`) VALUES ('$modelo','$cor','$ano','$marca','$placa',$cod_cliente,'$tipo')";
        $insere = mysqli_query($conn,$sql);
        ?>
        <!doctype html>
        <html lang="en">
        <head>
          <!-- Required meta tags -->
          <meta charset="utf-8">
          <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
          <link rel="stylesheet" href="scss/main.css">


          <title>Sucesso</title>
        </head>
        <body>
          <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
          <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
          <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
          <div class="modal fade" id="exampleModalLong" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
            <div class="modal-dialog" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalLongTitle">Concluído</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="modal-body">
                  Veículo cadastrado com sucesso
                </div>
                <div class="modal-footer">

                  <a  href="form_veiculo.php" class="btn btn-primary">Voltar</a>
                </div>
              </div>
            </div>
          </div>
          <script>
            $(document).ready(function(){
              $('#exampleModalLong').modal('show')
              $('#exampleModalLong').on('hidden.bs.modal', function (e) {
               window.location.href = 'form_veiculo.php';
             })
            })
          </script>
          <!-- Optional JavaScript -->
          <!-- jQuery first, then Popper.js, then Bootstrap JS -->

        </body>
        </html>
        <?php   
      }
      else{?>
        <!doctype html>
        <html lang="en">
        <head>
          <!-- Required meta tags -->
          <meta charset="utf-8">
          <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
          <link rel="stylesheet" href="scss/main.css">


          <title>Erro</title>
        </head>
        <body>
          <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
          <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
          <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
          <div class="modal fade" id="exampleModalLong" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
            <div class="modal-dialog" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalLongTitle">Erro</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="modal-body">
                  Veículo já cadastrado no sistema
                </div>
                <div class="modal-footer">

                  <a  href="form_veiculo.php" class="btn btn-primary">Voltar</a>
                </div>
              </div>
            </div>
          </div>
          <script>
            $(document).ready(function(){
              $('#exampleModalLong').modal('show')
              $('#exampleModalLong').on('hidden.bs.modal', function (e) {
               window.location.href = 'form_veiculo.php';
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
    
  }
  else
  {
            //Finalizando a sessão
    session_destroy();
            //Mensagem para o Usuário
    require('erro.php');           
    
  }
}
?>