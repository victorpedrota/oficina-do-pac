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
  $cod_cliente = $_SESSION["cod_cliente"];
  if($system_control == 1 && $privilegio == 0){
    require('connect.php');

    $sql_pesquisa ="SELECT * FROM `cliente` WHERE `cod_login` = $cod_login" ;
    $resultado = mysqli_query($conn,$sql_pesquisa); 
    $vetor = mysqli_fetch_array($resultado);
    

    $oficina ="SELECT * FROM `oficina` ORDER BY `nome`";
    $oficinas_query = mysqli_query($conn,$oficina); 
    $numero_oficina = mysqli_num_rows($oficinas_query);

    $sql ="SELECT * FROM `login` WHERE `cod_login` = $cod_login" ;
    $resultado_pesquisa = mysqli_query($conn,$sql); 
    $vetor_login = mysqli_fetch_array($resultado_pesquisa);

    $sql_veiculo ="SELECT * FROM `veiculo` WHERE `cod_cliente` = $cod_cliente" ;
    $veiculo_resultado = mysqli_query($conn,$sql_veiculo); 
    $numero_veiculos = mysqli_num_rows($veiculo_resultado);
    
    ?>

    <!DOCTYPE html>
    <html>
    <head>
      <title>Oficina Pro</title>
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
      <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">


    </head>
    <body>
      <?php
      require("navbar_logout.html");
      ?>
      <style type="text/css">

   body
   {
    font-family: 'Open Sans', sans-serif;
  }

  .fb-profile img.fb-image-lg{
    z-index: 0;
    width: 100%;  
    margin-bottom: 10px;
  }

  .fb-image-profile
  {
    margin: -90px 10px 0px 50px;
    z-index: 9;
    width: 20%; 
  }

  @media (max-width:768px)
  {

    .fb-profile-text>h1{
      font-weight: 700;
      font-size:16px;
    }

    .fb-image-profile
    {
      margin: -45px 10px 0px 25px;
      z-index: 9;
      width: 20%; 
    }
  }</style>
</div>
  </div>
</div>
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Abrir chamado</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form method="POST" action="abrir_chamado.php">
          Selecionar Oficina:
          <select name="n_oficina" class="form-control"> 
            <option>selecione uma oficina</option>
            <option>
             <?php 
             for ($i=0; $i < $numero_oficina ; $i++) {
              $vetor_oficina = mysqli_fetch_array($oficinas_query);
              echo " <option value=" . $vetor_oficina['cod_oficina'] . " > " . $vetor_oficina['nome']. "</option>";
            }

            ?>

          </select>
          Selecionar Veiculo:
          <select class="form-control" name="veiculo" required> 
            <option>selecione seu veiculo</option>
            <option>
             <?php 
             if($numero_veiculos == 0 ){echo " <option>Sem veiculos cadastrados</option>";}
             else{
               while ($vetor_veiculo = mysqli_fetch_array($veiculo_resultado)) {
                echo " <option value=" . $vetor_veiculo['cod_veiculo'] . " > " . $vetor_veiculo['modelo']. "</option>";
              }}

              ?>

            </select>
            Tipo de Serviço:
            <input type="text" class="form-control" name="tipo" required>

          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
            <button type="submit" class="btn btn-primary">Abrir</button></form>
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