<?php

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


    <title>Oficina PRO</title>
    <style type="text/css">
    .cortar{
      object-fit: cover; object-position: center;
    }
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
</style>
<!-- Bootstrap core CSS -->
<link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">

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

  <div id="myCarousel" class="carousel slide" data-ride="carousel">
    <ol class="carousel-indicators">
      <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
      <li data-target="#myCarousel" data-slide-to="1"></li>
      <li data-target="#myCarousel" data-slide-to="2"></li>
    </ol>
    <div class="carousel-inner">
      <div class="carousel-item active">
        <img class="first-slide cortar" src="https://www.canaldapeca.com.br/blog/wp-content/uploads/sites/19/2016/08/Veja-o-que-%C3%A9-preciso-para-montar-uma-Oficina-Mec%C3%A2nica.jpg"  alt="First slide">
        <div class="container">
          <div class="carousel-caption text-left">
            <h1>Oficina Pro</h1>
            <p>Melhor jeito de acompanhar e ter o maior proveito de seu serviço</p>
            <p><a class="btn btn-lg btn-primary" href="form_cliente.php" role="button">Cadastrar-se</a></p>
          </div>
        </div>
      </div>
      <div class="carousel-item">
        <img class="second-slide cortar" src="http://geroscience.com/wp-content/uploads/2017/10/car-repair-362150_1920.jpg" alt="Second slide">
        <div class="container">
          <div class="carousel-caption">
            <h1>Saiba mais</h1>
            <p>Conheça nossa equipe e saiba mais sobre nós.</p>
            <p><a class="btn btn-lg btn-primary" href="#" role="button">Saiba mais.</a></p>
          </div>
        </div>
      </div>
      <div class="carousel-item">
        <img class="third-slide cortar" src="http://blog.mabore.com.br/wp-content/uploads/2015/07/1000767_299602686842906_1414781459_n20.jpg" alt="Third slide">
        <div class="container">
          <div class="carousel-caption text-right">
            <h1>Já possui Cadastro?</h1>
            <p>Entre e faça orçamentos ou acompanhe seu serviço em tempo real.</p>
            <p><a class="btn btn-lg btn-primary" href="login.php" role="button">Entrar</a></p>
          </div>
        </div>
      </div>
    </div>
    <a class="carousel-control-prev" href="#myCarousel" role="button" data-slide="prev">
      <span class="carousel-control-prev-icon" aria-hidden="true"></span>
      <span class="sr-only">Previous</span>
    </a>
    <a class="carousel-control-next" href="#myCarousel" role="button" data-slide="next">
      <span class="carousel-control-next-icon" aria-hidden="true"></span>
      <span class="sr-only">Next</span>
    </a>
  </div>


      <!-- Marketing messaging and featurettes
        ================================================== -->
        <!-- Wrap the rest of the page in another container to center all the content. -->

        <div class="container marketing">

          <!-- Three columns of text below the carousel -->
          <div class="row">
            <div class="col-lg-4">
              <i class="fas fa-car fa-10x"></i>
              <h2>Objetivos</h2>
              <p>Ser objetivo e profissional é essencial para nosso projeto, buscando ser útil e confiável para oferecer uma boa proposta de atendimento.</p>
              
            </div><!-- /.col-lg-4 -->
            <div class="col-lg-4">
              <i style="margin-top: 10px;margin-bottom: 20px;" class="fas fa-wrench fa-8x"></i>
              <h2>Ferramentas</h2>
              <p> Nossas ferramentas de trabalho foram muito úteis para o bom desenvolvimento do projeto, fazem ele ser possivel.</p><br><br><center><p><a class="btn btn-secondary" href="#" role="button">Ver detalhes &raquo;</a></p></center>
              
            </div><!-- /.col-lg-4 -->
            <div class="col-lg-4">  
              <i class="fas fa-copy fa-10x"></i>
              <h2>Planejamento</h2>
              <p> O meio financeiro foi pensando para que não haja muitos erros que influênciem negativamente no orçamento do serviço.</p>
              
            </div><!-- /.col-lg-4 -->

          </div><!-- /.row -->


          <!-- START THE FEATURETTES -->

          <hr class="featurette-divider">

          <div class="row featurette">
            <div class="col-md-7" style="margin-top: -50px;">
              <h2 class="featurette-heading">Nossa equipe trabalha o máximo para te ajudar. <span class="text-muted">Venha conhecer quem somos</span></h2><br><center><a href="about.php" class="btn btn-primary btn-lg" style="border-radius: 30px">Sobre nós</a></center>
             
            </div>
            <div class="col-md-5">
              <img class="cortar" style="width: 400px;height: 300px;" src="https://support.content.office.net/pt-br/media/461a7a87-5e61-4318-8642-8a84df7b498d.jpg">
            </div>
          </div>

          <hr class="featurette-divider">


        <!-- FOOTER -->
        <footer class="container">
          <p class="float-right"><a href="#">De volta ao topo</a></p>
          <p>&copy; 2017-2018 Oficina Pro, Inc. &middot; <a href="#">Privacy</a> &middot; <a href="#">Terms</a></p>
        </footer>
      </main>

    
      
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
        document.location.href="perfil_cliente.php";
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