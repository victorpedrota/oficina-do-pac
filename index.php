<?php

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
          <img class="d-block w-100" src="imagens/velocimetro2.jpg" alt="First slide">
          <img class="d-block w-100" src="imagens/velocimetro2.jpg" alt="First slide" height="750">
        </div>
        <div class="carousel-item">
          <img class="d-block w-100" src="imagens/carro1.jpg" alt="Second slide" height="750">
        </div>
        <div class="carousel-item">

          <img class="d-block w-100" src="imagens/motoris3.jpg" alt="Third slide" height="750">

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
              <h3>Diferenciais</h3>
              <p>Nossos profissionais sempre buscam a mais alta qualidade para entregar um serviço que faça o cliente satisfeitos, usando ferramentas e maquinas profissionais.</p>
            </div>
            <div class="col-md-6 text-sm-center service-block"> <i class="fa fa-leaf" aria-hidden="true"></i>
              <h3>Vantagens</h3>
              <p>Com uma boa vistoria é possivel ter mais confiança e autonomia ao usar o veículo.</p>
            </div>
            <div class="col-md-6 text-sm-center service-block"> <i class="fa fa-leaf" aria-hidden="true"></i>
              <h3>Recomendação</h3>
              <p>Fazemos recomendações de preços, peças e muito mais para o cliente ter uma vasta fonte de pesquisa pelo o melhor serviço e preço.<p>
            </div>
            <div class="col-md-6 text-sm-center service-block"><i class="fa fa-bell" aria-hidden="true"></i>
              <h3>Garantia</h3>
              <p>Oferecemos total garantia de serviços bem feitos, profissionais  e preços justos.</p>
            </div>
          </div>
        </div>

        <div class="col-md-4"> <img src="imagens/mecanico.jpg" class="img-fluid" /> </div>

        <div class="col-md-4"> <img src="imagens/mecanico3.png" class="img-fluid"> </div>

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
          <h2><small>Quem nós somos</small>Sobre
          Nós</h2>
        </div>
        <div class="col-md-4">
          <p>Somos um grupo de estudantes com o objetivo de apresentar um projeto de boa qualidade.Trazemos muito esforço e determinação para o desenvolvimento do site e uma ideia que pode evoluir o sistema que as oficinas usam atualmente.Portanto, estamos trabalhando e dando nosso melhor para entregar um projeto de respeito que assim possa ajudar e facilitar a vida dos nossos prezados clientes.</p>
        </div>
        <div class="col-md-4">
          <p>Estudamos atualmente no Colégio Joseense, localizado em São José dos Campos. Nosso professor de informatica(Alex Borges) está nos ajudando dando auxilio e corrigindo nossos erros para manter a qualidade. </p>
        </div>
      </div>
    </div>
  </section>

  <section class="action-sec">
    <center>
    <div class="container">
      <a href="#"><img src="imagens/facebook.png" width="45" height="45"></a>
      <a href="#"><img src="imagens/Google.png" width="45" height="45"></a>
      <a href="#"><img src="imagens/instagram.png" width="45" height="45"></a>
      <a href="#"><img src="imagens/youtube.png" width="45" height="45"></a>
      <a href="#"><img src="imagens/whatsapp.png" width="45" height="45"></a>
    </div></center>
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