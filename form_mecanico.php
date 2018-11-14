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

  if($system_control == 1 && $privilegio == 2){
    require('connect.php');




    ?>
    <!DOCTYPE html>
    <html lang="en">
    <head>
      <title>Cadastrar Usuário</title>
      <meta charset="utf-8">
      <meta http-equiv="content-type" content="text/html; charset=utf-8"/>
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

      <style type="text/css">

      table{

        width: 600px;
      }
      td{
        width: 275px; 
      }

    </style>

    <meta name="viewport" content="width=device-width, initial-scale=1">
  </head>
  <body>
    <?php require('navbar_logout.html');?>
    <div class="container" style="margin-top: 60px">
     <h3 >Formulário Cadastrar Usuário</h3>
     <label for="ex3">*Itens obrigatórios</label><br> 
     <form action="cadastrar_mecanico.php" method="POST">
       <div class="row">
        <div class="col ">
          <label for="ex3">Login:*</label><br>

          <input class="form-control"  name="login"  minlength="6" type="text" required>
        </div>
        <div class="col">
          <label for="ex3">Senha:*</label><br>

          <input class="form-control"  name="senha"  minlength="8" type="password" required>
        </div>

      </div>
      <div class="row">
        <div class="col ">
          <label for="ex3">Primeiro nome:*</label><br>

          <input class="form-control" id="ex3" name="nome" type="text" pattern="[a-z\s]+$"   required>
        </div>
        <div class="col">
          <label for="ex3">Sobrenome:*</label><br>
          <input class="form-control" id="ex3" name="sobrenome" pattern="[a-z\s]+$"  type="text" required></td>
        </div>

      </div>
      <div class="row">
        <div class="col ">
         <label for="ex3">Data de nascimento:*</label><br>
         <input class="form-control" type="date" name="data" maxlength="10" pattern="[0-9]{2}/[0-9]{2}/[0-9]{4}" placeholder="00/00/0000" OnKeyPress="formatar('##/##/####', this)" minlength="10" required>
       </div>
       <div class="col">
        <label for="ex3">Telefone:</label><br>
        <input class="form-control" type="text" name="telefone" maxlength="12" pattern="[0-9]{2} [0-9]{4}-[0-9]{4}" placeholder="00 0000-0000" OnKeyPress="formatar('## ####-####', this)" minlength="12">
      </div>
      <div class="col">
        <label for="ex3">Celular:</label><br>
        <input class="form-control" type="text" name="celular" maxlength="12" pattern="[0-9]{2} [0-9]{4}-[0-9]{4}" placeholder="00 0000-0000" OnKeyPress="formatar('## ####-####', this)" minlength="12">
      </div>

    </div>
    <div class="row">
      <div class="col ">
       <label for="ex3">RG:*</label><br>
       <input class="form-control" type="text" name="rg" maxlength="12" pattern="[0-9]{2}.[0-9]{3}.[0-9]{3}-[0-9]" placeholder="XX.XXX.XXX-X" OnKeyPress="formatar('##.###.###-#', this)" minlength="12" required >
     </div>
     <div class="col">
      <label for="ex3">CPF:*</label><br>
      <input class="form-control" type="text" name="cpf" maxlength="14" pattern="[0-9]{3}.[0-9]{3}.[0-9]{3}-[0-9]{2}" placeholder="XXX.XXX.XXX-XX" OnKeyPress="formatar('###.###.###-##', this)" minlength="14" required >
    </div>
    <div class="col">
      <label for="ex3">Estado:*</label><br>
      <select class="form-control" id="estados" name="estado"> 
        <option value=""></option>
      </select>
    </div>

  </div>
  <div class="row">
    <div class="col ">
      <label for="ex3">Cidade:*</label><br>
      <select id="cidades" name="cidade" class="form-control">
      </select>
    </div>
    <div class="col">
      <label for="ex3">Bairro:*</label><br>
      <input class="form-control" id="ex3" name="bairro" type="text" required>
    </div>
    <div class="col">
      <label for="ex3">Rua:*</label><br>
      <input class="form-control" id="ex3" name="bairro" type="text" required>
    </div>

  </div>
  <div class="row">
    <div class="col ">
      <label for="ex3">Numero:*</label><br>
      <input class="form-control" id="ex3" name="numero" type="text" pattern="[0-9]+$" required>
    </div>
    <div class="col">
      <label for="ex3">Complemento:</label><br>
      <input class="form-control" id="ex3" name="complemento" type="text">
    </div>
    <div class="col">
      <label for="ex3">CEP:*</label><br>
      <input class="form-control" id="ex3" OnKeyPress="formatar('##.###.###', this)" pattern="[0-9]{2}.[0-9]{3}.[0-9]{3}" placeholder="XX.XXX.XXX" minlength="10" name="cep" type="text" maxlength="10" required>
    </div>

  </div>

     </div>
     <br>
     <div><center><button class="btn btn-primary" type="submit" name=""> Enviar</button></center></div>
   </form>
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