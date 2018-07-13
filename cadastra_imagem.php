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

    $sql_pesquisa ="SELECT * FROM `cliente` WHERE `cod_login` = $cod_login" ;
    $resultado = mysqli_query($conn,$sql_pesquisa); 
    $vetor = mysqli_fetch_array($resultado);
    $cod_cliente = $vetor['cod_cliente'];

    if(isset($_FILES['arquivo']['name']) && $_FILES["arquivo"]["error"] == 0)
    {

      echo "Você enviou o arquivo: <strong>" . $_FILES['arquivo']['name'] . "</strong><br />";
      echo "Este arquivo é do tipo: <strong>" . $_FILES['arquivo']['type'] . "</strong><br />";
      echo "Temporáriamente foi salvo em: <strong>" . $_FILES['arquivo']['tmp_name'] . "</strong><br />";
      echo "Seu tamanho é: <strong>" . $_FILES['arquivo']['size'] . "</strong> Bytes<br /><br />";

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
        $destino = 'imagens/' . $novoNome; 
        
    // tenta mover o arquivo para o destino
        if( @move_uploaded_file( $arquivo_tmp, $destino  ))
        {
          
         $sql_imagem = "UPDATE `cliente` SET `imagem`='$destino' WHERE `cod_cliente` = $cod_cliente";
         $insere = mysqli_query($conn,$sql_imagem);
       }
       else
        echo "Erro ao salvar o arquivo. Aparentemente você não tem permissão de escrita.<br />";
    }
    else
      echo "Você poderá enviar apenas arquivos \"*.jpg;*.jpeg;*.gif;*.png\"<br />";
  }
  else
  {
    echo "Você não enviou nenhum arquivo!";
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