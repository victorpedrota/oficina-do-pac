<?php
    //Verificando se ja existe uma sessão aberta

    //Mantendo a sessão/cria uma sessao
session_start();

if(!isset($_SESSION["system_control"]))
{
    ?>
    <html>
    <head>
      <title>Oficina Pro</title>
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
      <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
      <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
      <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
      <script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
      <link href="css/login.css" rel="stylesheet">

  </head>
  <body>

      <?php
      require("navbar2.html");
      ?>

      <section class="about-sec parallax-section" id="about" style="height: 100%">
        <div class="container">
          <div class="card card-container" >
            <img id="profile-img" class="profile-img-card" src="//ssl.gstatic.com/accounts/ui/avatar_2x.png" />
            <p id="profile-name" class="profile-name-card"></p>
            <form class="form-signin" method="POST" action="verifica_login.php">
                <span id="reauth-email" class="reauth-email"></span>
                <input type="text" id="inputEmail" class="form-control" placeholder="Login" name="c_login" required autofocus>
                <input type="password" id="inputPassword" class="form-control" name="c_senha" placeholder="Senha" required>
                
                <button class="btn btn-lg btn-primary btn-block btn-signin" type="submit">entrar</button>
            </form><!-- /form -->
            <a href="#" class="forgot-password">
                esqueceu a senha?
            </a>
        </div>

    </div>
</section>



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