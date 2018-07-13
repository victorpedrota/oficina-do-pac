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

    $sql_pesquisa ="SELECT * FROM `cliente` WHERE `cod_login` = $cod_login" ;
    $resultado = mysqli_query($conn,$sql_pesquisa); 
    $vetor = mysqli_fetch_array($resultado);
    

    $login = $_POST['login'];
    $c_senha = $_POST['c_senha'];
    $senha = $_POST['senha'];
    $telefone = $_POST['telefone'];
    $cep = $_POST['cep'];
    $estado = $_POST['uf'];
    $cidade = $_POST['cidade'];
    $bairro = $_POST['bairro'];
    $rua = $_POST['rua'];
    $numero = $_POST['numero'];
    $complemento = $_POST['complemento'];
    $celular = $_POST['celular'];
    
    if ($senha != $c_senha) {
      ?>
      <script>
        alert("Erro");
    document.location.href="form_alterar_usuario.php";
       
      </script>
      <?php 
    }

    else
      { 
        $sql_pesquisa ="UPDATE `cliente` SET `rua`='$rua',`estado`='$estado',`cep`=$cep,`cidade`='$cidade',`telefone`=$telefone,`bairro`='$bairro',`complemento`= '$complemento',`numero`='$numero',`celular`=$celular WHERE `cod_login` = $cod_login" ;

        $resultado = mysqli_query($conn,$sql_pesquisa);
        $sql="UPDATE `login` SET `login`='$login',`senha`='$senha' WHERE `cod_login` = $cod_login";
        $atualizar = mysqli_query($conn,$sql);

  }
    ?>
  <script>
    alert("Informações Cadastradas");
    document.location.href="form_alterar_usuario.php";
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