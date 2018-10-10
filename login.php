<?php
    //Verificando se ja existe uma sessão aberta

    //Mantendo a sessão/cria uma sessao
session_start();

if(!isset($_SESSION["system_control"]))
{
  ?>
  <!doctype html>
  <html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="stylesheet" type="text/css" href="scss/main.css">
    <link rel="stylesheet" type="text/css" href="css/login.css">
    <style type="text/css">
    ::-webkit-scrollbar-track {
      background-color: #F4F4F4;
    }
    ::-webkit-scrollbar {
      width: 6px;
      background: #F4F4F4;
    }
    ::-webkit-scrollbar-thumb {
      background: #dad7d7;
    }

    body    {overflow-y:scroll;}
  </style>


  <title>Oficina PRO</title>
  <style type="text/css">
  .cortar{
    object-fit: cover; object-position: center;
  }
</style>
<!-- Bootstrap core CSS -->
<link rel="stylesheet" href="scss/main.css">

<!-- Custom styles for this template -->
<link href="css/carousel.css" rel="stylesheet">
</head>
<body>


  <header>
   <?php
   require('navbar.html');
   ?>
 </header>

 <main role="main">

  <section class="about-sec parallax-section" id="about" style="height: 100%;margin-top: -30px;" >
    <div class="container" >
      <div class="card card-container" >
        <img id="profile-img" class="profile-img-card" src="//ssl.gstatic.com/accounts/ui/avatar_2x.png" />
        <p id="profile-name" class="profile-name-card"></p>
        <div id="erro" style="display: block"></div>
          
        <span id="reauth-email" class="reauth-email"></span>
        <input type="text" id="inputEmail" style="margin-bottom: 10px;" class="form-control" placeholder="Login" name="c_login" required autofocus>
        <input type="password" style="margin-bottom: 10px;" id="inputPassword" class="form-control" name="c_senha" placeholder="Senha" required>

        <button class="btn btn-primary" style="width: 100%" id="send">Entrar</button>
        
        <button type="button" class="btn btn-link" data-toggle="modal" data-target="#exampleModal">
          Esqueceu a senha?
        </button>
      </div>

    </div>
  </section>
</main>
<script>
  $('#send').click(function(){
    $.post( "verifica_login.php", { c_login: $("#inputEmail").val() , c_senha: $("#inputPassword").val() })
    .done(function( data ) {
      $("#erro").text("");
      $("#erro").append(data)
      
    });
  })
</script>

<!-- Button trigger modal -->


<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Recuperar Senha</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form>
        Coloque seu email:
        <input type="text" class="form-control" name="email">
      </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
        <button type="button" class="btn btn-primary">Enviar</button>
      </div>
    </div>
  </div>
</div>
</body>
</html>

<?php
}
else if($_SESSION["system_control"] == 1)
{

  if($_SESSION["privilegio"] == 0){
    ?>
    <script language='JavaScript'>
      document.location.href="perfil_cliente.php";
    </script>
    <?php
  }
  else if ($_SESSION["privilegio"] == 1) {
    ?>
    <script language='JavaScript'>
      document.location.href="perfil_mecanico.php";
    </script>
    <?php
  }
  else if ($_SESSION['privilegio'] == 2) {
    ?>
    <script language='JavaScript'>
      document.location.href="perfil_oficina.php";
    </script>
    <?php
  }
  else{
    echo "erro";
  }

}
?>