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
    $codigo_mecanico = $_GET['codigo'];
    $sql_pesquisa ="SELECT * FROM `mecanico` WHERE `cod_mecanico` = $codigo_mecanico";
    $resultado = mysqli_query($conn,$sql_pesquisa);
    $vetor = mysqli_fetch_array($resultado);
     $log =$vetor['cod_login'];
    $sql_servico2 ="DELETE FROM `login` WHERE `cod_login` = $log";
    $query_servico2 = mysqli_query($conn,$sql_servico2); 
    $sql_servico1 ="DELETE FROM `mecanico` WHERE `cod_mecanico` = $codigo_mecanico";
    $query_servico1 = mysqli_query($conn,$sql_servico1); 
    $sql = "UPDATE `servico` SET `cod_mecanico`=0 WHERE `cod_mecanico` = $codigo_mecanico";
    $query_servico3 = mysqli_query($conn,$sql); 

    ?>
    <html lang="en">
    <head>
      <!-- Required meta tags -->
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
      <link rel="stylesheet" href="scss/main.css">


      <title>Concluído</title>
    </head>
    <body>
      <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
      <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
      <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
      <div class="modal fade" id="exampleModalLong" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLongTitle">Sucesso</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              Mecânico excluído com sucesso
            </div>
            <div class="modal-footer">

              <a  href="perfil_oficina.php" class="btn btn-primary">Voltar</a>
            </div>
          </div>
        </div>
      </div>
      <script>
        $(document).ready(function(){
          $('#exampleModalLong').modal('show')
          $('#exampleModalLong').on('hidden.bs.modal', function (e) {
           window.location.href = 'perfil_oficina.php';
         })

        })
      </script>
      <!-- Optional JavaScript -->
      <!-- jQuery first, then Popper.js, then Bootstrap JS -->

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