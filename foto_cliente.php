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


 if($system_control == 1){
  require('connect.php');
  ?>
  <!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
  <html>
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

  </head>

  <body>
    <?php
// verifica se foi enviado um arquivo 
    if(isset($_FILES['arquivo']['name']) && $_FILES["arquivo"]["error"] == 0)
    {

      $arquivo_tmp = $_FILES['arquivo']['tmp_name'];
      $nome = $_FILES['arquivo']['name'];


  // Pega a extensao
      $extensao = strrchr($nome, '.');

  // Converte a extensao para mimusculo
      $extensao = strtolower($extensao);

  // Somente imagens, .jpg;.jpeg;.gif;.png
  // Aqui eu enfilero as extesões permitidas e separo por ';'
  // Isso server apenas para eu poder pesquisar dentro desta String
      if(strstr('.jpg;.jpeg;.gif;.png', $extensao))
      {
    // Cria um nome único para esta imagem
    // Evita que duplique as imagens no servidor.
        $novoNome = md5(microtime()) . $extensao;

    // Concatena a pasta com o nome
        $destino = 'fotos_usuario/' . $novoNome; 

    // tenta mover o arquivo para o destino
        if( @move_uploaded_file( $arquivo_tmp, $destino  ))
        {

         $sql_imagem = "UPDATE `login` SET `imagem`='$destino' WHERE `cod_login` = $cod_login";
         $insere = mysqli_query($conn,$sql_imagem);
       }
       else
        echo "Erro ao salvar o arquivo. Aparentemente você não tem permissão de escrita.<br />";
    }
    else
        
      ?>
    <script>
      alert("Enviado com sucesso!");
      document.location.href="javascript:history.go(-1)";
    </script>
    <?php 
  }
  else
  {
    ?>
    <script>
      alert("Nenhum arquivo enviado!");
      document.location.href="javascript:history.go(-1)";
    </script>
    <?php 
  }
  ?>
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