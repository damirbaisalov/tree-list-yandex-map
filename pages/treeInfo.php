<!doctype html>
<html lang="en">
<head>

<?php

session_start();
include('php/connect.php');

$target_dir = "uploads/";
$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
$uploadOk = 1;
$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

// Check if image file is a actual image or fake image
if(isset($_POST["submit"])) {
  $check = filesize($_FILES["fileToUpload"]["tmp_name"]);
  if($check !== false) {
    // echo "File is an pdf/doc - " . $check["mime"] . ".";
    $uploadOk = 1;
  } else {
    // echo "File is not an pdf/doc.";
    $uploadOk = 0;
  }
}

// Check if file already exists
if (file_exists($target_file)) {
//   echo "Sorry, file already exists.";
  $uploadOk = 0;
}

// Check file size
if ($_FILES["fileToUpload"]["size"] > 500000) {
//   echo "Sorry, your file is too large.";
  $uploadOk = 0;
}

// Allow certain file formats
if($imageFileType != "pdf" && $imageFileType != "doc" && $imageFileType != "docx"
&& $imageFileType != "gif" ) {
//   echo "Sorry, only PDF, DOC files are allowed.";
  $uploadOk = 0;
}

// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
//   echo "Sorry, your file was not uploaded.";
// if everything is ok, try to upload file
} else {
  if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
    // echo "The file ". htmlspecialchars( basename( $_FILES["fileToUpload"]["name"])). " has been uploaded.";
  } else {
    // echo "Sorry, there was an error uploading your file.";
  }
}

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


    <div class="d-flex justify-content-center mt-3">
        <div class="card text-black bg-light mb-3" style="max-width: 25rem; text-center">
        <form action="treeInfo.php" method="post" enctype="multipart/form-data">
            <div class="card-header text-center"><h5>Паспорт дерева</h5></div>
            <div class="card-body" id="tree-info-parent">
                <!-- <h5 class="card-title">Primary card title</h5> -->
            </div>
        </form>
        </div>
    </div>

    <!-- <div id="tree-info-parent" class="col-8 card-body"> -->



    </div>

	<script src="https://api-maps.yandex.ru/2.1/?lang=ru_RU&amp;apikey=d811ec43-1783-4052-a752-a52f361f333d" type="text/javascript"></script>
	<!-- <script src="//code.jquery.com/jquery-1.11.2.min.js"></script> -->
	<script type="text/javascript">
    
    var queryString = location.search.substring(1);
    console.log(queryString);

    listTreeInfo(queryString);   

    function listTreeInfo(id)
        {
            jQuery.ajax({
                type: 'POST',
                url: '../php/requests.php',
                data:{
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
                                <p class="card-text">Подрядчик: '+tenantsList[key1].contractor+'</p>\
                                <p class="card-text"><input type="file" name="fileToUpload" id="fileToUpload"></p>\
                                <p class="card-text text-center"><input type="submit" value="Отправить файл" name="submit" class="btn btn-success"></p>'
                            );					
                        });

                }
            });
        }


	
    

	</script>

	

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->


	<script src="https://code.jquery.com/jquery-1.12.3.min.js" integrity="sha256-aaODHAgvwQW1bFOGXMeX+pC4PZIPsvn2h1sArYOhgXQ=" crossorigin="anonymous"></script>

    <!-- <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script> -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
  </body>
</html>

