<?php
$nome = $_POST['nome'];
$sobrenome = $_POST['sobrenome'];
$telefone = $_POST['telefone'];
$celular = $_POST['celular'];
$rg = $_POST['rg'];
$cpf1 = $_POST['cpf'];
$estado = $_POST['estado'];
$cidade = $_POST['cidade'];
$rua = $_POST['rua'];
$bairro = $_POST['bairro'];
$numero = $_POST['numero'];
$complemento = $_POST['complemento'];
$login = $_POST['login'];
$senha = $_POST['senha'];
$cep = $_POST['cep'];
$data_nascimento = $_POST['data'];
require("connect.php");
function soNumero($str) {
    return preg_replace("/[^0-9]/", "", $str);
}

$senha1 = base64_encode($senha);
$cpf = soNumero($cpf1);
$rgn = soNumero($rg);
$celularn = soNumero($celular);
$telefonen = soNumero($telefone);
$cepn = soNumero($cep);



$sql_pesquisa ="select * from `login` where `login` = '$login'" ;
$resultado = mysqli_query($conn,$sql_pesquisa); 
$numero = mysqli_num_rows($resultado);
$vetor_login = mysqli_fetch_array($resultado);
$sql ="select * from `cliente` where  `cpf` = '$cpf' || `rg` = $rgn" ;
$resultado_sql = mysqli_query($conn,$sql); 
$numero_cliente = mysqli_num_rows($resultado_sql);

if($numero == 0 && $numero_cliente == 0){

    $sql_login = "INSERT INTO `login`(`login`, `senha`, `privilegio`) VALUES ('$login','$senha1',0)";
    $resultado_login = mysqli_query($conn, $sql_login);


    $sql_cod ="select * from `login` where `login` = '$login'" ;
    $resultado_cod = mysqli_query($conn,$sql_cod);
    $vetor_cod = mysqli_fetch_array($resultado_cod);
    $cod_login = $vetor_cod['cod_login'];
    $sql_cliente = "INSERT INTO `cliente`(`cod_login`, `nome`, `rg`, `cpf`, `rua`, `estado`, `cep`, `cidade`, `telefone`, `bairro`, `complemento`, `sobrenome`, `numero`, `celular`,`data_nascimento`) VALUES ($cod_login,'$nome',$rgn,'$cpf','$rua','$estado',$cepn,'$cidade',$telefonen,'$bairro','$complemento','$sobrenome',$numero,$celularn,'$data_nascimento')";
    $insere = mysqli_query($conn,$sql_cliente);
    ?>
    <html>
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
                <h5 class="modal-title" id="exampleModalLongTitle">Cadastrado</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
              </button>
          </div>
          <div class="modal-body">
            Cadastro feito com sucesso!!
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
 ?>
 <html>
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
        CPF ou RG já cadastrados
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
<?php }



?>