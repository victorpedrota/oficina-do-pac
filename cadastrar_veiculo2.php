<?php
    //Mantendo a sessão/cria uma sessao
session_start();

if(!isset($_SESSION["system_control"]))
{
  ?>
  <script>
    alert("Acesso Inválido!");
    document.location.href="../login.php";
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
    require('../connect.php');

    $modelo = $_POST['modeo'];
    $cor = $_POST['cor'];
    $ano = $_POST['ano'];
    $placa = $_POST['placa'];
    $chassi = $_POST['chassi'];
    $descricao = $_POST['descricao'];
    $cod_login = $_SESSION['cod_login'];
    $sql="select * from `cliente` where `cod_login` = '$cod_login'" ;
    $resultado_sql = mysqli_query($conn,$sql); 
    $vetor_login = mysqli_fetch_array($resultado_sql);
    $cod_cliente =  $vetor_login['cod_cliente']; 
    $sql_pesquisa ="select * from `veiculo` where `placa` = '$placa' || `chassi` = '$chassi' where `cod_cliente` = $cod_cliente " ;
    $resultado = mysqli_query($conn,$sql_pesquisa); 
    $numero = mysqli_num_rows($resultado);

    if ($numero == 0) {
     $sql_login = "INSERT INTO `veiculo`(`modelo`, `cor`, `ano`, `descricao`, `placa`, `chassi`, `cod_cliente`) VALUES ('$modelo','$cor','$ano','$descricao','$placa','$chassi',$cod_cliente)";
     $resultado_login = mysqli_query($conn, $sql_login);
        ?>
      <script>
        alert("Carro cadastrado com succeso!");
        document.location.href="form_veiculo.php";
      </script>
      <?php   
   }else

      ?>
      <script>
        alert("htfrm ju!");
        document.location.href="form_veiculo.php";
      </script>
      <?php   
   {
    ?>
    <script type="text/javascript">

      alert("Erro");
      document.location.href="form_veiculo.php";
    </script>

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
    document.location.href="../login.php";
  </script>
  <?php           
}
}
?>