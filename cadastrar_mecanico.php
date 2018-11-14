<?php
    //Mantendo a sessão/cria uma sessao
session_start();

if(!isset($_SESSION["system_control"]))
{
  require('erro.php');
}
else{
        //Sessao já criada
        //Recuperando as variaveis da sessão
function soNumero($str) {
    return preg_replace("/[^0-9]/", "", $str);
}

 $system_control = $_SESSION["system_control"];   
 $cod_login = $_SESSION['cod_login'];
 $privilegio = $_SESSION["privilegio"];
 $cod_oficina = $_SESSION["cod_oficina"];
 if($system_control == 1 && $privilegio == 2){
  require('connect.php');

  $nome = $_POST['nome'];
  $sobrenome = $_POST['sobrenome'];
  $telefonen = $_POST['telefone'];
  $celularn = $_POST['celular'];
  $rgn = $_POST['rg'];
  $cpfn = $_POST['cpf'];
  $estado = $_POST['uf'];
  $cidade = $_POST['cidade'];
  $data = $_POST['data'];
  $login = $_POST['login'];
  $senha = $_POST['senha'];
  $rua = $_POST['rua'];
  $cepn = $_POST['cep'];
  $complemento = $_POST['complemento'];
  $bairro = $_POST['bairro'];
  $numeron = $_POST['numero'];


$cpf = soNumero($cpfn);
$rg = soNumero($rgn);
$celular = soNumero($celularn);
$telefone = soNumero($telefonen);
$cep = soNumero($cepn);
  $sql_pesquisa ="select * from `login` where `login` = '$login'" ;
  $resultado = mysqli_query($conn,$sql_pesquisa); 
  $numero = mysqli_num_rows($resultado);
  $vetor_login = mysqli_fetch_array($resultado);
  $sql ="select * from `mecanico` where  `rg` = $rg || `cpf` = $cpf" ;
  $resultado_sql = mysqli_query($conn,$sql); 
  $numero_cliente = mysqli_num_rows($resultado_sql);
  if ($numero != 0) { 
    echo 1;
  }
  else if ($numero_cliente !=0) {
    echo 2;
  }
  if($numero == 0 && $numero_cliente == 0){

    $sql_login = "INSERT INTO `login`(`login`, `senha`, `privilegio`) VALUES ('$login','$senha',1)";
    $resultado_login = mysqli_query($conn, $sql_login);


    $sql_cod ="select * from `login` where `login` = '$login'" ;
    $resultado_cod = mysqli_query($conn,$sql_cod);
    $vetor_cod = mysqli_fetch_array($resultado_cod);
    $cod_login = $vetor_cod['cod_login'];
    $sql_cliente = "INSERT INTO `mecanico`(`cod_login`, `cod_oficina`, `nome`, `rg`, `cpf`, `telefone`, `cep`, `estado`, `cidade`, `rua`, `sobrenome`, `bairro`, `complemento`, `celular`, `numero`) VALUES ($cod_login,$cod_oficina,'$nome','$rg','$cpf','$telefone','$cep','$estado','$cidade','$rua','$sobrenome','$bairro','$complemento','$celular','$numeron')";
    $insere = mysqli_query($conn,$sql_cliente);
    echo 0;
    }
  }
    else
    {

      session_destroy();


     require('erro.php');
    }
  }
  ?>