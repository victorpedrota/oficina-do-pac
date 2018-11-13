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
    require('connect.php');

    $cod_oficina = $_POST['cod_oficina'];
    $tipo = $_POST['tipo'];
    $veiculo = $_POST['veiculo'];
    $servico = $_POST['servico'];
    $problema = $_POST['problema'];


    $protocolo = rand() . "\n";

    $sql = "SELECT * FROM `servico` WHERE `protocolo` = $protocolo";
    $protocol = mysqli_query($conn,$sql); 
    $vetor_pro = mysqli_fetch_array($protocol);
    $numero_protocolos= mysqli_num_rows($protocol);

    while ($vetor_pro['protocolo'] == $protocolo) {
      $protocolo = mt_rand() . "\n";
  }

  $sql_cliente = "INSERT INTO `servico`(`cod_cliente`, `tipo_servico`, `cod_veiculo`,`cod_oficina`,`protocolo`,`problema`,`servico_desejado`) VALUES ($cod_cliente,'$tipo',$veiculo,$cod_oficina,$protocolo,'$problema','$servico')";
  $insere = mysqli_query($conn,$sql_cliente);

  
  $sql = "SELECT * FROM `servico` WHERE `protocolo` = $protocolo";
  $c_servico = mysqli_query($conn,$sql);
  $vetor_servico = mysqli_fetch_array($c_servico);
  $cod_servico = $vetor_servico['cod_servico'];
  
  $sql = "INSERT INTO `status`(`status`, `cod_servico`) VALUES (0,$cod_servico)";
  $insere = mysqli_query($conn,$sql);
  ?>
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
        <h5 class="modal-title" id="exampleModalLongTitle">Concluído</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        Chamado feito com sucesso
      </div>
      <div class="modal-footer">
        
        <a  href="javascript: history.go(1)" class="btn btn-primary">Voltar</a>
      </div>
    </div>
  </div>
</div>
<script>
  $(document).ready(function(){
    $('#exampleModalLong').modal('show')
    $('#exampleModalLong').on('hidden.bs.modal', function (e) {
  e.preventDefault();
    history.back(1);
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