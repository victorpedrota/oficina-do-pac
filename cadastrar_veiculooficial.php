<!doctype html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Cadastrar veiculo</title>
	<style>

</style>
</head>
<body>
</body>
<?php
   require("navbar_logout.html");
 ?>
 <script
src="https://code.jquery.com/jquery-3.2.0.min.js"
integrity="sha256-JAW99MJVpJBGcbzEuXk4Az05s/XyDdBomFqNlM3ic+I="
crossorigin="anonymous"></script>
	<select name="marcas" class="form-control" id="marcas">
		<option>Selecione uma Marca</option>
	</select>
	
	<div id="div"></div>
	<script>
		$( document ).ready(function() {

			$.getJSON('http://fipeapi.appspot.com/api/1/carro/marcas.json', function(data) {
				var select = ''

				for (var i in data) {

					select += '<option value="'+ data[i].id +'">'+ data[i].fipe_name + '</option>';

				}
				
				$('#marcas').append(select);

			});

			$( "#marcas" )
			.change(function () {
				var str = "";
				$( "#marcas option:selected" ).each(function() {
					str = $( this ).val();
					$.getJSON('http://fipeapi.appspot.com/api/1/carros/veiculos/'+str+'.json', function(data) {

						var select = '<select class="form-control">';
						for (var i in data) {

							select += '<option value="'+data[i].id +'">'+ data[i].name + '</option>';

						}
						select += '</select>';
						$('#div').html(select);

					});
				});
		
			})
			.change();

		});




	</script>
</body>
</html>