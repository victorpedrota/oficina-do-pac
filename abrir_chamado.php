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

    $oficina = $_POST['n_oficina'];
    $tipo = $_POST['tipo'];
    $veiculo = $_POST['veiculo'];
    
    $protocolo = rand() . "\n";

    $sql = "SELECT * FROM `servico` WHERE `protocolo` = $protocolo";
    $protocol = mysqli_query($conn,$sql); 
    $vetor_pro = mysqli_fetch_array($protocol);
    $numero_protocolos= mysqli_num_rows($protocol);

    while ($vetor_pro['protocolo'] == $protocolo) {
      $protocolo = mt_rand() . "\n";
    }

    $sql_cliente = "INSERT INTO `servico`(`cod_cliente`, `tipo_servico`, `cod_veiculo`,`cod_oficina`,`protocolo`) VALUES ($cod_cliente,'$tipo',$veiculo,$oficina,$protocolo)";
    $insere = mysqli_query($conn,$sql_cliente);

    
    $sql = "SELECT * FROM `servico` WHERE `protocolo` = $protocolo";
    $c_servico = mysqli_query($conn,$sql);
    $vetor_servico = mysqli_fetch_array($c_servico);
    $cod_servico = $vetor_servico['cod_servico'];
    
    $sql = "INSERT INTO `status`(`status`, `cod_servico`) VALUES (0,$cod_servico)";
    $insere = mysqli_query($conn,$sql);
    ?>
    <script>
      alert("Chamado feito com sucesso, aguardando mecanico aceitar pedido");
      document.location.href="login.php";
    </script>
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