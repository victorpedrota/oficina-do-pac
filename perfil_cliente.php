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
  $cod_cliente = $_SESSION["cod_cliente"];

  if($system_control == 1 && $privilegio == 0){
    require('connect.php');

    $sql_pesquisa ="SELECT * FROM `cliente` WHERE `cod_login` = $cod_login" ;
    $resultado = mysqli_query($conn,$sql_pesquisa);
    $vetor = mysqli_fetch_array($resultado);


    $oficina ="SELECT * FROM `oficina` ORDER BY `nome`";
    $oficinas_query = mysqli_query($conn,$oficina);
    $numero_oficina = mysqli_num_rows($oficinas_query);

    $sql ="SELECT * FROM `login` WHERE `cod_login` = $cod_login" ;
    $resultado_pesquisa = mysqli_query($conn,$sql);
    $vetor_login = mysqli_fetch_array($resultado_pesquisa);
    $first_acess = $vetor_login['first_acess'];


    

    $sql_veiculo ="SELECT * FROM `veiculo` WHERE `cod_cliente` = $cod_cliente" ;
    $veiculo_resultado = mysqli_query($conn,$sql_veiculo);
    $numero_veiculos = mysqli_num_rows($veiculo_resultado);

    $sql_servico = "SELECT * FROM `servico` WHERE  `cod_cliente` = $cod_cliente";
    $query_servico = mysqli_query($conn, $sql_servico);
    $numero_servico = mysqli_num_rows($query_servico); 


    $_SESSION["nome"] = $vetor["nome"];
    ?>

    <!DOCTYPE html>
    <html>

    <head>
        <title>Oficina Pro</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <!-- Bootstrap CSS CDN -->
        <link rel="stylesheet" href="scss/main.css">
        <link rel="stylesheet" href="css/chat.css">
        <!-- Our Custom CSS -->
        <link rel="stylesheet" type="text/css" href="css/style.css">
        <link rel="stylesheet" href="css/starrr.css">


    </head>

    <body style="overflow-x: hidden;">


        <?php
        require("navbar_logout.html");
        ?>
        <div class="row">
            <nav class="col-md-2 col-xs-12 d-none d-md-block bg-light sidebar">
                <div class="sidebar-sticky">
                    <ul class="nav flex-column">
                        <li class="nav-item">
                            <a class="nav-link active" href="">
                                <span data-feather="home"></span>
                                Página inical <span class="sr-only">(current)</span>
                            </a>

                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#" id="btnfeed">Feed</a>
                        </li>
                        


                        <li class="nav-item">
                            <a class="nav-link" href="#" id="btnandamento">Serviços em andamento
                            </a>
                        </li>
                        
                        <li class="nav-item">
                            <a class="nav-link" href="form_veiculo.php">Gerenciar Veículos</a>
                        </li>


                    </ul>
                </div>
            </nav>

            <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">
                <div class="row">
                 <div class="col-md-8 col-sm-10 col-xs-12" id="chat" style="display: none;">

                    <ul style="text-align: left;" class="list-group">
                      <center>
                        <h4 id="titulo " class="d-inline">Chat</h4><button style="margin-top: -7px;" type="button" class="btn btn-link d-inline" data-toggle="popover" title="Serviços da oficina" data-content="Aqui estão os serviços em progresso da oficina"><i class="fas fa-info-circle"></i></button></center>
                        <?php
                        $sql_servico2 = "SELECT * FROM `mensagens` WHERE  `cod_destinatario` = $cod_login";
                        $query_servico2 = mysqli_query($conn, $sql_servico2);
                        $numero_servico2 = mysqli_num_rows($query_servico2); 
                        if ($numero_servico2 !=0) {
                          while ($vetor_servico2 = mysqli_fetch_array($query_servico2)) {

                          }
                      }else{
                          echo "<li class='list-group-item itens'>Não há veiculos nesta fase</li>";
                      }
                      ?>

                  </ul>


              </div>

              <div class="col-md-8 col-sm-10 col-xs-12" id="feed" style="display: block;"><br>
                <ul style="text-align: left;" class="list-group">

                    <!-- coemca aqui-->
                    <?php


                    $sql_servico ="SELECT * FROM `servico` WHERE `cod_cliente` = $cod_cliente" ;

                    $servicos = mysqli_query($conn,$sql_servico);
                    $numero_servicos = mysqli_num_rows($servicos);

                    if ($first_acess == 1 && $numero_servicos == 0) {
                        echo "<li class='list-group-item itens'><p style='display:block;'>Não há atualizações</p></li>";
                    }
                    else if ($first_acess == 0 && $numero_servicos == 0) {

                        echo "<li class='list-group-item itens'><p style='display:block;'><center><h1>Seja bem vindo</h1><center></li>";
                    }
                    while ($vetor_servicos = mysqli_fetch_array($servicos)) {
                      $cod_servicos = $vetor_servicos['cod_servico'];
                      $sql_atualizacao ="SELECT * FROM `atualizacao` WHERE `cod_servico` = $cod_servicos ORDER BY `cod_atualizacao` DESC" ;
                      $atualizacao = mysqli_query($conn,$sql_atualizacao);




                      $num = mysqli_num_rows($atualizacao);


                      if ( $num == 0) {

                      } else{

                          while ($vetor_atualizacao = mysqli_fetch_array($atualizacao)) {
                            $cod_mecanico = $vetor_atualizacao['cod_mecanico'];
                            $nome_mecanico ="SELECT * FROM `mecanico` WHERE `cod_mecanico` = $cod_mecanico";
                            $mecanico = mysqli_query($conn,$nome_mecanico);
                            $numero_mecanico = mysqli_num_rows($mecanico);
                            if ($numero_mecanico == 0) {
                                $nome = "Não cadastrado";
                                $imagem = "fotos_usuario/default.jpg";
                            }
                            else{
                                $vetor_mecanico = mysqli_fetch_array($mecanico);
                                $nome = $vetor_mecanico['nome'];

                                $cod_login = $vetor_mecanico['cod_login'];
                                $query_foto ="SELECT * FROM `login` WHERE `cod_login` = $cod_login";
                                $mecanico_foto = mysqli_query($conn,$query_foto);
                                $vetor_mecanico_login = mysqli_fetch_array($mecanico_foto);
                                $imagem = $vetor_mecanico_login['imagem'];
                            }



                            ?>
                            <div class="card text-left">
                                <div class="card-header">
                                    <?php echo "<span style='left:0px;'><img style='width:50px;height:50px; border-radius:50%;' src='".$imagem."'><strong> " .$nome."</strong></span>";?>
                                </div>
                                <div class="card-body">

                                    <p style="left: 0px;">Assunto:
                                        <?php echo $vetor_atualizacao['assunto'];?>
                                    </p>
                                    <p class="card-text">Status do carro:
                                        <?php echo $vetor_atualizacao['mensagem'];?>
                                    </p>

                                </div>
                                <div class="card-footer text-muted">

                                </div>
                            </div><br>
                            <?php
                        }
                    }


                }

                ?>
            </ul>
        </div>
        <div class="modal fade" id="emandamento" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Serviços sendo realizados</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
              </button>
          </div>
          <div class="modal-body">
            <ul class="list-group" id="serv_realizados" >
                     
                      
                    </ul>
            
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
            
        </div>
    </div>
</div>
</div>

<!--AQUI ESTARÁ A PORRA DO CÓDIGO DA PORRA DO CHAMADO, PEDRO É UMA PUTA  -->
<div class="col-8" id="andamento" style="display: none;"><br>
    <center>
        <h4 id="titulo">Serviço aguardando resposta</h4>
        <div id="info"></div>
        <ul style="text-align: left;" class="list-group">

            <?php

            $sql_servico = "SELECT * FROM `servico` WHERE `cod_cliente` = $cod_cliente && `status` = 0";
            $query_servico = mysqli_query($conn, $sql_servico);
            if (mysqli_num_rows($query_servico) == 0) {

                echo "<li class='list-group-item itens'><p style='display:block;'>Não há veículos nesta fase</p></li>";
            }

            while ($vetor_servico = mysqli_fetch_array($query_servico)) {

                $veiculo = $vetor_servico['cod_veiculo'];
                $sql_veiculo_anda ="SELECT * FROM `veiculo` WHERE `cod_veiculo` = $veiculo" ;
                $veiculo_resultado_anda = mysqli_query($conn,$sql_veiculo_anda);
                $vetor_veiculo_anda = mysqli_fetch_array($veiculo_resultado_anda);
                echo "<li class='list-group-item itens'><p style='display:inline-block;'>
                Veículo:".$vetor_veiculo_anda['placa']."
                Protocolo:   ".$vetor_servico['protocolo']."<br>Status: Aguardando aceitação da Oficina<br>
                Serviço desejado:".$vetor_servico['servico_desejado']."
                </li>";



            }

            ?>

        </ul>
        <br>
        <br>

        <h4 id="titulo">Serviços em discussão</h4>
        <div id="info"></div>
        <ul style="text-align: left;" class="list-group">

            <?php
            $sql_servico = "SELECT * FROM `servico` WHERE  `cod_cliente` = $cod_cliente && `status`=1";
            $query_servico = mysqli_query($conn, $sql_servico);
            $numero_servico = mysqli_num_rows($query_servico); 
            if ($numero_servico !=0) {
              while ($vetor_servico = mysqli_fetch_array($query_servico)) {
                if ($vetor_servico['cod_mecanico'] == 0) {
                   $veiculo = $vetor_servico['cod_veiculo'];
                   $sql_veiculo ="SELECT * FROM `veiculo` WHERE `cod_veiculo` = $veiculo" ;
                   $veiculo_resultado = mysqli_query($conn,$sql_veiculo);
                   $vetor_veiculo = mysqli_fetch_array($veiculo_resultado);
                   echo "<li class='list-group-item itens'><p style='display:block;'>
                   Veículo:".$vetor_veiculo['placa']."
                   Protocolo:   ".$vetor_servico['protocolo']."<br>Status: Aguardando cliente finalizar o Chamado<br>
                   Serviço desejado:".$vetor_servico['servico_desejado']."<br>    
                   <div class='alert alert-danger' role='alert'>Parece que o mecânico responsável pelo seu serviço teve problemas, aguarde até que um novo responsável seja designado</div>
                   </li>";
               }else{
                $veiculo = $vetor_servico['cod_veiculo'];
                $sql_veiculo ="SELECT * FROM `veiculo` WHERE `cod_veiculo` = $veiculo" ;
                $veiculo_resultado = mysqli_query($conn,$sql_veiculo);
                $vetor_veiculo = mysqli_fetch_array($veiculo_resultado);
                echo "<li class='list-group-item itens'><p style='display:block;'>
                Veículo:".$vetor_veiculo['placa']."<a href='chat.php?cod_servico=".$vetor_servico['cod_servico']."' style='float:right; right:0px;'><i class='fas fa-external-link-alt'></i></a>
                Protocolo:   ".$vetor_servico['protocolo']."<br>Status: Aguardando cliente finalizar o Chamado<br>
                Serviço desejado:".$vetor_servico['servico_desejado']."
                </li>";
            }

        }

    }



    else{

      echo "<li class='list-group-item itens'>Não há veiculos nesta fase</li>";

  }
  ?>
</ul>
<br>
<br>

<h4 id="titulo">Aguardando Veículo dar entrada na oficina</h4>
<div id="info"></div>
<ul style="text-align: left;" class="list-group">
    <?php

    $sql_servico = "SELECT * FROM `servico` WHERE  `cod_cliente` = $cod_cliente && `status`=2";
    $query_servico = mysqli_query($conn, $sql_servico);
    $numero_servico = mysqli_num_rows($query_servico); 
    if ($numero_servico !=0) {
      while ($vetor_servico = mysqli_fetch_array($query_servico)) {

         if ($vetor_servico['cod_mecanico'] == 0) {
            $veiculo = $vetor_servico['cod_veiculo'];
            $sql_veiculo ="SELECT * FROM `veiculo` WHERE `cod_veiculo` = $veiculo" ;
            $veiculo_resultado = mysqli_query($conn,$sql_veiculo);
            $vetor_veiculo = mysqli_fetch_array($veiculo_resultado);
            echo "<li class='list-group-item itens'><p style='display:block;'>
            Veículo:".$vetor_veiculo['placa']."
            Protocolo:   ".$vetor_servico['protocolo']."<br>Status: Aguardando carro ser entregue<br>
            Serviço desejado:".$vetor_servico['servico_desejado']."
            <div class='alert alert-danger' role='alert'>Parece que o mecânico responsável pelo seu serviço teve problemas, aguarde até que um novo responsável seja designado</div>
            </li>";
        }
        else{
            $veiculo = $vetor_servico['cod_veiculo'];
            $sql_veiculo ="SELECT * FROM `veiculo` WHERE `cod_veiculo` = $veiculo" ;
            $veiculo_resultado = mysqli_query($conn,$sql_veiculo);
            $vetor_veiculo = mysqli_fetch_array($veiculo_resultado);
            echo "<li class='list-group-item itens'><p style='display:block;'>
            Veículo:".$vetor_veiculo['placa']."<a href='chat.php?cod_servico=".$vetor_servico['cod_servico']."' style='float:right; right:0px;'><i class='fas fa-external-link-alt'></i></a>
            Protocolo:   ".$vetor_servico['protocolo']."<br>Status: Aguardando carro ser entregue<br>
            Serviço desejado:".$vetor_servico['servico_desejado']."
            </li>";

        }


    }

}



else{

  echo "<li class='list-group-item itens'>Não há veiculos nesta fase</li>";

}              


?>

</ul>

<h4 id="titulo">Em andamento</h4>
<div id="info"></div>
<ul style="text-align: left;" class="list-group">
    <?php

    $sql_servico = "SELECT * FROM `servico` WHERE  `cod_cliente` = $cod_cliente && `status`=3";
    $query_servico = mysqli_query($conn, $sql_servico);
    $numero_servico = mysqli_num_rows($query_servico); 
    if ($numero_servico !=0) {
      while ($vetor_servico = mysqli_fetch_array($query_servico)) {
        if ($vetor_servico['cod_mecanico'] == 0) {
            $veiculo = $vetor_servico['cod_veiculo'];
            $sql_veiculo ="SELECT * FROM `veiculo` WHERE `cod_veiculo` = $veiculo" ;
            $veiculo_resultado = mysqli_query($conn,$sql_veiculo);
            $vetor_veiculo = mysqli_fetch_array($veiculo_resultado);
            echo "<li class='list-group-item itens'><p style='display:block;'>
            Veículo:".$vetor_veiculo['placa']."
            Protocolo:   ".$vetor_servico['protocolo']."<br>Status: Aguardando carro ser entregue<br>
            Serviço desejado:".$vetor_servico['servico_desejado']."
            <div class='alert alert-danger' role='alert'>Parece que o mecânico responsável pelo seu serviço teve problemas, aguarde até que um novo responsável seja designado</div>
            </li>";

        }
        else{
            $veiculo = $vetor_servico['cod_veiculo'];
            $sql_veiculo ="SELECT * FROM `veiculo` WHERE `cod_veiculo` = $veiculo" ;
            $veiculo_resultado = mysqli_query($conn,$sql_veiculo);
            $vetor_veiculo = mysqli_fetch_array($veiculo_resultado);
            echo "<li class='list-group-item itens'><p style='display:block;'>
            Veículo:".$vetor_veiculo['placa']."<a href='chat.php?cod_servico=".$vetor_servico['cod_servico']."' style='float:right;margin-top;7px; right:0px;'><i class='fas fa-external-link-alt'></i></a> <button class='btn btn-link expandir' data-toggle='modal' data-target='#emandamento' value='".$vetor_servico['cod_servico']."' style='float:right; right:0px;margin-top:-4px;color:black;'><i class='fas fa-expand-arrows-alt'></i></button>
            Protocolo:   ".$vetor_servico['protocolo']."<br>Status: Aguardando carro ser entregue<br>
            Serviço desejado:".$vetor_servico['servico_desejado']."
            </li>";

        }


    }

}



else{

  echo "<li class='list-group-item itens'>Não há veiculos nesta fase</li>";

}              


?>

</ul>

<h4 id="titulo">Finalizados</h4>
<div id="info"></div>
<ul style="text-align: left;" class="list-group">
    <?php

    

    $sql_servico4 = "SELECT * FROM `avaliacao` WHERE `nota_usuario` =0 ";
    $query_servico4 = mysqli_query($conn, $sql_servico4);
    $numero_servico4 = mysqli_num_rows($query_servico4); 
    if ($numero_servico4 !=0) {
      while ($vetor_servico = mysqli_fetch_array($query_servico4)) {
        $cod_servico1 = $vetor_servico['cod_servico'];
        $sql_servico = "SELECT * FROM `servico` WHERE  `cod_servico` = $cod_servico1";
        $query_servico = mysqli_query($conn, $sql_servico);
        $vetor_servico1 = mysqli_fetch_array($query_servico);
        $veiculo = $vetor_servico1['cod_veiculo'];
        $sql_veiculo ="SELECT * FROM `veiculo` WHERE `cod_veiculo` = $veiculo" ;
        $veiculo_resultado = mysqli_query($conn,$sql_veiculo);
        $vetor_veiculo = mysqli_fetch_array($veiculo_resultado);
        echo "<li class='list-group-item itens'><p style='display:block;'>
        Veículo:".$vetor_veiculo['placa']."
        Protocolo:   ".$vetor_servico1['protocolo']."<br>Status: Serviço Finalizado<br>
        Serviço desejado:".$vetor_servico1['servico_desejado']."<br><br><button value='".$vetor_servico1['cod_servico']."' data-toggle='modal' data-target='#avaliacao' class='btn btn-primary codigof'>Avaliar Mecânico</button>
        </li>";




    }

}



else{

  echo "<li class='list-group-item itens'>Não há veiculos nesta fase</li>";

}              


?>

</ul>

</center>
</div>

<div id="chamados" class="col-8" style="display: none; margin-top: 60px;">
    <center>
        <h3>Inicar Chamado</h3>
    </center>
    <form method="post" action="abrir_chamado.php" id="form">
        <div class="row">
            <div class="col">

                Veiculo:

                <select class="form-control" id="veiculos" name="veiculo" required>
                    <option value="">Selecione um Veículo</option>
                    <?php 
                    $sql_veiculo ="SELECT * FROM `veiculo` WHERE `cod_cliente` = $cod_cliente" ;
                    $veiculo_resultado = mysqli_query($conn,$sql_veiculo);
                    while ($vetor_veiculo = mysqli_fetch_array($veiculo_resultado)) {
                        echo "<option value=".$vetor_veiculo['cod_veiculo'].">Modelo:  ".$vetor_veiculo['modelo']."      Placa:  ".$vetor_veiculo['placa']."</option>";
                    }
                    ?>
                </select>
            </div>
            <div class="col">
                Tipo de serviço: <i class="fas fa-info-circle"></i>
                <select class="form-control" id="tipo" name="tipo" required>
                    <option value="">Selecione um tipo</option>
                    <option value="troca">troca de oleo</option>
                </select>
                <input type="hidden" name="n_oficina" id="n_oficina">
            </div>
        </div>
        Descrição do problema:<textarea name="problema" id="descricao" style="border-radius: 1em;" class="form-control" required></textarea> Serviço desejado:<textarea name="servico" id="servico" style="border-radius: 1em;" class="form-control" required></textarea>
        <center><br><a class="btn btn-secondary" href="#">Cancelar</a>
            <button type="button" id="enviar" class="btn btn-primary">Enviar</button></center>
            <input type="hidden" id="cod_cliente" value="<?php echo $cod_cliente;?>">
        </form>
    </div>


    <div class="col-2 d-none d-sm-block d-sm-none d-md-block" style="margin-top: 25px;margin-bottom: 10px">
        <div class="card" style="width: 20rem;position: fixed;">
            <img class="card-img-top" src="http://www.agenciamestre.com/anuncios-facebook/img/img-anuncios-patrocinados.jpg" style="filter: grayscale(100%);" alt="Card image cap">
            <div class="card-body">
                <h5 class="card-title">Anúncio</h5>
                <p class="card-text">Espaço reservado para anúncio</p>

            </div>
        </div>
    </div>

</div>
</main>
</div>


<div class="modal fade" id="oficinas" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Escolha a(s) oficina(s)</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" id="corpo">
                <div data-id="1" id="1">
                    <div class="input-group">
                        <input name="noficina" id="nome_1" class="form-control nomes" data-live-search="true" style="border-top-left-radius:3px; border-bottom-left-radius:3px; border-top-right-radius: 0px;border-bottom-right-radius: 0px; margin-left: 5px;height: 36px;width: 362px;">



                        <div class="input-group-btn">
                            <button class="btn btn-default" id="addoficina" style="border-top-left-radius:0px; border-bottom-left-radius:0px; border-top-right-radius: 3px;border-bottom-right-radius: 3px; height: 36px" type="submit">
                                <i class="fas fa-plus"></i>
                            </button>
                        </div>
                        <div id="lista_nomes_1" style=" margin-top:0px; width: 100%; background-color: white; position: relative;"></div>

                    </div>
                </div>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                <button type="button" id="btnenviar" class="btn btn-primary">Continuar</button>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="avaliacao" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalCenterTitle">Avaliar Mecânico</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
      </button>
  </div>
  <div class="modal-body">
    <center>
      <input type="hidden" value="" id="cod_serv" name="cod_serv">
      <input type="hidden" value="" id="excluido" name="excluido">
      <img src="" id="foto" style="border-radius: 50%;height: 80px;width: 80px;"><br><br>
      <div id="vaiq"></div> </center> 
      <input type="hidden" id="nota" value="">  
  </div>
  <div class="modal-footer">
    <button type="button" class="btn btn-secondary" id="fechar" data-dismiss="modal">Fechar</button>
    <button type="button" id="envia" class="btn btn-primary">Enviar</button>
</div>
</div>
</div>
</div>
<script src="js/validar_form2.js"></script>
<script src="js/validar_form.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<script src="js/starrr.js"></script>

<script>

    $(document).ready(function(){



        $("#btnenviar").click(function() {
            var nome = $("#nomes").val();
            $("#n_oficina").attr("value", nome);

            var inputs = new Array();

            $(".hidden").each(function() {
                inputs.push($(this).val());
            });

            $.post("abrir_chamado.php", {
                veiculo: $("#veiculos").val(),
                tipo: $("tipo").val(),
                problema: $("#descricao").val(),
                servico: $("#servico").val(),
                n_oficina: "[" + inputs + "]",
                cod_cliente: $("#cod_cliente").val()
            });
        });
        $('#btnchamados').on('click', function() {
            $('#chamados').css("display", "block");
            $('#andamento').css("display", "none");
            $('#feed').css("display", "none");
            $('#chat').css("display", "none");
        });
        $('#btnfeed').on('click', function() {
            $('#feed').css("display", "block");
            $('#andamento').css("display", "none");
            $('#chamados').css("display", "none");
            $('#chat').css("display", "none");
        });
        $('#btnandamento').on('click', function() {
            $('#andamento').css("display", "block");
            $('#chamados').css("display", "none");
            $('#feed').css("display", "none");
            $('#chat').css("display", "none");

        });
        $('#btnchat').on('click', function() {
            $('#chat').css("display", "block");
            $('#andamento').css("display", "none");
            $('#chamados').css("display", "none");
            $('#feed').css("display", "none");
            
        });
        $("#enviar").click(function() {
            var form = $("#form");
            form.valid();
            if (form.valid() == true) {
                $("#oficinas").modal("show");
            }


            $('html').on('keyup', '.nomes', function() {
                var target = $(this).closest('[data-id]');
                $("#lista_nomes_" + target.data("id") + " button").remove();
                $.post("search.php", {
                    texto: $(this).val()
                },
                function(data) {
                    var obj = jQuery.parseJSON(data);
                    for (var i in obj) {
                        $("#lista_nomes_" + target.data("id")).append("<button  href='#' value='" + obj[i].id + "' id='botao" + i + "' class='btn btn-link escolha'>" + obj[i].text + "</button>");
                    }

                }
                );
            }).keydown(function() {
                var target = $(this).closest('[data-id]');
                $("#lista_nomes_" + target.data("id") + " button").remove();
            });



            $('html').on('click', '.escolha', function() {
                var target = $(this).closest('[data-id]');
                var botao = $(this).val();
                $("#teste" + target.data("id")).remove();
                $(this).closest('div').remove()
                var num = target.data("id");
                $("#nome" + target.data("id")).remove();
                $("#nome_" + target.data("id")).val($(this).text());
                $("#lista_nomes_" + target.data("id")).append("<input type='hidden' id='teste" + num + "' class='hidden' value='" + botao + "'>");

            })




            var id = 1;
            $('html').on('click', '#addoficina', function() {

                id++;
                var teste = "<br><div  data-id=" + id + ">" +
                "<div class='input-group'>" +
                "<input name='noficina' list='lista_nomes' id='nome_" + id + "' class='form-control nomes' data-live-search='true' style='border-top-left-radius:3px; border-bottom-left-radius:3px; border-top-right-radius: 0px;border-bottom-right-radius: 0px; margin-left: 5px;height: 36px;width: 362px;'>" +

                "<div class='input-group-btn'>" +
                "<button class='btn btn-default' id='addoficina' style='border-top-left-radius:0px; border-bottom-left-radius:0px;border-top-right-radius: 3px;border-bottom-right-radius: 3px; height: 36px' type='submit'>" +
                "<i class='fas fa-plus'></i>" +
                "</button></div></div><div  id=lista_nomes_" + id + "  style='margin-top:0px; width: 100%; background-color: white; position: relative;''></div></div></div>";
                $("#corpo").append(teste);

            });

        });
        $(".codigof").click(function() {
            $("#cod_serv").val($(this).val())
            $.post( "server.php", { tipo: "cliente" ,codigo: $(this).val() } )
            .done(function( data ) {
                alert(data)
                if (data == "erro") {
                    $( "#foto" ).attr( "src", "//ssl.gstatic.com/accounts/ui/avatar_2x.png" );
                    $('#bct').remove();
                    $("#foto").after("<div id='bct'><br><br><strong>O mecânico não trabalha mais nesta oficina</strong></div>");
                    $( ".starrr" ).remove();
                    $("#excluido").attr("value",1)

                }
                else{
                    $( "#foto" ).attr( "src", data );
                    $("#excluido").attr("value",0)
                }


            })
            $( ".starrr" ).remove();
            $("#vaiq").append("<div class='starrr' id='star1'></div>")
            $('.starrr').starrr({
              change: function(e, value){
                $("#nota").val(value)


            }
        })
        })


        $("#fechar").click(function(){

            $( ".starrr" ).remove();
        })

        $("#envia").click(function(){
            alert($("#excluido").val())
            $.post( "server.php", { tipo: "cliente", nota: $("#nota").val(), cod: $("#cod_serv").val(), excluido: $("#excluido").val()} ).done(function( data ) {

            });

            $(location).attr('href', 'perfil_cliente.php');

        })
        $(".expandir").click(function(){
            $( ".opora" ).each(function( index ) {
              $(this).remove()
          });

            $.post( "server.php", { servicos: $(this).val() })
            .done(function( data ) {
                console.log(data)
                var serv = 1;
                var obj = jQuery.parseJSON(data);
                for (var i in obj) {
                    if (obj[i].status == 2) {
                      $("#serv_realizados").append("<li class='list-group-item opora'>Serviço "+serv+": "+obj[i].tipo+"    <br>    Data inicio:"+obj[i].data_inicio+"<br>Em progresso</li>")
                  }else if (obj[i].status ==3) {
                    $("#serv_realizados").append("<li class='list-group-item opora'>Serviço "+serv+": "+obj[i].tipo+" <br>       Data inicio:"+obj[i].data_inicio+"Concluído <i style='color:green;float:right;' class='fas fa-check'></i></li>")
                  }
                  serv = serv+1
              }   
          })

        })
    })
</script>


</body>

</html>
<?php
}
else
{

  session_destroy();



  require('erro.php');

}
}
?>