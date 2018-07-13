<?php
    //Verificando se ja existe uma sessão aberta

    //Mantendo a sessão/cria uma sessao
session_start();

if(!isset($_SESSION["system_control"]))
{
  ?>
  <!DOCTYPE html>
  <html>
  <head>
    <title>Oficina Pro</title>
    <style type="text/css">
    #container {
      display: inline-block;
      position: relative;
    }

    #container figcaption {
      position: absolute;
      top: 145px;
      right: 20px;
      font-size: 40px;
      color: black;
      text-shadow: 0px 0px 5px black;
    }
    
  </style>
  <meta charset="utf-8">
</head>
<body>
  <?php

  require('navbar2.html');
  ?>

<!-- Swiper Silder
  ================================================== --> 
  <!-- Slider main container -->
  <div class="swiper-container main-slider" id="myCarousel">

    <div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
      <div class="carousel-inner">
        <div class="carousel-item active">
          <img class="d-block w-100" src="imagens/velocimetro.jpg" alt="First slide">
        </div>
        <div class="carousel-item">
          <img class="d-block w-100" src="imagens/pagina1.jpg" alt="Second slide">
        </div>
        <div class="carousel-item">

          <img class="d-block w-100" src="imagens/carro.png" alt="Third slide">

        </div>
      </div>
      <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="sr-only">Previous</span>
      </a>
      <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="sr-only">Next</span>
      </a>
    </div>
  </div>

<!-- Benefits
  ================================================== -->
  <section class="service-sec" id="benefits" >

    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <div class="heading">
            <h2 name="beneficios">veja os principais beneficios que nosso site traz a você</h2>
          </div>
        </div>
        <div class="col-md-8">
          <div class="row">
            <div class="col-md-6 text-sm-center service-block"> <i class="fa fa-plus" aria-hidden="true"></i>
              <h3>Profissionalidade</h3>
              <p>Nós temos total profissionalidade e comprometimento com nosso trabalho e nossos clientes.</p>
            </div>
            <div class="col-md-6 text-sm-center service-block"> <i class="fa fa-leaf" aria-hidden="true"></i>
              <h3>Praticidade</h3>
              <p>O site possui um layout simples e de fácil compreensão, para que nossos usuários possam usar facilmente.</p>
            </div>
            <div class="col-md-6 text-sm-center service-block"> <i class="fa fa-leaf" aria-hidden="true"></i>
              <h3>Preço</h3>
              <p>Melhor busca nos preços, proporcionando maior acessibilidade a preços.</p>
            </div>
            <div class="col-md-6 text-sm-center service-block"><i class="fa fa-bell" aria-hidden="true"></i>
              <h3>Sempre alerta</h3>
              <p>Você sempre alerta sobre seu carro e cobranças.</p>
            </div>
          </div>
        </div>
        <div class="col-md-4"> <img src="imagens/mecanico.jpg" class="img-fluid" /> </div>
      </div>
      <!-- /.row --> 
    </div>
  </section>

<!-- About 
  ================================================== -->
  <section class="about-sec parallax-section" id="about">
    <div class="container">
      <div class="row">
        <div class="col-md-3">
          <h2><small>Quem nós fucking somos</small>Sobre<br>
          Nós</h2>
        </div>
        <div class="col-md-4">
          <p>(pdp que esse texto ai é só conceitual tlgd)To enjoy good health, to bring true happiness to one's family, to bring peace to all, one must first discipline and control one's own mind. If a man can control his mind he can find the way to Enlightenment, and all wisdom and virtue will naturally come to him.</p>
          <p>Saving our planet, lifting people out of poverty, advancing economic growth... these are one and the same fight. We must connect the dots between climate change, water scarcity, energy shortages, global health, food security and women's empowerment. Solutions to one problem must be solutions for all.</p>
        </div>
        <div class="col-md-4">
          <p>Our greatest happiness does not depend on the condition of life in which chance has placed us, but is always the result of a good conscience, good health, occupation, and freedom in all just pursuits.</p>
          <p>Being in control of your life and having realistic expectations about your day-to-day challenges are the keys to stress management, which is perhaps the most important ingredient to living a happy, healthy and rewarding life.</p>
        </div>
      </div>
    </div>
  </section>

  <section class="action-sec">
    <div class="container">
      
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