<?php
    session_start();
    include('connect.php');

    if(isset($_POST['id'])){
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
    } else
    //filter trees by area
    if(isset($_POST["area"])){
        $area = $_POST["area"];
        
        $sqlTree = "SELECT * FROM trees WHERE areaName ='$area'";

        $massiv = array();
        $result = mysqli_query($link, $sqlTree);
        while ($row = mysqli_fetch_assoc($result)){
            $massiv[] = $row;
        }

        echo json_encode($massiv);
    } else

    //filter trees by specie
    if(isset($_POST["specie"])){
        $specie = $_POST["specie"];
        
        $sqlTree = "SELECT * FROM trees WHERE specie ='$specie'";

        $massiv = array();
        $result = mysqli_query($link, $sqlTree);
        while ($row = mysqli_fetch_assoc($result)){
            $massiv[] = $row;
        }

        echo json_encode($massiv);
    } else

    //filter trees by specie && area
    if(isset($_POST["specie"]) && isset($_POST["area"])){
        $specie = $_POST["specie"];
        $area = $_POST["area"];
        
        $sqlTree = "SELECT * FROM trees WHERE specie='$specie' AND areaName='$area'";

        $massiv = array();
        $result = mysqli_query($link, $sqlTree);
        while ($row = mysqli_fetch_assoc($result)){
            $massiv[] = $row;
        }

        echo json_encode($massiv);
    }
?>
