
function update()
{

  $.post("server.php", {}, function(data){

    var obj = jQuery.parseJSON(data);
    $('#screen').text('');

    for (var i in obj) {

      if (obj[i].cod_orcamento!=0) {

        if ($('#conversa').val() == obj[i].codigo && $('#codigo').val() != obj[i].cod_autor && obj[i].orcamento[3]==1) {$('#screen').append("<div class='orcamento b "+obj[i].cod_orcamento+"' style='float:left;height200px;'>Valor:"+obj[i].orcamento[0]+"<br>Detalhes:"+obj[i].orcamento[1]+"<br>Data de entrega:<p class='data'>"+obj[i].orcamento[2]+ "</p><br><button class='btn btn-default'>Recusar</button><button style='color:white;' class='btn btn-primary enviar' value="+obj[i].cod_orcamento+">aceitar</button></div><br><br><br><br><br><br><br><br><br>");}
        else if($('#conversa').val() == obj[i].codigo && $('#codigo').val() == obj[i].cod_autor && obj[i].orcamento[3]==1){$('#screen').append("<div class='orcamento b' style='float:right;height200px;'>Valor:"+obj[i].orcamento[0]+"<br>Detalhes:"+obj[i].orcamento[1]+"<br>Data de entrega:"+obj[i].orcamento[2]+ "</div><br><br><br><br><br><br>");}
        else if (obj[i].orcamento[3] == 2) {$('#screen').append("<div class='orcamento b' style='float:left;height200px;'>Valor:"+obj[i].orcamento[0]+"<br>Detalhes:"+obj[i].orcamento[1]+"<br>Data de entrega:"+obj[i].orcamento[2]+ "<br>Está em progresso</div><br><br><br><br><br><br>");}
        else if(obj[i].orcamento[3] == 0){$('#screen').append("<div class='orcamento b' style='float:left;height200px;'>Valor:"+obj[i].orcamento[0]+"<br>Detalhes:"+obj[i].orcamento[1]+"<br>Data de entrega:"+obj[i].orcamento[2]+ "<br>Um novo orçamento foi enviado</div><br><br><br><br><br><br><br>");}

      }
      else{

        if ($('#conversa').val() == obj[i].codigo && $('#codigo').val() == obj[i].cod_autor) {$('#screen').append("<div class='rcorners1 b' style='float:right;'>"+obj[i].texto + "</div><br><br><br>");}
        else if($('#conversa').val() == obj[i].codigo && $('#codigo').val() != obj[i].cod_autor){$('#screen').append("<div class='rcorners2 b' style='float:left;'>"+obj[i].texto + "</div><br><br><br>");}
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
          { message: $("#message").val(), conversa: $("#conversa").val(), codigo: $("#codigo").val()},
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
          { valor: apenasNumeros($("#valor").val()), data: $("#data").val(), detalhes: $("#detalhes").val(),conversa: $("#conversa").val(), codigo: $("#codigo").val()},
          function(data){ 

          }
          );}
         $("#form_orcamento").modal("hide");
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
