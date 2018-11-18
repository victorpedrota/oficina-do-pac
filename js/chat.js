
function update()
{

  $.post("server.php", {}, function(data){

    var obj = jQuery.parseJSON(data);
    $('#screen').text('');

    for (var i in obj) {

      if (obj[i].cod_orcamento!=0) {

        if ($('#conversa').val() == obj[i].codigo && $('#codigo').val() == obj[i].cod_destinatario && obj[i].orcamento[3]==1) {$('#screen').append("<div class='row'><ul style='margin-bottom:10px;background-color: red; width:300px;' class='list-group-item d-block'> <li class='list-inline-item'>Valor:"+obj[i].orcamento[0]+"<br>Tipo:"+obj[i].tipo+"<br>Detalhes:"+obj[i].orcamento[1]+"<br>Data de entrega:"+obj[i].orcamento[2]+"<br><button class='btn btn-default recusar'>Recusar</button><button class='btn btn-primary enviar' value='"+obj[i].cod_orcamento+"'>Aceitar</button></li></ul></div>");}
        else if($('#conversa').val() == obj[i].codigo && $('#codigo').val() == obj[i].cod_autor && obj[i].orcamento[3]==1){$('#screen').append("<div class='row'><ul style='margin-bottom:10px; width:100%;margin-left:10px;' class='list-group-item d-block'> <li class='list-inline-item'>Valor:"+obj[i].orcamento[0]+"<br>Detalhes:"+obj[i].orcamento[1]+"Data de entrega:"+obj[i].orcamento[2]+"</li></ul></div>");}
        else if ($('#conversa').val() == obj[i].codigo && obj[i].orcamento[3] == 2 ) {$('#screen').append("<div class='row'><ul style='margin-bottom:10px; width:100%;margin-left:10px;' class='list-group-item d-block'> <li class='list-inline-item'>Valor:"+obj[i].orcamento[0]+"<br>Detalhes:"+obj[i].orcamento[1]+"Data de entrega:"+obj[i].orcamento[2]+"Está em progresso</li></ul></div>");}
        else if( $('#conversa').val() == obj[i].codigo && obj[i].orcamento[3] == 0 ){$('#screen').append("<div class='row'><ul style='margin-bottom:10px; width:100%;margin-left:10px;' class='list-group-item d-block'> <li class='list-inline-item'>Um novo orçamento foi enviado</li></ul></div>");}

      }
      else{

        if ($('#conversa').val() == obj[i].codigo && $('#codigo').val() == obj[i].cod_autor && $('#cod_destinatario').val() == obj[i].cod_destinatario ) {$('#screen').append("<div class='row'><ul style='margin-bottom:10px;text-align:right;width:100%;margin-left:10px;' class='list-group-item d-block'> <li class='list-inline-item'>"+obj[i].texto+"</li></ul></div>");}
        else if($('#conversa').val() == obj[i].codigo && $('#codigo').val() == obj[i].cod_destinatario && $('#cod_destinatario').val() == obj[i].cod_autor )
          {
            
            $('#screen').append("<div class='row'><ul style='margin-bottom:10px;background-color: red; width:100%;margin-left:10px;' class='list-group-item d-block'> <li class='list-inline-item'>"+obj[i].texto+"</li></ul></div>");
          

      }
       
      }


    }
  });
  setTimeout('update()', 500);
}

$(document).ready(

  function() 
  {
    function apenasNumeros(string) 
    {
      var numsStr = string.replace(/[^0-9]/g,'');

      return parseInt(numsStr);
    }
    $("#screen").scrollTop($(this)[0].scrollHeight);
    update();

    $("#button").click(    
      function() 
      {       
        $("#screen").animate({scrollTop: $('#screen').prop("scrollHeight")}, 999);
        $.post("server.php", 
          { message: $("#message").val(), conversa: $("#conversa").val(), codigo: $("#codigo").val(), cod_destinatario:$("#cod_destinatario").val()},
          function(data){ 
            $("#screen").val(data); 
            $("#message").val("");
          }
          );
      }
      );

    $("#envia_orcamento").click(    
      function() 
      {   
       $("#form_orcamento2").validate();  
       if ($("#form_orcamento2").valid() == true) {  
         $.post("server.php", 
          { 
           valor: apenasNumeros($("#valor").val()),
          data: $("#data_inicio").val(), 
          detalhes: $("#detalhes").val(),
          conversa: $("#conversa").val(),
          codigo: $("#codigo").val(),
          data_termino:$("#data_termino").val(),
          hora:$("#horario_inicio").val(),
          cod_destinatario: $("#cod_destinatario").val(),
          tipo: $("#tipo").val()
        },

          function(data){ 
$("#form_orcamento").modal("hide");
          }
          );}
         
       }
       );

    $("#orcamento").click(function(){
      $("#form_orcamento").modal("show");
      $("#tools").modal("hide");
    })
    $(document).on('click', '.enviar', function(){
      $("#cod_orcamento").attr("value",$(this).val())
      $("#horario").modal("show")
      var data = $("."+$(this).val() + "> .data").text()

    })

    $("#aceita_chamado").click(function(){
      $("#horario").modal("hide");
      $.post("aceitar_chamado.php", 
        { cod_servico: $("#cod_servico").val(), cod_orcamento: $("#cod_orcamento").val(), data: $("#data").val()},
        function(data){ 

        }
        );
    })

  });
