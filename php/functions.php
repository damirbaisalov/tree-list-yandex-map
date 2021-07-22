<?php
require_once "connect.php";
// session_start();

function getNamesCategory(){
    global $mysqli;
    connectDB();

    $result = $mysqli->query("SELECT * FROM `trees`");

    closeDB();

    return resultToArray($result);
}

// function getCategoryList(){
//     global $mysqli;
//     connectDB();

//     $result = $mysqli->query("SELECT * FROM `categories_sub` ORDER BY `id`");

//     closeDB();

//     return resultToArray($result);
// }


function resultToArray($result){
    $masspoint[] = array();

    while(($row = $result->fetch_assoc()) != false){
        // $array[] = $row;

        $lat = $row['lat'];
        $lon = $row['lon'];
        //echo $lat."</br>";
        //echo $lon."</br>";
        $point = $lat.",".$lon;
        $masspoint[] = $point;
    }

    return $masspoint;
}

// API
// if(isset($_POST["id_categories_sub"]))
//     showOraganization($_POST["id_categories_sub"]);

// function showOraganization($id_categories_sub){
//     global $mysqli;
//     connectDB();

//     $result = $mysqli->query("SELECT * FROM `services` WHERE `id_category_sub` = '$id_categories_sub'  ORDER BY `id`");

//     //$doma = $mysqli->query("SELECT * FROM `doma`");
//     $doma = $mysqli->query("SELECT * FROM `doma` ORDER BY `id` DESC LIMIT 70");
//     closeDB();

//     $organizatons = resultToArray($result);
//     $vse_doma = resultToArray($doma);
//     $massiv_dva = [$organizatons, $vse_doma];
//     echo json_encode($massiv_dva);
// }
?>