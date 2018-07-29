
      function update()
      {
        
        $.post("server.php", {}, function(data){

          var obj = jQuery.parseJSON(data);
          $('#screen').text('');

         for (var i in obj) {

              if (obj[i].cod_orcamento!=0) {

                if ($('#conversa').val() == obj[i].codigo && $('#codigo').val() != obj[i].cod_autor && obj[i].orcamento[3]==1) {$('#screen').append("<div class='orcamento b' style='float:left;height200px;'>Valor:"+obj[i].orcamento[0]+"<br>Detalhes:"+obj[i].orcamento[1]+"<br>Data de entrega:"+obj[i].orcamento[2]+ "<br><button class='btn btn-default'>Recusar</button><a style='color:white;' href='aceitar.php?cod_servico="+obj[i].codigo+"&cod_orcamento="+obj[i].cod_orcamento+"' class='btn btn-primary' value="+obj[i].cod_orcamento+">aceitar</a></div><br><br><br><br><br><br><br>");}
                else if($('#conversa').val() == obj[i].codigo && $('#codigo').val() == obj[i].cod_autor && obj[i].orcamento[3]==1){$('#screen').append("<div class='orcamento b' style='float:right;height200px;'>Valor:"+obj[i].orcamento[0]+"<br>Detalhes:"+obj[i].orcamento[1]+"<br>Data de entrega:"+obj[i].orcamento[2]+ "</div><br><br><br><br><br><br>");}
                else if (obj[i].orcamento[3] == 2) {$('#screen').append("<div class='orcamento b' style='float:left;height200px;'>Valor:"+obj[i].orcamento[0]+"<br>Detalhes:"+obj[i].orcamento[1]+"<br>Data de entrega:"+obj[i].orcamento[2]+ "<br>Está em progresso</div><br><br><br><br><br><br>");}
                else if(obj[i].orcamento[3] == 0){$('#screen').append("<div class='orcamento b' style='float:left;height200px;'>Valor:"+obj[i].orcamento[0]+"<br>Detalhes:"+obj[i].orcamento[1]+"<br>Data de entrega:"+obj[i].orcamento[2]+ "<br>Um novo orçamento foi enviado</div><br><br><br><br><br><br>");}

              }
              else{

                if ($('#conversa').val() == obj[i].codigo && $('#codigo').val() == obj[i].cod_autor) {$('#screen').append("<div class='rcorners1 b' style='float:right;'>Você:"+obj[i].texto + "</div><br><br><br>");}
                else if($('#conversa').val() == obj[i].codigo && $('#codigo').val() != obj[i].cod_autor){$('#screen').append("<div class='rcorners2 b' style='float:left;'>"+obj[i].texto + "</div><br><br><br>");}
              }


            }
          });
        setTimeout('update()', 1000);
      }

      $(document).ready(

        function() 
        {
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
             $.post("server.php", 
              { valor: $("#valor").val(), data: $("#data").val(), detalhes: $("#detalhes").val(),conversa: $("#conversa").val(), codigo: $("#codigo").val()},
              function(data){ 

              }
              );
             $("#form_orcamento").modal("hide");
           }
           );

           $("#orcamento").click(function(){
            $("#form_orcamento").modal("show");
            $("#tools").modal("hide");
          })

       });
