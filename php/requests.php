<?php
    session_start();
    include('connect.php');
    $successInfo = "success";
    $errorInfo = "error occurred!";

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
?>
