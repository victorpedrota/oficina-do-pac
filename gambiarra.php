<?php
    //Mantendo a sessão/cria uma sessao
session_start();

if(!isset($_SESSION["system_control"]))
{
  ?>
  <script>
    alert("Acesso Inválido!");
    document.location.href = "login.php";
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

    $sql_servico = "SELECT * FROM `servico` WHERE  `cod_cliente` = $cod_cliente";
    $query_servico = mysqli_query($conn, $sql_servico);
    $numero_servico = mysqli_num_rows($query_servico); 


    $_SESSION["nome"] = $vetor["nome"];
    require('connect.php');

    $cod_oficina = $_POST['cod_oficina'];
    $tipo = $_POST['tipo'];
    $veiculo = $_POST['veiculo'];
    $servico = $_POST['servico'];
    $problema = $_POST['problema'];


    $protocolo = rand() . "\n";

    $sql = "SELECT * FROM `servico` WHERE `protocolo` = $protocolo";
    $protocol = mysqli_query($conn,$sql); 
    $vetor_pro = mysqli_fetch_array($protocol);
    $numero_protocolos= mysqli_num_rows($protocol);

    while ($vetor_pro['protocolo'] == $protocolo) {
      $protocolo = mt_rand() . "\n";
  }

  $sql_cliente = "INSERT INTO `servico`(`cod_cliente`, `tipo_servico`, `cod_veiculo`,`cod_oficina`,`protocolo`,`problema`,`servico_desejado`) VALUES ($cod_cliente,'$tipo',$veiculo,$cod_oficina,$protocolo,'$problema','$servico')";
  $insere = mysqli_query($conn,$sql_cliente);

  
  $sql = "SELECT * FROM `servico` WHERE `protocolo` = $protocolo";
  $c_servico = mysqli_query($conn,$sql);
  $vetor_servico = mysqli_fetch_array($c_servico);
  $cod_servico = $vetor_servico['cod_servico'];
  
  $sql = "INSERT INTO `status`(`status`, `cod_servico`) VALUES (0,$cod_servico)";
  $insere = mysqli_query($conn,$sql);
  ?>
  <script>
    alert("Concluido");
    document.location.href = "login.php";
</script>
<?php





}
else
{

  session_destroy();


  ?>
  <script>
    alert("Acesso Inválido!");
    document.location.href = "login.php";
</script>
<?php
}
}
?>