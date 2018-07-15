<?php
    //Verificando se ja existe uma sessão aberta

    //Mantendo a sessão/cria uma sessao
session_start();

if(!isset($_SESSION["system_control"]))
{
  ?>
  <!DOCTYPE html>
  <html>
  <title>Oficina Pro</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
  <link href="css/form.css" rel="stylesheet">
  <body>
    <?php

    require('navbar2.html');
    ?> <script type="text/javascript" >

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

      <script>
        function formatar(mascara, documento){
          var i = documento.value.length;
          var saida = mascara.substring(0,1);
          var texto = mascara.substring(i)

          if (texto.substring(0,1) != saida){
            documento.value += texto.substring(0,1);
          }

        }</script>
        <script type="text/javascript" src="js/jquery.mask.min.js"></script>
        <div style="margin-top: -50px;" class="container">
          <form id="regForm" method="POST" action="cadastrar_cliente.php">
            
            <br>

            <div class="tab" value="0">
              <center><div><h3>Vamos fazer isso na ordem certa. Crie um login e senha</h3> </div></center>


              <h5 style="display:  inline-block;">Login:*</h5><p style="display:  inline-block;">(mínimo 6 caracters)</p> 
              <input class="form-control"  id="login" name="login"  minlength="6" type="text" required>
              <br>

              <h5 style="display:  inline-block;">Senha:*</h5><p style="display:  inline-block;">(mínimo 6 caracters)</p>
              <input class="form-control"  id="senha" name="senha"  minlength="8" type="password" required>
              <br>
              <h5>Confirmar Senha:*</h5>
              <input class="form-control" id="c_senha" name="senha"  minlength="8" type="password" required>

            </div>

            <div class="tab" value="2">
             <center><h3>Quem é você?, é necessário que você preencha os sguintes campos</h3></center>
             <div class="form-row">
              <div class="form-group col-md-6">
                <label for="inputEmail4">Nome:*</label>
                <input class="form-control" id="ex3" name="nome" type="text" pattern="[a-z\s]+$"   required>
              </div>
              <div class="form-group col-md-6">
                <label for="inputPassword4">Sobrenome:*</label>
                <input class="form-control" id="ex3" name="sobrenome" pattern="[a-z\s]+$"  type="text" required>
              </div>
            </div>
            <div class="form-row">
              <div class="form-group col-md-6">
                <label for="inputAddress">CPF:*</label>
                <input class="form-control" id="cpf" type="text" name="cpf" pattern="[0-9]{3}.[0-9]{3}.[0-9]{3}-[0-9]{2}" placeholder="XXX.XXX.XXX-XX"   required >
              </div>
              <div class="form-group col-md-6">
                <label for="inputAddress2">RG:*</label>
                <input class="form-control" type="text" id="rg" name="rg" maxlength="12" pattern="[0-9]{2}.[0-9]{3}.[0-9]{3}-[0-9]" placeholder="XX.XXX.XXX-X" OnKeyPress="formatar('##.###.###-#', this)" minlength="12" required >
              </div>
            </div>
            <div class="form-row">
              <div class="form-group col-md-6">
                <label for="inputCity">Data nascimento:*</label>
                <input class="form-control" type="text" name="data" id="data" pattern="[0-9]{2}/[0-9]{2}/[0-9]{4}" placeholder="00/00/0000"  required>
              </div>
              <div class="form-group col-md-6">
                <label>Email:*</label>
                <input class="form-control" type="text" required>
              </div>


            </div>

          </div>

          <div class="tab">
            <center><h3>Onde você está?, precisamos de sua localização para oferecer um serviço melhor</h3></center>
            <div class="form-row">
              <div class="form-group col-md-2">
                <label for="inputZip">CEP:*</label>
                <input class="form-control" onkeyup="numeros( this );" id="cep"  onblur="pesquisacep(this.value);" pattern="[0-9]{2}.[0-9]{3}.[0-9]{3}" placeholder="XX.XXX.XXX" minlength="10" name="cep" type="text" maxlength="10" required>
              </div>
              <div class="form-group col-md-4">
                <label for="inputState">Estado:*</label>
                <input class="form-control" id="uf" name="estado" type="text"> 
              </div>

              <div class="form-group col-md-6">
                <label for="inputCity">Cidade:*</label>
                <input type="text" id="cidade" name="cidade" class="form-control">
              </div>


            </div>
            <div class="form-row">
              <div class="form-group col-md-6">
                <label for="inputEmail4">Bairro:*</label>
                <input class="form-control" id="bairro" name="bairro" type="text" pattern="[a-z\s]+$"   required>
              </div>
              <div class="form-group col-md-6">
                <label for="inputPassword4">Rua:*</label>
                <input class="form-control" id="rua" name="rua" pattern="[a-z\s]+$"  type="text" required>
              </div>
            </div>

            <div class="form-row">
              <div class="form-group col-md-6">
                <label for="inputEmail4">Número:*</label>
                <input class="form-control" onkeyup="numeros( this );" id="numero" name="numero" type="text" pattern="[a-z\s]+$"   required>
              </div>
              <div class="form-group col-md-6">
                <label for="inputPassword4">Complemento:*</label>
                <input class="form-control" id="complemento" name="complemento" pattern="[a-z\s]+$"  type="text" required>
              </div>
            </div>
          </div>



          <div class="tab">
            <center><h3>Precisamos de seu contato caso ocorra algum problema, por favor insira seu contato</h3></center>
            <div class="form-row">
              <div class="form-group col-md-6">
                <label for="inputEmail4">Telefone:*</label>
                <input id="telefone" class="form-control" type="text" name="telefone" maxlength="12" pattern="[0-9]{2} [0-9]{4}-[0-9]{4}" placeholder="00 0000-0000" OnKeyPress="formatar('## ####-####', this)" minlength="12">
              </div>
              <div class="form-group col-md-6">
                <label for="inputPassword4">Celular:*</label>
                <input class="form-control" type="text" name="celular" maxlength="12" id="celular" pattern="[0-9]{2} [0-9]{4}-[0-9]{4}" placeholder="00 0000-0000" OnKeyPress="formatar('## ####-####', this)" minlength="12">
              </div>
            </div>
          </div>





          <div style="position: static;">
            <br><center>
              <div>
                <button type="button" class="btn btn-secondary" id="prevBtn" onclick="nextPrev(-1)">Voltar</button>
                <button type="button" class="btn btn-danger" id="nextBtn" onclick="nextPrev(1)">Avançar</button>
              </div></center>
            </div>
            <!-- Circles which indicates the steps of the form: -->
            <div style="text-align:center;margin-top:40px;">
              <span class="step"></span>
              <span class="step"></span>
              <span class="step"></span>
              <span class="step"></span>
            </div>
          </form>
        </div>
        <script type="text/javascript">
          function numeros( campo )
          {
            if ( isNaN( campo.value ) )
              campo.value = campo.value.substr( 0 , campo.value.length - 1 );
          }
        </script>

        <script>
var currentTab = 0; // Current tab is set to be the first tab (0)
showTab(currentTab); // Display the crurrent tab
var z, x = document.getElementsByClassName("tab");
z =0;

function showTab(n) {
  // This function will display the specified tab of the form...
  var x = document.getElementsByClassName("tab");
  x[n].style.display = "block";
  //... and fix the Previous/Next buttons:
  if (n == 0) {
    document.getElementById("prevBtn").style.display = "none";
  } else {
    document.getElementById("prevBtn").style.display = "inline";
  }
  if (n == (x.length - 1)) {
    document.getElementById("nextBtn").innerHTML = "Enviar";
  } else {
    document.getElementById("nextBtn").innerHTML = "Avançar";
  }
  //... and run a function that will display the correct step indicator:
  fixStepIndicator(n)
}

function nextPrev(n) {
  // This function will figure out which tab to display
  
  // Exit the function if any field in the current tab is invalid:
  if (n == 1 && !validateForm()) return false;
  // Hide the current tab:
  x[currentTab].style.display = "none";
  // Increase or decrease the current tab by 1:
  currentTab = currentTab + n;
  
  // if you have reached the end of the form...
  if (currentTab >= x.length) {
    // ... the form gets submitted:
    document.getElementById("regForm").submit();
    return false;
  }
  // Otherwise, display the correct tab:
  showTab(currentTab);
  z = z+n;
  
  
}

function validateForm() {

  var a,x,y,i,valid = true;
  var login, senha;
  var cpfn,rgn;
  
  
  login = document.getElementById("login");
  senha = document.getElementById("senha");
  cpf = document.getElementById("cpf");
  c_senha = document.getElementById("c_senha");
  x = document.getElementsByClassName("tab");
  y = x[currentTab].getElementsByTagName("input");
  a = x[2].getElementsByTagName("input");
  cpfn = cpf.value.replace(/[^0-9]/g,'');
  rg = document.getElementById("rg");
  complemento = document.getElementById("complemento");
  telefone = document.getElementById("telefone");
  celular = document.getElementById("celular");
  rgn = rg.value.replace(/[^0-9]/g,'');

  if (z==2) {for (i = 0; i < (y.length-1); i++) {
   
    
    if (y[i].value == "") {

      y[i].className += " invalid";
      
      valid = false;
      
    } 

  }}
  else{for (i = 0; i < y.length; i++) {
   
    
    if (y[i].value == "") {

      y[i].className += " invalid";
      
      valid = false;
      
    } else{}

  }
  
}

if (valid) {
  document.getElementsByClassName("step")[currentTab].className += " finish";

}
if (login.value.length<6) {login.className += " invalid"; }
else if(senha.value.length<6){senha.className += " invalid";}
else if (senha.value.length != c_senha.value.length) {senha.className += " invalid";c_senha.className += " invalid";}
else if(z==1 && TestaCPF(cpf.value.replace(/[^0-9]/g,'')) == false) {cpf.className += " invalid";}
else if (z==1 && rgn.length != 9  ){rg.className += " invalid";}
else if (z==1 && rgn == "000000000" || rgn == "111111111" || rgn == "222222222" || rgn == "333333333" || rgn == "444444444" || rgn == "555555555" || rgn == "666666666" || rgn == "777777777" || rgn == "888888888" || rgn == "99999999" ){rg.className += " invalid";}
else if ((telefone.value.length != 13 || telefone.value.length != 12) && z ==3 ) {telefone.className += " invalid"}
else if ((celular.value.length != 13 || telefone.value.length != 12) && z ==3 ) {telefone.className += " invalid"}
else{

  return valid;
  
}

}

function fixStepIndicator(n) {
  // This function removes the "active" class of all steps...
  var i, x = document.getElementsByClassName("step");
  for (i = 0; i < x.length; i++) {
    x[i].className = x[i].className.replace(" active", "");
  }
  //... and adds the "active" class on the current step:
  x[n].className += " active";
}
function TestaCPF(strCPF) {
  var Soma;
  var Resto;
  Soma = 0;
  if (strCPF == "00000000000") return false;
  
  for (i=1; i<=9; i++) Soma = Soma + parseInt(strCPF.substring(i-1, i)) * (11 - i);
    Resto = (Soma * 10) % 11;
  
  if ((Resto == 10) || (Resto == 11))  Resto = 0;
  if (Resto != parseInt(strCPF.substring(9, 10)) ) return false;
  
  Soma = 0;
  for (i = 1; i <= 10; i++) Soma = Soma + parseInt(strCPF.substring(i-1, i)) * (12 - i);
    Resto = (Soma * 10) % 11;
  
  if ((Resto == 10) || (Resto == 11))  Resto = 0;
  if (Resto != parseInt(strCPF.substring(10, 11) ) ) return false;
  return true;
}

</script>
<script type="text/javascript" src="jquery.mask.min.js"></script>
<script type="text/javascript">
  
  $('#data').mask('00/00/0000');
  $('#cpf').mask('000.000.000-00', {reverse: true});
</script>
</body>
</html>


<?php
}
else if($_SESSION["system_control"] == 1)
{

  if($_SESSION["privilegio"] == 0){
    ?>
    <script language='JavaScript'>
      document.location.href="perfil_cliente.php";
    </script>
    <?php
  }
  else if ($_SESSION["privilegio"] == 1) {
    ?>
    <script language='JavaScript'>
      document.location.href="perfil_cliente.php";
    </script>
    <?php
  }
  else if ($_SESSION['privilegio'] == 2) {
    ?>
    <script language='JavaScript'>
      document.location.href="perfil_oficina.php";
    </script>
    <?php
  }
  else{
    echo "erro";
  }

}
?>