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



    ?>
<!DOCTYPE html>
<html lang="en">
<head>

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  
</head>
<body>
  <?php require("navbar_logout.html"); ?>

  <div class="container" style="margin-top: 60px">
    <h3 >Formulário Cadastrar veiculo</h3>
    
    <form action="cadastrar_veiculo.php" method="POST">
      <script
src="https://code.jquery.com/jquery-3.2.0.min.js"
integrity="sha256-JAW99MJVpJBGcbzEuXk4Az05s/XyDdBomFqNlM3ic+I="
crossorigin="anonymous"></script>
  <select name="marcas" class="form-control" id="marcas">
    <option>Selecione uma Marca</option>
  </select>
  
  <div id="div"></div>
  <script>
    $( document ).ready(function() {

      $.getJSON('http://fipeapi.appspot.com/api/1/carro/marcas.json', function(data) {
        var select = ''

        for (var i in data) {

          select += '<option value="'+ data[i].id +'">'+ data[i].fipe_name + '</option>';

        }
        
        $('#marcas').append(select);

      });

      $( "#marcas" )
      .change(function () {
        var str = "";
        $( "#marcas option:selected" ).each(function() {
          str = $( this ).val();
          $.getJSON('http://fipeapi.appspot.com/api/1/carros/veiculos/'+str+'.json', function(data) {

            var select = '<select class="form-control">';
            for (var i in data) {

              select += '<option value="'+data[i].id +'">'+ data[i].name + '</option>';

            }
            select += '</select>';
            $('#div').html(select);

          });
        });
    
      })
      .change();

    });




  </script>
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