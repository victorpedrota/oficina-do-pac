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

  if($system_control == 1 && $privilegio == 0){
    require('connect.php');

    $sql_pesquisa ="SELECT * FROM `cliente` WHERE `cod_login` = $cod_login" ;
    $resultado = mysqli_query($conn,$sql_pesquisa); 
    $vetor = mysqli_fetch_array($resultado);

    $sql ="SELECT * FROM `login` WHERE `cod_login` = $cod_login" ;
    $resultado_pesquisa = mysqli_query($conn,$sql); 
    $vetor_login = mysqli_fetch_array($resultado_pesquisa);
    ?>

    <!DOCTYPE html>
    <html>
    <head>
      <title>Oficina Pro</title>
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
      <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
      <style type="text/css">
      
      .main-section{
        border:1px solid #138496;
        background-color: #fff;
      }
      .profile-header{
        background-color: #343a40;
        height:93px;
      }
      .user-detail{
        margin:-50px 0px 30px 0px;
      }
      .user-detail img{
        height:100px;
        width:100px;
      }
      .user-detail h5{
        margin:15px 0px 5px 0px;
      }
      .user-social-detail{
        padding:15px 0px;
        background-color: #343a40;
      }
      .user-social-detail a i{
        color:#fff;
        font-size:23px;
        padding: 0px 5px;
      }
    </style>

  </head>
  <body>
    <?php
    require("navbar_logout.html");
    ?>

    
    <div class="row" style="margin-top: 30px">

      <div class="col main-section text-center">
        <div class="row">
          <div class="col-lg-12 col-sm-12 col-12 profile-header"></div>
        </div>
        <div class="row user-detail">
          <div class="col"><div class="container" style="margin-top: 10px">
            <img src="https://community.smartsheet.com/sites/default/files/default_user.jpg" class="rounded-circle img-thumbnail">
            <h5><?php echo $vetor['nome'] . ',' . $vetor['sobrenome']; ?></h5>
            <p><i class="fa fa-map-marker" aria-hidden="true"></i> <?php echo $vetor['cidade'] . ',' . $vetor['estado']; ?></p>

            <hr>
            <p>Login:<i class="fa fa-map-marker" aria-hidden="true"></i> <?php echo $vetor_login['login']; ?></p>
            <p> Telefone:<i class="fa fa-map-marker" aria-hidden="true"></i> <?php echo $vetor['telefone']; ?></p>
            <p>Celular:<i class="fa fa-map-marker" aria-hidden="true"></i> <?php echo $vetor['celular']; ?></p>
             <p>Estado:<i class="fa fa-map-marker" aria-hidden="true"></i> <?php echo $vetor['estado']; ?></p>
              <p>Bairro:<i class="fa fa-map-marker" aria-hidden="true"></i> <?php echo $vetor['bairro']; ?></p>
               <p>rua:<i class="fa fa-map-marker" aria-hidden="true"></i> <?php echo $vetor['rua']; ?></p>
                <p>Celular:<i class="fa fa-map-marker" aria-hidden="true"></i> <?php echo $vetor['numero'] . "," . $vetor['complemento']  ?></p>
            Senha: ******* <a href="" data-toggle="modal" data-target="#exampleModal"">clicar</a>
          <span class="glyphicon glyphicon-pencil"></span>
        </a>
            <hr>
            <a href="#" class="btn btn-info btn-sm">Voltar para página principal</a>
            <a href="form_alterar_usuario.php" class="btn btn-success btn-sm">Alterar Informações</a>
            
          </div>
        </div>
      </div>
      <div class="row user-social-detail">
        <div class="col" style="height: 45px">

        </div>
      </div>
    </div>
  </div>
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Alterar Senha</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form>
           <label for="inputAddress2">Nova senha:</label>
          <input type="text" class="form-control" name="" required>
           <label for="inputAddress2">Confirmar senha::</label>
          <input type="text" class="form-control" name="" required>
           <label for="inputAddress2">Atual:</label>
          <input type="text" class="form-control" name="" required>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Voltar</button>
        <button type="button" class="btn btn-primary">Enviar</button>
      </div>
    </div>
  </div>
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