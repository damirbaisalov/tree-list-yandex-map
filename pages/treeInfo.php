<!doctype html>
<html lang="en">
<head>

<?php

session_start();
include('../php/connect.php');

// $target_dir = "uploads/";
// $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
// $uploadOk = 1;
// $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

// // Check if image file is a actual image or fake image
// if(isset($_POST["submit"])) {
//   $check = filesize($_FILES["fileToUpload"]["tmp_name"]);
//   if($check !== false) {
//     echo "File is an pdf/doc - " . $check["mime"] . ".";
//     $uploadOk = 1;
//   } else {
//     echo "File is not an pdf/doc.";
//     $uploadOk = 0;
//   }
// }

// // Check if file already exists
// if (file_exists($target_file)) {
//   echo "Sorry, file already exists.";
//   $uploadOk = 0;
// }

// // Check file size
// if ($_FILES["fileToUpload"]["size"] > 500000) {
//   echo "Sorry, your file is too large.";
//   $uploadOk = 0;
// }

// // Allow certain file formats
// if($imageFileType != "pdf" && $imageFileType != "doc" && $imageFileType != "docx"
// && $imageFileType != "gif" ) {
//   echo "Sorry, only PDF, DOC files are allowed.";
//   $uploadOk = 0;
// }

// // Check if $uploadOk is set to 0 by an error
// if ($uploadOk == 0) {
//   echo "Sorry, your file was not uploaded.";
// // if everything is ok, try to upload file
// } else {
//   if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
    
//     echo "The file ". htmlspecialchars( basename( $_FILES["fileToUpload"]["name"])). " has been uploaded.";
//   } else {
//     echo "Sorry, there was an error uploading your file.";
//   }
// }

?>



    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
	<!-- <script src="https://code.jquery.com/jquery-1.12.3.min.js" integrity="sha256-aaODHAgvwQW1bFOGXMeX+pC4PZIPsvn2h1sArYOhgXQ=" crossorigin="anonymous"></script> -->
	<script src="https://code.jquery.com/jquery-1.12.3.min.js" integrity="sha256-aaODHAgvwQW1bFOGXMeX+pC4PZIPsvn2h1sArYOhgXQ=" crossorigin="anonymous"></script>
	<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>

    <title>Паспорт дерева</title>
  </head>
  <body>    

  <div class="col-8 mt-3">
    <button class="btn btn-primary" id="back-home">Открыть карту</button>
  </div>
    <div class="d-flex justify-content-center mt-3">
        <div class="card text-black bg-light mb-3" style="max-width: 25rem; text-center">
       
            <div class="card-header text-center"><h5>Паспорт дерева</h5></div>
            <div class="card-body" id="tree-info-parent">
                <!-- <h5 class="card-title">Primary card title</h5> -->
            </div>
    
        </div>
    </div>

    <div class="d-flex justify-content-center mt-3">
      <input type="file" multiple="multiple" accept=".pdf,.doc,.txt,image/*">
      <a href="#" class="upload_files btn btn-success">Загрузить файлы</a>
      
  
    </div>

	<script src="https://api-maps.yandex.ru/2.1/?lang=ru_RU&amp;apikey=d811ec43-1783-4052-a752-a52f361f333d" type="text/javascript"></script>
	<!-- <script src="//code.jquery.com/jquery-1.11.2.min.js"></script> -->
	<script type="text/javascript">

    var files; // переменная. будет содержать данные файлов

    // заполняем переменную данными, при изменении значения поля file 
    $('input[type=file]').on('change', function(){
      files = this.files;
    });

    var queryString = location.search.substring(1);
    console.log(queryString);
    var convertedId = queryString.substring(3,queryString.length);
    console.log(convertedId);

    listTreeInfo(convertedId);   

    function listTreeInfo(id)
    {
            jQuery.ajax({
                type: 'POST',
                url: '../php/requests.php',
                data:{
                    'listTreesById' : 'listTreesById',
                    id: id
                },
                success: function(data){
                    console.log("Tree of park:");
                    tenantsList = JSON.parse(data);
                    console.log("Tree of park :"+ tenantsList);
                        $.each(tenantsList, function(key1){
                            $('#tree-info-parent').append(
                                '<p class="card-text">Id дерева: <span>'+tenantsList[key1].id+'<span></p>\
                                <p class="card-text">Название сквера: '+tenantsList[key1].areaName+'</p>\
                                <p class="card-text">Тип дерева: '+tenantsList[key1].property+'</p>\
                                <p class="card-text">Вид дерева: '+tenantsList[key1].specie+'</p>\
                                <p class="card-text">Возраст дерева: '+tenantsList[key1].age+'</p>\
                                <p class="card-text">Полив: '+tenantsList[key1].poliv+'</p>\
                                <p class="card-text">Жизненное состояние: '+tenantsList[key1].sostoyanie+'</p>\
                                <p class="card-text">Подрядчик: '+tenantsList[key1].contractor+'</p>'
                            );					
                        });
                }
            });
    }
     
    // обработка и отправка AJAX запроса при клике на кнопку upload_files
    $('.upload_files').on( 'click', function( event ){

      event.stopPropagation(); // остановка всех текущих JS событий
      event.preventDefault();  // остановка дефолтного события для текущего элемента - клик для <a> тега

      // ничего не делаем если files пустой
      if( typeof files == 'undefined' ) return;

      // создадим объект данных формы
      var data = new FormData();

      // заполняем объект данных файлами в подходящем для отправки формате
      $.each( files, function( key, value ){
        data.append( key, value );
      });

      // добавим переменную для идентификации запроса
      data.append( 'my_file_upload', 1 );

      // AJAX запрос
      $.ajax({
        url         : 'upload.php',
        type        : 'POST', // важно!
        data        : data,
        cache       : false,
        dataType    : 'json',
        // отключаем обработку передаваемых данных, пусть передаются как есть
        processData : false,
        // отключаем установку заголовка типа запроса. Так jQuery скажет серверу что это строковой запрос
        contentType : false, 
        // функция успешного ответа сервера
        success     : function( respond, status, jqXHR ){
          
          console.log(respond);
          alert("Файл успешно загружен");

          // ОК - файлы загружены
          if( typeof respond.error === 'undefined' ){
            // выведем пути загруженных файлов в блок '.ajax-reply'
            var files_path = respond.files;
            var html = '';
            $.each( files_path, function( key, val ){
              html += val +'<br>';
            } )

            // $('.ajax-reply').html( html );
          }
          // ошибка
          else {
            console.log('ОШИБКА: ' + respond.data );
          } 
        },
        // функция ошибки ответа сервера
        error: function( jqXHR, status, errorThrown ){
          console.log( 'ОШИБКА AJAX запроса: ' + status, jqXHR );
        }

      });

  });  

  $('#back-home').click(function() {
    window.location.replace("../Index.php");

  });


  // function download(){
  //         axios({
  //             url:'https://source.unsplash.com/random/500x500',
  //             method:'GET',
  //             responseType: 'blob'
  //     })
  //     .then((response) => {
  //            const url = window.URL
  //            .createObjectURL(new Blob([response.data]));
  //                   const link = document.createElement('a');
  //                   link.href = url;
  //                   link.setAttribute('download', 'image.jpg');
  //                   document.body.appendChild(link);
  //                   link.click();
  //     })
  // }

	</script>

	

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->


	<script src="https://code.jquery.com/jquery-1.12.3.min.js" integrity="sha256-aaODHAgvwQW1bFOGXMeX+pC4PZIPsvn2h1sArYOhgXQ=" crossorigin="anonymous"></script>

    <!-- <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script> -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
  </body>
</html>

