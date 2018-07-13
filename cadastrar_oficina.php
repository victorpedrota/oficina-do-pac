<!DOCTYPE html>
<html lang="en">
<head>
  <title>Cadastrar Usuário</title>
  <meta charset="utf-8">
  <meta http-equiv="content-type" content="text/html; charset=utf-8"/>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

  <script type="text/javascript"> 

    function formatar(mascara, documento){
      var i = documento.value.length;
      var saida = mascara.substring(0,1);
      var texto = mascara.substring(i)

      if (texto.substring(0,1) != saida){
        documento.value += texto.substring(0,1);
      }

    }

  </script>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

</head>
<body>
  <?php

    require('navbar2.html');
    ?>
  <script type="text/javascript" >

  function limpa_formulário_cep() {
            //Limpa valores do formulário de cep.
            document.getElementById('rua').value=("");
            document.getElementById('bairro').value=("");
            document.getElementById('cidade').value=("");
            document.getElementById('uf').value=("");
            
          }

          function meu_callback(conteudo) {
            if (!("erro" in conteudo)) {
            //Atualiza os campos com os valores.
            document.getElementById('rua').value=(conteudo.logradouro);
            document.getElementById('bairro').value=(conteudo.bairro);
            document.getElementById('cidade').value=(conteudo.localidade);
            document.getElementById('uf').value=(conteudo.uf);
            
        } //end if.
        else {
            //CEP não Encontrado.
            limpa_formulário_cep();
            alert("CEP não encontrado.");
          }
        }
        
        function pesquisacep(valor) {

        //Nova variável "cep" somente com dígitos.
        var cep = valor.replace(/\D/g, '');

        //Verifica se campo cep possui valor informado.
        if (cep != "") {

            //Expressão regular para validar o CEP.
            var validacep = /^[0-9]{8}$/;

            //Valida o formato do CEP.
            if(validacep.test(cep)) {

                //Preenche os campos com "..." enquanto consulta webservice.
                document.getElementById('rua').value="...";
                document.getElementById('bairro').value="...";
                document.getElementById('cidade').value="...";
                document.getElementById('uf').value="...";
                

                //Cria um elemento javascript.
                var script = document.createElement('script');

                //Sincroniza com o callback.
                script.src = 'https://viacep.com.br/ws/'+ cep + '/json/?callback=meu_callback';

                //Insere script no documento e carrega o conteúdo.
                document.body.appendChild(script);

            } //end if.
            else {
                //cep é inválido.
                limpa_formulário_cep();
                alert("Formato de CEP inválido.");
              }
        } //end if.
        else {
            //cep sem valor, limpa formulário.
            limpa_formulário_cep();
          }
        };

      </script>
  <?php  require('navbar2.html'); ?>
  <div class="container" style="margin-top: 80px;">
    <form method="POST" action="">
      <h3 >Formulário Cadastrar Oficina</h3>

      <div class="form-row">
        <div class="col">
          <label for="ex3">Login:*</label><br>
          <input class="form-control" id="ex3" name="login"  minlength="6" type="text" required>
        </div>
        <div class="col">
         <label for="ex3">Senha:*</label><br>
         <input class="form-control" id="ex3" name="senha"  minlength="8" type="password" required>
       </div>
     </div>
     <div class="form-row">
      <div class="col">
        <label for="ex3">Nome oficina:*</label><br>
        <input class="form-control" id="ex3" name="nome" type="text" pattern="[a-z\s]+$"   required>
      </div>
      <div class="col">
       <label for="ex3">Telefone:</label><br>
       <input class="form-control" type="text" name="telefone" maxlength="12" pattern="[0-9]{2} [0-9]{4}-[0-9]{4}" placeholder="00 0000-0000" OnKeyPress="formatar('## ####-####', this)" minlength="12">
     </div>
   </div>
   <div class="form-row">
    <div class="col">
     <label for="ex3">Celular:</label><br>
     <input class="form-control" type="text" name="celular" maxlength="12" pattern="[0-9]{2} [0-9]{4}-[0-9]{4}" placeholder="00 0000-0000" OnKeyPress="formatar('## ####-####', this)" minlength="12">
   </div>
   <div class="col">
     <label for="ex3">CNPJ:*</label><br>
     <input class="form-control" type="text" name="cnpj" maxlength="18" pattern="[0-9]{2}.[0-9]{3}.[0-9]{3}/[0-9]{4}-[0-9]{2}" placeholder="XX.XXX.XXX/XXX-XX" OnKeyPress="formatar('##.###.###/####-##', this)" minlength="18" required >
   </div>
 </div>
 <div class="form-row">
  <div class="col">
   <label for="ex3">CEP:*</label><br>
   <input name="cep" class="form-control" type="text" id="cep" value="" size="10" maxlength="9" onblur="pesquisacep(this.value);">
 </div>
 <div class="col">
  <label for="ex3">Estado:*</label><br>
   <input type="text" class="form-control" name="uf" id="uf">
</div>
</div>
<div class="form-row">
  <div class="col">
    <label for="ex3">Cidade:</label><br>
    <input type="text" name="cidade" class="form-control" id="cidade">
  </div>
  <div class="col">
    <label for="ex3">Bairro:*</label><br>
    <input class="form-control" id="bairro" name="bairro" type="text" required>
  </div>
</div>
<div class="form-row">
  <div class="col">
    <label for="ex3">Rua:</label><br>
    <input class="form-control" id="rua" name="endereco" type="text" required>
  </div>
  <div class="col">
    <label for="ex3">Numero:*</label><br>
    <input class="form-control" id="numero" name="numero" type="text" pattern="[0-9]+$" required>
  </div>
</div>
<label for="ex3">Complemento:</label><br>
<input class="form-control" id="ex3" name="complemento" type="text">
<br>
<center><button type="submit" class="btn btn-primary"> Enviar</button></center>

</form>
</div>

    </body>
    </html>