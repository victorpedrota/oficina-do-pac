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
    <html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<link rel="stylesheet" href="scss/main.css">
    

    <title>Sucesso</title>
  </head>
  <body>
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <div class="modal fade" id="exampleModalLong" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Foto alterada</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        Foto alterada com sucesso!
      </div>
      <div class="modal-footer">
        
        <a  href="form_alterar_mecanico.php" class="btn btn-primary">Ok</a>
      </div>
    </div>
  </div>
</div>
<script>
  $(document).ready(function(){
    $('#exampleModalLong').modal('show')
    $('#exampleModalLong').on('hidden.bs.modal', function (e) {
 window.location.href = 'form_alterar_mecanico.php';
})

  })
</script>
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    
  </body>
</html>
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
  require('erro.php');           
}
}
?>