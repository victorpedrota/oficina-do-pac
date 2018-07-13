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
  $cod_oficina = $_SESSION["cod_oficina"];
  $cod_mecanico = $_SESSION["cod_mecanico"];


  if($system_control == 1 && $privilegio == 1){
    require('connect.php');

    $sql_pesquisa ="SELECT * FROM `servico` WHERE `cod_oficina` = $cod_oficina";
    
    $resultado = mysqli_query($conn,$sql_pesquisa); 

    
    
    
    
    ?>

    <!DOCTYPE html>
<html>
<head>
  <title>Chamados</title>
</head>
<body>
  <?php require('navbar_logout.html');

  ?>
  <div class="container" style="margin-top: 75px;">

    <ul class="list-group">
      <?php 


            while ($vetor = mysqli_fetch_array($resultado)) {
              $cod_servico =$vetor['cod_servico'];
              $veiculo =$vetor['cod_veiculo'];
              $sql ="SELECT * FROM `status` WHERE `cod_servico` = $cod_servico";
              $resultado_sql = mysqli_query($conn,$sql); 
              $vetor1 = mysqli_fetch_array($resultado_sql);
              $status = $vetor1['status'];
              $sql1 ="SELECT * FROM `veiculo` WHERE `cod_veiculo` = $veiculo";
              $resultado_sql1 = mysqli_query($conn,$sql1);
              $vetor2 = mysqli_fetch_array($resultado_sql1);
               
              if ($status == 0) {
                $cod_cliente = $vetor['cod_cliente'];
                $cliente =" SELECT * FROM `cliente` WHERE `cod_cliente` = $cod_cliente";
                $resultado_cliente = mysqli_query($conn,$cliente); 
                $vetor_cliente = mysqli_fetch_array($resultado_cliente)
                ?>
                <li class="list-group-item">
                  Novo chamado de <?php echo $vetor_cliente['nome']; ?> 
                  <form method="POST" action="form_orcamento.php">
                  <div>Informações do chamado:<br><?php echo $vetor2['modelo'];echo $vetor2['ano'];  ?> <br>
                  	<h4>Descrição do serviço</h4>
                  	<?php echo $vetor['tipo_servico']; ?>
                  	<br></div>
                    <input type="hidden" name="cod_servico" value=<?php echo $vetor['cod_servico']; ?>>
                  <div style="float: right;"><input type="submit" value="Enviar orçamento" style="color: white;" class="btn btn-primary"></div>
                </li>
      </form>
                <?php

              }
              else{

              }
              
              
              
            }

            ?>
      
    </ul>
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