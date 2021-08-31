<?php
    session_start();
    include('connect.php');
    $successInfo = "success";
    $errorInfo = "error occurred!";

    if(isset($_POST['getAllTrees'])){
        $massiv = Array();

        $sqlTree = "SELECT * FROM trees WHERE `status`=0'";
        // $result = mysql_query($sqlDomksk) or die (mysql_error());
        $result = mysqli_query($link, $sqlTree);
        while ($row = mysqli_fetch_assoc($result)){
            $massiv[] = $row;
        }

        // echo json_encode($massiv);
        echo json_encode($massiv);
    } 

    if(isset($_POST['listTreesById'])){
        $id = $_POST['id'];
        $massiv = Array();

        $sqlTree = "SELECT * FROM trees WHERE id = '$id'";
        // $result = mysql_query($sqlDomksk) or die (mysql_error());
        $result = mysqli_query($link, $sqlTree);
        while ($row = mysqli_fetch_assoc($result)){
            $massiv[] = $row;
        }

        // echo json_encode($massiv);
        echo json_encode($massiv);
    } 

    //filter species by area
    if(isset($_POST["get_species_selected_area"])){
        $area = $_POST["area"];
        
        $sqlTree = "SELECT DISTINCT `specie` FROM `trees` WHERE `areaName` ='$area' AND `status` = 0";

        $massiv = array();
        $result = mysqli_query($link, $sqlTree);
        while ($row = mysqli_fetch_assoc($result)){
            $massiv[] = $row;
        }

        echo json_encode($massiv);
    }

     //filter species by area
     if(isset($_POST["get_count_species_selected_area"])){
        $area = $_POST["area"];
        $specie = $_POST["specie"];

        $sqlTree = "SELECT COUNT(*) as specieCount FROM `trees` WHERE `areaName`='$area' and `specie`='$specie' AND `status`=0";

        $massiv = array();
        $result = mysqli_query($link, $sqlTree);
        while ($row = mysqli_fetch_assoc($result)){
            $massiv[] = $row;
        }

        echo json_encode($massiv);
    }


    //filter trees by area
    if(isset($_POST["onlyArea"])){
        $area = $_POST["area"];
        
        $sqlTree = "SELECT * FROM `trees` WHERE `areaName` ='$area' AND `status` = 0";

        $massiv = array();
        $result = mysqli_query($link, $sqlTree);
        while ($row = mysqli_fetch_assoc($result)){
            $massiv[] = $row;
        }

        echo json_encode($massiv);
    }

    //filter trees by specie
    if(isset($_POST["onlySpecie"])){
        $specie = $_POST["specie"];
        
        $sqlTree = "SELECT * FROM trees WHERE specie ='$specie' AND `status`= 0";

        $massiv = array();
        $result = mysqli_query($link, $sqlTree);
        while ($row = mysqli_fetch_assoc($result)){
            $massiv[] = $row;
        }

        echo json_encode($massiv);
    }

    //filter trees by specie && area
    if(isset($_POST["withSpecie"]) && isset($_POST["withArea"])){
        $specie = $_POST["specie"];
        $area = $_POST["area"];
        
        $sqlTree = "SELECT * FROM `trees` WHERE `specie`='$specie' AND `areaName`='$area' AND `status`=0";

        $massiv = array();
        $result = mysqli_query($link, $sqlTree);
        while ($row = mysqli_fetch_assoc($result)){
            $massiv[] = $row;
        }

        echo json_encode($massiv);
    } 

    //inserting new trees
    if (isset($_POST["insert_tree"])) {
        $lon = $_POST["lon"];
        $lat = $_POST["lat"];
        $area = $_POST["area"];
        $contractor = $_POST["contractor"];
        $property = $_POST["property"];
        $specie = $_POST["specie"];
        
        $sqlTree = "INSERT INTO `trees` (`point`,`lon`, `lat`, `specie`, `contractor`, `property`, `areaName`, `dateCreate`, `poliv`, `age`, `grade`, `type`) 
                    VALUES ('','$lon','$lat','$specie','$contractor','$property','$area', '2021-07-28', '', '', '', 0)";

        if (mysqli_query($link, $sqlTree)) {
            echo json_encode($successInfo);
          } else {
            echo json_encode($errorInfo);
        }          
    }

    //updating the tree that was chopped
    if (isset($_POST["update_tree"])) {
        $id = $_POST["id"];

        $sqlTree = "UPDATE `trees` SET `status`=1 WHERE `id` = '$id'";

        if (mysqli_query($link, $sqlTree)) {
            echo json_encode($successInfo);
        } else {
            echo json_encode($errorInfo);
        }
    }

     //inserting new trees
     if (isset($_POST["insert_new_tree"])) {
        $lon = $_POST["lon"];
        $lat = $_POST["lat"];
        $specie = $_POST["specie"];
        $age = $_POST["age"];
        $area = $_POST["area"];
        $contractor = $_POST["contractor"];
     
        $sqlTree = "INSERT INTO `trees` (`point`,`lon`, `lat`, `specie`, `contractor`, `property`, `areaName`, `dateCreate`, `poliv`, `age`, `grade`, `type`) 
                    VALUES ('','$lon','$lat','$specie','$contractor','Государственный','$area', '2021-07-28', '', '$age', '', 0)";

        if (mysqli_query($link, $sqlTree)) {
            echo json_encode($successInfo);
          } else {
            echo json_encode($errorInfo);
        }          
    }

    //distinct areas
    if(isset($_POST["distinct_area"])){    
        $sqlTree = "SELECT DISTINCT `areaName` FROM `trees`";

        $massiv = array();
        $result = mysqli_query($link, $sqlTree);
        while ($row = mysqli_fetch_assoc($result)){
            $massiv[] = $row;
        }

        echo json_encode($massiv);
        
    }

    //distinct species
    if(isset($_POST["distinct_specie"])){    
        $sqlTree = "SELECT DISTINCT `specie` FROM `trees`";

        $massiv = array();
        $result = mysqli_query($link, $sqlTree);
        while ($row = mysqli_fetch_assoc($result)){
            $massiv[] = $row;
        }

        echo json_encode($massiv);
        mysqli_close($link);
    }

     //distinct contractor
     if(isset($_POST["distinct_contractor"])){    
        $sqlTree = "SELECT DISTINCT `contractor` FROM `trees`";

        $massiv = array();
        $result = mysqli_query($link, $sqlTree);
        while ($row = mysqli_fetch_assoc($result)){
            $massiv[] = $row;
        }

        echo json_encode($massiv);
        
    }

//     //insert new tree with photo
//     if(isset($_POST["insert_new_tree_photo"])){
	
//         $lon = $_POST["lon"];
//         $lat = $_POST["lat"];
//         $specie = $_POST["specie"];
//         $age = $_POST["age"];
//         $area = $_POST["area"];
//         $contractor = $_POST["contractor"];
//         $path = "";
        
// 		// переменная для хранения результата
//         $data = 'Файл не был успешно загружен на сервер';
//         // путь для загрузки файлов
//         $upload_path = dirname(__FILE__) . '/uploads/';
//         // если файл был успешно загружен, то
//         if ($_FILES['file']['error'] == UPLOAD_ERR_OK) {
//           // получаем расширение исходного файла
//           $extension_file = mb_strtolower(pathinfo($_FILES['file']['name'], PATHINFO_EXTENSION));
//           // получаем уникальное имя под которым будет сохранён файл 
//           $full_unique_name = $upload_path . uniqid('file_', true).'.'.$extension_file;
//           // перемещает файл из временного хранилища в указанную директорию
//           if (move_uploaded_file($_FILES['file']['tmp_name'], $full_unique_name)) {
//             // записываем в переменную $result ответ
// /*            $data = 'Файл загружен и доступен по адресу: <b>/' . substr($full_unique_name, strlen($_SERVER['DOCUMENT_ROOT'])+1) . '</b>';
// */            
//             $path  = 'https://15000pvl.kz/' . substr($full_unique_name, strlen($_SERVER['DOCUMENT_ROOT'])+1);
//           } else {
//             // записываем в переменную $result сообщение о том, что произошла ошибка
//             $data = "Произошла обшибка при загрузке файла на сервер";
//           }
//         }
		
// 		$sqlTree = "INSERT INTO `trees` (`point`,`lon`, `lat`, `specie`, `contractor`, `property`, `areaName`, `dateCreate`, `poliv`, `age`, `grade`, `type`, `path`) 
//         VALUES ('','$lon','$lat','$specie','$contractor','Государственный','$area', '2021-07-28', '', '$age', '', 0, '$path')";

//         $result = mysqli_query($link, $sqlTree);
// 		// $mysqli->close();
//         if ($result) {
//             $data = "Файл успешно загружен";
//         }
// 		echo $data;
// 		/*echo $data;*/
//     } 

?>
