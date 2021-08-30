<?php
   session_start();
   unset($_SESSION["username"]);
   
   echo 'Сессия пустая';
   header('Refresh: 2; URL = login.php');
?>