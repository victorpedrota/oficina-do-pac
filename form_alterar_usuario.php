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
    $sql ="SELECT * FROM `login` WHERE `cod_login` = $cod_login" ;
    $resul = mysqli_query($conn,$sql); 
    $vetor_login = mysqli_fetch_array($resul);


    ?>

    <!DOCTYPE html>
    <html>
    <head>
      <title>Oficina Pro</title>
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
      <link rel="stylesheet" type="text/css" href="css/sidenav.css">
      <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">


    </head>
    <body>
     <?php
     require("navbar_logout.html");
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
               
        <div class="container">
           <div id="wrapper">

        <div id="sidebar-wrapper">
            <ul class="sidebar-nav">
                <li class="sidebar-brand">
                    <a href="#">
                      Configurações de Conta
                    </a>
                </li>
                <li>
                    <a href="#">Alterar Informações</a>
                </li>
                <li>
                    <a href="#">Alterar Senha</a>
                </li>
                
            </ul>
        </div>
        
        
          <center><h5 style="margin-top: "><?php echo $vetor['nome'] . ',' . $vetor['sobrenome']; ?></h5></center>
          <hr>
            <form method="POST" action="alterar_cliente.php">


            <label for="inputPassword4">Telefone</label>
            <input  value="<?php echo $vetor['telefone']; ?>"  name="telefone" id="telefone" type="text" class="form-control" required>


            <div class="form-row">
              <div class="col-md-6">
                <label for="inputAddress">Celular:</label>
                <input  value="<?php echo $vetor['celular']; ?>" id="celular"  name="celular" type="text" class="form-control" required>
              </div>
              <div class="col-md-6">
                <label for="inputAddress2">CEP:</label>
                <input  value="<?php echo $vetor['cep']; ?>" id="cep"  onblur="pesquisacep(this.value);" name="cep" type="text" class="form-control" required>
              </div></div>
              <div class="form-row">
                <div class="form-group col-md-6">
                  <label for="inputCity">Estado:</label>
                  <select name="uf" id="uf" type="text" class="form-control" required>
                    <option value="AC">Acre</option>
                    <option value="AL">Alagoas</option>
                    <option value="AP">Amapá</option>
                    <option value="AM">Amazonas</option>
                    <option value="BA">Bahia</option>
                    <option value="CE">Ceará</option>
                    <option value="DF">Distrito Federal</option>
                    <option value="ES">Espírito Santo</option>
                    <option value="GO">Goiás</option>
                    <option value="MA">Maranhão</option>
                    <option value="MT">Mato Grosso</option>
                    <option value="MS">Mato Grosso do Sul</option>
                    <option value="MG">Minas Gerais</option>
                    <option value="PA">Pará</option>
                    <option value="PB">Paraíba</option>
                    <option value="PR">Paraná</option>
                    <option value="PE">Pernambuco</option>
                    <option value="PI">Piauí</option>
                    <option value="RJ">Rio de Janeiro</option>
                    <option value="RN">Rio Grande do Norte</option>
                    <option value="RS">Rio Grande do Sul</option>
                    <option value="RO">Rondônia</option>
                    <option value="RR">Roraima</option>
                    <option value="SC">Santa Catarina</option>
                    <option value="SP">São Paulo</option>
                    <option value="SE">Sergipe</option>
                    <option value="TO">Tocantins</option>
                  </select>
                </div>
                <div class="form-group col-md-4">
                  <label for="inputState">Cidade:</label>
                  <input  value="<?php echo $vetor['cidade']; ?>" id="cidade" name="cidade" type="text" class="form-control" required>
                </div>
                <div class="form-group col-md-2">
                  <label for="inputZip">Bairro</label>
                  <input  value="<?php echo $vetor['bairro']; ?>" id="bairro" name="bairro" type="text" class="form-control" required>
                </div>
              </div>
              <div class="form-row">
                <div class="form-group col-md-6">
                  <label for="inputEmail4">Rua:</label>
                  <input  value="<?php echo $vetor['rua']; ?>" id="rua" name="rua" type="text" class="form-control">
                </div>
                <div class="form-group col-md-4">
                  <label for="inputPassword4">Numero:</label>
                  <input  value="<?php echo $vetor['numero']; ?>" id="numero" name="numero" type="text" class="form-control">
                </div>
                <div class="form-group col-md-2">
                  <label for="inputPassword4">Comeplemento:</label>
                  <input  value="<?php echo $vetor['complemento']; ?>" type="text" name="complemento" class="form-control">
                </div>

              </div>
              <center><a href="perfil_cliente.php" class="btn btn-primary">Voltar</a> <input type="submit" class="btn btn-primary" name=""></center>

          

        </form>
        </div>
        </div>


    </div>
          
        <script type="text/javascript" src="js/jquery.mask.min.js"></script>
        <script type="text/javascript">
          $(document).ready(function(){

            $('#celular').mask('(00) 0000-00009');
            $('#celular').blur(function(event) {
                if($(this).val().length == 15){ // Celular com 9 dígitos + 2 dígitos DDD e 4 da máscara
                 $('#celular').mask('(00) 00000-0009');
               } else {
                $('#celular').mask('(00) 0000-00009');
              }
            });
            $('#telefone').mask('(00) 0000-00009');
            $('#telefone').blur(function(event) {
                if($(this).val().length == 15){ // Celular com 9 dígitos + 2 dígitos DDD e 4 da máscara
                 $('#telefone').mask('(00) 00000-0009');
               } else {
                $('#telefone').mask('(00) 0000-00009');
              }
            });
            $('#cep').mask('00.000-000');
          });
          $('#numero').keyup(function() {
            $(this).val(this.value.replace(/\D/g, ''));
          });
        </script>
      </body>
      </html>
      <?php
    }
    else
    {

      session_destroy();


      ?>
      <script>
        alert("Acesso Inválido!");
        document.location.href="login.php";
      </script>
      <?php           
    }
  }
  ?>