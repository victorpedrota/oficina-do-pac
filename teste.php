<!DOCTYPE html>
<html>
<head>
	<title>Página inicial</title>
	  <link href="css/home.css" rel="stylesheet">
	  <link rel="stylesheet" href="scss/main.css">
	
	<style>
	.parallax {
		/* The image used */
		background-image: url("imagens/pagina1.jpg");

		/* Set a specific height */
		min-height: 500px; 

		/* Create the parallax scrolling effect */
		background-attachment: fixed;
		background-position: center;
		background-repeat: no-repeat;
		background-size: cover;
	}
</style>
<meta charset="utf-8">
</head>
<body>

	<?php

	require('navbar2.html');
	?>

	<div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
		<ol class="carousel-indicators">
			<li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
			<li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
			<li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
		</ol>
		<div class="carousel-inner">
			<div class="carousel-item active" style="width: 100%;height: 600px;">
				<img class="d-block w-100" src="imagens/slide1.jpg"  alt="First slide">
			</div>
			<div class="carousel-item" style="width: 100%;height: 600px;">
				<img class="d-block w-100" src="imagens/lukas.jpg"  alt="Second slide">
			</div>
			<div class="carousel-item" style="width: 100%;height: 600px;">
				<img class="d-block w-100" src="imagens/lukas.jpg"  alt="Third slide">
			</div>
		</div>
		<a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
			<span class="carousel-control-prev-icon" aria-hidden="true"></span>
			<span class="sr-only">Anterior</span>
		</a>
		<a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
			<span class="carousel-control-next-icon" aria-hidden="true"></span>
			<span class="sr-only">Próximo</span>
		</a>
	</div>
<div style="background-color: #2F4F4F;padding-bottom: 30px; padding-top: 30px">
	<div class="container">
      <div class="row">
        <div class="col-md-12">
          <div class="heading">
            <h2 name="beneficios">veja os principais beneficios que nosso site traz a você</h2><br>
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
        <div class="col-md-4"> <img src="imagens/mecanico3.png" class="img-fluid"> </div>

      </div>
      
    </div>
</div>

<div class="parallax"></div>
<div style="background-color: #2F4F4F;padding:50px;" >
	<div class="row"><h2>Quem nós somos?Sobre
          Nós</h2></div>
      <div class="row">
        
        <div class="col-md-4">
          <p>Somos um grupo de estudantes com o objetivo de apresentar um projeto de boa qualidade.Trazemos muito esforço e determinação para o desenvolvimento do site e uma ideia que pode evoluir o sistema que as oficinas usam atualmente.Portanto, estamos trabalhando e dando nosso melhor para entregar um projeto de respeito que assim possa ajudar e facilitar a vida dos nossos prezados clientes.</p>
        </div>
        <div class="col-md-4">
          <p>Estudamos atualmente no Colégio Joseense, localizado em São José dos Campos. Nosso professor de informatica(Alex Borges) está nos ajudando dando auxilio e corrigindo nossos erros para manter a qualidade. </p>
        </div>
      </div>
</div>
<div class="parallax"></div>

    <div  style="height: 150px;background-color:#2F4F4F "><center>
    	<div style="padding-top: 100px;padding-bottom: 30px;background-color: #2F4F4F">
      <a href="#"><img src="imagens/facebook.png" width="45" height="45"></a>
      <a href="#"><img src="imagens/Google.png" width="45" height="45"></a>
      <a href="#"><img src="imagens/instagram.png" width="45" height="45"></a>
      <a href="#"><img src="imagens/youtube.png" width="45" height="45"></a>
      <a href="#"><img src="imagens/whatsapp.png" width="45" height="45"></a></div></center>
    </div>

</body>
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
</html> 