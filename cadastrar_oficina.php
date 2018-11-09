<!DOCTYPE html>
<html>

<head>
    <title>Oficina Pro</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" type="text/css" href="scss/main.css">
    <link href="css/form.css" rel="stylesheet">
    <style type="text/css">
        ::-webkit-scrollbar-track {
            background-color: #F4F4F4;
        }

        ::-webkit-scrollbar {
            width: 6px;
            background: #F4F4F4;
        }

        ::-webkit-scrollbar-thumb {
            background: #dad7d7;
        }

        body {
            overflow-y: scroll;
        }
    </style>
</head>

<body>
    <?php  require('navbar.html'); ?>
    <div class="container" style="margin-top: 60px;">
        <form method="POST" id="form" action="cadastrar.php">
            <br>
            <h3>Formulário Cadastrar Oficina</h3>
            <center>><div id="texto"></div></center>
            <div class="form-row">
                <div class="col">
                    <label for="ex3">Login:</label>
                    <input class="form-control" name="login" id="login" minlength="6" type="text" required>
                </div>
            </div>
            <div class="form-row">
                <div class="col">
                    <label for="ex3">Senha:</label>
                    <input class="form-control" name="senha" id="senha" minlength="6" type="password" required>
                </div>
                <div class="col">
                    <label for="ex3">Confirmar Senha:</label>
                    <input class="form-control" name="c_senha" id="c_senha" minlength="6" type="password" required>
                </div>
            </div>
            <hr>
            <div class="form-row">
                <div class="col">
                    <label for="ex3">Nome oficina:</label>
                    <input class="form-control letters" id="nome" name="nome" type="text" required>
                </div>
                <div class="col">
                    <label for="ex3">Telefone:</label>


                    <input class="form-control telefone" id="telefone" type="text" name="telefone" required>

                </div>
            </div>
            <div class="form-row">
                <div class="col">
                    <label for="ex3">Celular:</label>



                    <input class="form-control telefone" type="text" id="celular" name="celular" required>

                </div>
                <div class="col">
                    <label for="ex3">CNPJ:</label>
                    <input class="form-control cnpj" type="text" id="cnpj" name="cnpj" required>
                </div>
            </div>
            <div class="form-row">
                <div class="col">
                    <label for="ex3">CEP:</label>
                    <input name="cep" class="form-control cep" type="text" id="cep" value="" onblur="pesquisacep(this.value);" required>

                </div>
                <div class="col">
                    <label for="ex3">Estado:</label>
                    <input type="text" class="form-control letters" name="uf" id="uf" required>
                </div>
                <div class="col">
                    <label for="ex3">Cidade:</label>
                    <input type="text" name="cidade" class="form-control letters" id="cidade" required>
                </div>
            </div>

            <div class="form-row">
                <div class="col">
                    <label for="ex3">Bairro:</label>
                    <input class="form-control letters" name="bairro" id="bairro" type="text" required>
                </div>
                <div class="col">
                    <label for="ex3">Rua:</label>
                    <input class="form-control" name="endereco" id="rua" type="text" required>
                </div>
                <div class="col">
                    <label for="ex3">Numero:</label>
                    <input class="form-control numero" id="numero" type="text" pattern="[0-9]+$" required>
                </div>
                <div class="col">
                    <label for="ex3">Complemento:</label>
                    <input class="form-control" id="complemento" name="complemento" type="text">
                </div>
            </div>

            <br>
            <center><a class="btn btn-default" href="form_cliente.php">Voltar</a> <button type="button" class="btn btn-primary" id="enviar"> Enviar</button></center>

        </form>
    </div>
    <script src="https://code.jquery.com/jquery-2.1.0.js"></script>
    <script type="text/javascript">
        function limpa_formulário_cep() {
            //Limpa valores do formulário de cep.
            document.getElementById('rua').value = ("");
            document.getElementById('bairro').value = ("");
            document.getElementById('cidade').value = ("");
            document.getElementById('uf').value = ("");

        }

        function meu_callback(conteudo) {
            if (!("erro" in conteudo)) {
                //Atualiza os campos com os valores.
                document.getElementById('rua').value = (conteudo.logradouro);
                document.getElementById('bairro').value = (conteudo.bairro);
                document.getElementById('cidade').value = (conteudo.localidade);
                document.getElementById('uf').value = (conteudo.uf);

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
                if (validacep.test(cep)) {

                    //Preenche os campos com "..." enquanto consulta webservice.
                    document.getElementById('rua').value = "...";
                    document.getElementById('bairro').value = "...";
                    document.getElementById('cidade').value = "...";
                    document.getElementById('uf').value = "...";


                    //Cria um elemento javascript.
                    var script = document.createElement('script');

                    //Sincroniza com o callback.
                    script.src = 'https://viacep.com.br/ws/' + cep + '/json/?callback=meu_callback';

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

    <script src="js/validar_form2.js"></script>
    <script src="js/validar_form.js"></script>
    <script type="text/javascript" src="js/jquery.mask.min.js"></script>
    <script type="text/javascript">
        $(document).ready(function() {
            $('.letters').bind('keyup blur', function() {
                var node = $(this);
                node.val(node.val().replace(/[^a-z]/g, ''));
            });
            $('#numero').mask('0#');
            $(".cnpj").mask("00.000.000/0000-00");
            $('.cep').mask('00.000-000');

            $('#data').mask('00/00/0000');

            $('.telefone').mask('(00) 0000-00009');
            $('.telefone').blur(function(event) {
                if ($(this).val().length == 15) { // Celular com 9 dígitos + 2 dígitos DDD e 4 da máscara
                    $('.telefone').mask('(00) 00000-0009');
                } else {
                    $('.telefone').mask('(00) 0000-00009');
                }
            });
            $("#enviar").click(function() {
                var form = $("#form")
                var alex = ""
                form.valid();
                if (form.valid() == true) {
                    $.post("cadastrar.php", {
                            nome: $("#nome").val(),
                            celular: $("#celular").val(),
                            telefone: $("#telefone").val(),
                            cnpj: $("#cnpj").val(),
                            uf: $("#uf").val(),
                            cidade: $("#cidade").val(),
                            rua: $("#rua").val(),
                            login: $("#login").val(),
                            bairro: $("#bairro").val(),
                            numero: $("#numero").val(),
                            complemento: $("#complemento").val(),
                            senha: $("#senha").val(),
                            cep: $("#cep").val(),
                            c_senha: $("#c_senha").val()

                        })
                        .done(function(data) {
                            if ( data == 1) {
                            	 $("#cnpj").css("background-color","#ff7b7b")
                            }
                            else if( data == 2) {
                            	$("#senha").css("background-color","#ff7b7b")
                            	$("#c_senha").css("background-color","#ff7b7b")
                            }
                            else if (data == 0 ) {
                            	 location.reload();
                            }
                            else if(data == 3){
                            	$("#texto").text("Login ou cnpj já cadastrados")
                            }
                        });
                }



            })
            $(".form-control").click(function(){
            	$(this).css("background-color","#fff")
            })
        });
    </script>
</body>

</html>