<?php
    session_start();
    include('connect.php');

    $id = $_POST['id'];
    $poliv_data = $_POST['poliv'];
    $massiv = Array();

    $sqlTree = "UPDATE trees SET poliv='$poliv_data' WHERE id = '$id'";


    // $result = mysql_query($sqlDomksk) or die (mysql_error());
    $result = mysqli_query($link, $sqlTree);
    while ($row = mysqli_fetch_assoc($result)){
        $massiv[] = $row;
    }


    // echo json_encode($massiv);
    echo json_encode($massiv);
?>
