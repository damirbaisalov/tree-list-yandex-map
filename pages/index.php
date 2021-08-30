<!DOCTYPE html>
<html>
<head>
	<title>Задание BF</title>
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" integrity="undefined" crossorigin="anonymous">
	<style type="text/css">
		/*#resultDiv{
			width: 100%;
			height: 100%;
			border: 1px solid black;
		}*/
		/*img{
			width: 50px;
			height: 50px;
			border: 1px solid black;
		}*/
	</style>
</head>
<body>
	<div class="container-fluid p-5">
		<h1>Форма Регистрации</h1>
		<form method="post" id="formSignIn" enctype="multipart/form-data">
			<input type="text" class="form-control mt-2" id="name" name="name" placeholder="Введите ФИО"><br>
			<input type="text" class="form-control mt-2" id="year" name="year" placeholder="Введите Дату Рождения"><br>
			<input type="text" class="form-control mt-2" id="doc" name="doc" placeholder="Введите ИИН"><br>
			<input type="text" class="form-control mt-2" id="tel" name="tel" placeholder="Введите номер телефона"><br>
			<input type="text" class="form-control mt-2" id="adres" name="adres" placeholder="Введите Адрес"><br>
			<input type="file" class="form-control mt-2" id="file" name="file" /><br>
			<input id="button" class="btn btn-success mt-3 btn-block" type="button" value="Отправить" />
		</form>
	</div>	
	<div id="resultDiv" class="container-fluid text-success"></div><br>

	<div class="container-fluid">
		<table class="table">
		  <thead class="thead-inverse">
		    <tr>
		      <th>#</th>
		      <th>Имя пользователя</th>
		      <th>Дата Рождения</th>
		      <th>ИИН</th>
		      <th>Номер телефона</th>
		      <th>Адрес</th>
		      <th>Картинка(путь)</th>
		    </tr>
		  </thead>
		  <tbody id="users_tbody">
		    <tr>
		      <th scope="row">1</th>
		      <td>Nariman</td>
		      <td>05.12.2000</td>
		      <td>051205647858</td>
		      <td>+77051039218</td>
		      <td>Bruklin, street Mountain, 215</td>
		      <td>/uploads/file_6006b968d5d7b7.19098174.jpg</td>
		    </tr>
		    

		    <tr>
		      <th scope="row">2</th>
		      <td>Mark</td>
		      <td>15.04.2000</td>
		      <td>123654786932</td>
		      <td>+77053259658</td>
		      <td>New Yourk, street Beverly, 54</td>
		      <td>/uploads/file_6006b968d5d7b7.19098174.jpg</td>
		    </tr>

	
		  </tbody>
		</table>
	</div>	
	<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
	<!-- <script  src="ajax.js"></script> -->
</body>
</html>
<script>
    $('document').ready(function(){
	$('#button').click(function(){
		$("#resultDiv").html('');
		// var namein = $("#name").val();
		// var yearin = $("#year").val();
		// var docin = $("#doc").val();
		// var telin = $("#tel").val();
		// var adresin = $("#adres").val();
		// if(namein.length < 5 || adresin.length < 5){
		// 	$("#resultDiv").html("Заполните все поля.И картинку тоже");
		// }else{
			// элемент, с помощью которого пользователь выбирает файл
        	var file = $('#file');
			/*var file_data = $('#file').prop('files')[0];*/
			var formData = new FormData();
			formData.append("insert_new_tree_photo","insert_new_tree_photo");
			formData.append("lat","52.286833647662");
			formData.append("lon","76.937184780836");
			formData.append("specie","Тополь черный");
			formData.append("age","12");
            formData.append("area","Сквер репрессивонных");
            formData.append("contractor","Зеленстрой");
			
			// добавляем в объект FormData файл 
			formData.append('file', file.prop('files')[0]);
			/*formData.append('file', file_data);*/

			$.ajax({
				url: '../php/requests.php',
				type: 'POST',
				data: formData,
				dataType: 'html',
	            processData: false,//обязательно при отправки с formData
	            contentType: false,//обязательно при отправки с formData
	         beforeSend : function (){
	         	$("#resultDiv").append('ЖДИ');
	         },
				success: function(data){
                    $("#resultDiv").html("");
					/*var res = $.parseJSON(data);*/
					if(data == "Произошла обшибка при загрузке файла на сервер"){
						
				   	$("#resultDiv").html("Произошла обшибка при загрузке файла на сервер.Заполните все поля.И картинку тоже");
					}else{
						
				   	$("#resultDiv").html(data);
				   	// $("#users_tbody").append(data);
                       
					}
				},
				error: function(data){
				    $("#resultDiv").html(data);
				}
			});
		// }
		
	});
});
</script>