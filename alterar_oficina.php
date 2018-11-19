 <?php
    //Mantendo a sessão/cria uma sessao
session_start();

if(!isset($_SESSION["system_control"]))
{
  require('erro.php');      
}
else{
        
  

  $system_control = $_SESSION["system_control"];   
  
  $privilegio = $_SESSION["privilegio"];

  if($system_control == 1 && $privilegio == 2){
    $cod_login = $_SESSION['cod_login'];
    require('connect.php');

    $sql_pesquisa ="SELECT * FROM `mecanico` WHERE `cod_login` = $cod_login" ;
    $resultado = mysqli_query($conn,$sql_pesquisa); 
    $vetor = mysqli_fetch_array($resultado);
    
    function soNumero($str) {
    return preg_replace("/[^0-9]/", "", $str);
}

if (isset ($_POST['senha_antiga'])) {
  $sql_login ="SELECT * FROM `login` WHERE `cod_login` = $cod_login" ;
  $resultado_login = mysqli_query($conn,$sql_login);
  $vetor_login = mysqli_fetch_array($resultado_login);
  $senha_c = $vetor_login['senha'];
  $senha = $_POST['senha_antiga'];
  $senha_nova = $_POST['senha_nova'];
  $senha_nova1 = base64_encode($senha_nova);
  $senha1 = base64_decode($senha_c);

  if ($senha == $senha1) {
   $oficina ="UPDATE `login` SET `senha`='$senha_nova1' WHERE `cod_login` = $cod_login";
  $oficinas_query = mysqli_query($conn,$oficina);
  ?>
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
        <h5 class="modal-title" id="exampleModalLongTitle">Senha alterada com sucesso!</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        Sua senha foi alterada!
      </div>
      <div class="modal-footer">
        
        <a  href="form_alterar_oficina.php" class="btn btn-primary">Voltar</a>
      </div>
    </div>
  </div>
</div>
<script>
  $(document).ready(function(){
    $('#exampleModalLong').modal('show')
    $('#exampleModalLong').on('hidden.bs.modal', function (e) {
 window.location.href = 'form_alterar_oficina.php';
})

  })
</script>
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    
  </body>
</html>
    <?php  
  }else{
    ?>
    <html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<link rel="stylesheet" href="scss/main.css">
    

    <title>erro</title>
  </head>
  <body>
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <div class="modal fade" id="exampleModalLong" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Erro!</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        Senha incorreta
      </div>
      <div class="modal-footer">
        
        <a  href="form_alterar_oficina.php" class="btn btn-primary">Voltar</a>
      </div>
    </div>
  </div>
</div>
<script>
  $(document).ready(function(){
    $('#exampleModalLong').modal('show')
    $('#exampleModalLong').on('hidden.bs.modal', function (e) {
 window.location.href = 'form_alterar_oficina.php';
})

  })
</script>
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    
  </body>
</html><?php
  }
}else if (isset($_POST['uf'])) {
  
    
    
    $telefone = soNumero($_POST['telefone']);
  
    $cep =  soNumero($_POST['cep']);
    $estado = $_POST['uf'];
    $cidade = $_POST['cidade'];
    $bairro = $_POST['bairro'];
    $rua = $_POST['rua'];
    $numero = $_POST['numero'];
    $complemento = $_POST['complemento'];
    $celular =  soNumero($_POST['celular']);
    


    
        $sql_pesquisa ="UPDATE `oficina` SET `rua`='$rua',`estado`='$estado',`cep`=$cep,`cidade`='$cidade',`telefone`='$telefone',`bairro`='$bairro',`complemento`= '$complemento',`numero`='$numero',`celular`='$celular' WHERE `cod_login` = $cod_login" ;

        $resultado = mysqli_query($conn,$sql_pesquisa);
        
       

    ?>
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
        <h5 class="modal-title" id="exampleModalLongTitle">Sucesso</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        Informações Atualizadas!
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
}else{
  ?>
   <html>
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<link rel="stylesheet" href="scss/main.css">
    

    <title>erro</title>
  </head>
  <body>
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <div class="modal fade" id="exampleModalLong" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">erro</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        Erro 
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
  }
  else
  {
            //Acesso Inválido

            //Finalizando a sessão
    session_destroy();

            //Mensagem para o Usuário
   require('erro.php');        
  }
}
?>