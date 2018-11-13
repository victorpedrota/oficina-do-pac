<?php  
require('connect.php');

    $oficina = $_POST['n_oficina'];
    $tipo = $_POST['tipo'];
    $veiculo = $_POST['veiculo'];
    $servico = $_POST['servico'];
    $problema = $_POST['problema'];
    $cod_cliente = $_POST['cod_cliente'];
    $myJSON = json_decode($oficina, true);
    $data =  date('h:i:s');
    $hora = date("d/m/Y");;
    foreach ( $myJSON as $cod_oficina ) {
    

    $protocolo = rand() . "\n";

    $sql = "SELECT * FROM `servico` WHERE `protocolo` = $protocolo";
    $protocol = mysqli_query($conn,$sql); 
    $vetor_pro = mysqli_fetch_array($protocol);
    $numero_protocolos= mysqli_num_rows($protocol);

    while ($vetor_pro['protocolo'] == $protocolo) {
      $protocolo = mt_rand() . "\n";
    }

    $sql_cliente = "INSERT INTO `servico`(`cod_cliente`, `tipo_servico`, `cod_veiculo`,`cod_oficina`,`protocolo`,`problema`,`servico_desejado`,`data`,`hora`) VALUES ($cod_cliente,'$tipo',$veiculo,$cod_oficina,$protocolo,'$problema','$servico',$data,$hora)";
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
    ?>