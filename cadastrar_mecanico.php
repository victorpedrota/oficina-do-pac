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
        
  $system_control = $_SESSION["system_control"];   
  $cod_login = $_SESSION['cod_login'];
  $privilegio = $_SESSION["privilegio"];
  $cod_oficina = $_SESSION["cod_oficina"];
  if($system_control == 1 && $privilegio == 2){
    require('../connect.php');
          
 $nome = $_POST['nome'];
$telefone = $_POST['telefone'];
$rg = $_POST['rg'];
$cpf = $_POST['cpf'];
$estado = $_POST['estado'];
$cidade = $_POST['cidade'];

$login = $_POST['login'];
$senha = $_POST['senha'];
$endereco = $_POST['endereco'];
$cep = $_POST['cep'];

require("../connect.php");

$sql_pesquisa ="select * from `login` where `login` = '$login'" ;
$resultado = mysqli_query($conn,$sql_pesquisa); 
$numero = mysqli_num_rows($resultado);
$vetor_login = mysqli_fetch_array($resultado);
$sql ="select * from `mecanico` where  `rg` = $rg || `telefone` = $telefone || `cpf` = $cpf" ;
$resultado_sql = mysqli_query($conn,$sql); 
$numero_cliente = mysqli_num_rows($resultado_sql);
if($numero == 0 && $numero_cliente == 0){

    $sql_login = "INSERT INTO `login`(`login`, `senha`, `privilegio`) VALUES ('$login','$senha',1)";
    $resultado_login = mysqli_query($conn, $sql_login);
    if($resultado_login)
    {
    
        $sql_cod ="select * from `login` where `login` = '$login'" ;
        $resultado_cod = mysqli_query($conn,$sql_cod);
        $vetor_cod = mysqli_fetch_array($resultado_cod);
        $cod_login = $vetor_cod['cod_login'];
        $sql_cliente = "INSERT INTO `mecanico`(`cod_login`,`nome`,`rg`,`endereco`,`cpf`,`estado`,`cep`,`cidade`,`telefone`,`cod_oficina`) VALUES ($cod_login,'$nome',$rg,'$endereco',$cpf,'$estado',$cep,'$cidade',$telefone,$cod_oficina)";
        $insere = mysqli_query($conn,$sql_cliente);

         ?>
  <script>
    alert("Cadastrado com sucesso!");
    document.location.href="perfil_oficina.php";
  </script>
  <?php  
    }
    else
    {
         ?>
  <script>
    alert("Erro!");
    document.location.href="perfil_oficina.php";
  </script>
  <?php 
    }

} 

else{
   ?>
              
<?php 
}
    
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