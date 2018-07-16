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

  if($system_control == 1 && $privilegio == 0){
    require('connect.php');

    $sql_pesquisa ="SELECT * FROM `cliente` WHERE `cod_login` = $cod_login" ;
    $resultado = mysqli_query($conn,$sql_pesquisa); 
    $vetor = mysqli_fetch_array($resultado);
    
    function soNumero($str) {
    return preg_replace("/[^0-9]/", "", $str);
}

if (isset ($_POST['senha'])) {
  $senha = $_POST['senha_nova'];
  $oficina ="UPDATE `login` SET `senha`='$senha' WHERE `cod_login` = $cod_login";
  $oficinas_query = mysqli_query($conn,$oficina); 
  ?>
    <script>
      alert("Senha alterada com sucesso!");
      document.location.href="form_alterar_usuario.php";
    </script>
    <?php  
  
}else{
  
    
    
    $telefone = soNumero($_POST['telefone']);
  
    $cep =  soNumero($_POST['cep']);
    $estado = $_POST['uf'];
    $cidade = $_POST['cidade'];
    $bairro = $_POST['bairro'];
    $rua = $_POST['rua'];
    $numero = $_POST['numero'];
    $complemento = $_POST['complemento'];
    $celular =  soNumero($_POST['celular']);
    


    
        $sql_pesquisa ="UPDATE `cliente` SET `rua`='$rua',`estado`='$estado',`cep`=$cep,`cidade`='$cidade',`telefone`='$telefone',`bairro`='$bairro',`complemento`= '$complemento',`numero`='$numero',`celular`='$celular' WHERE `cod_login` = $cod_login" ;

        $resultado = mysqli_query($conn,$sql_pesquisa);
        
       

    ?>
    <script>
      alert("Informações atualizadas!");
      document.location.href="form_alterar_usuario.php";
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
      document.location.href="login.php";
    </script>
    <?php           
  }
}
?>