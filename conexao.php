<?php

    $host = "localhost";
    $user = "root";
    $pass = "";
    $bd = "atp";

    $mysqli = new mysqli($host, $user, $pass, $bd);

    if(mysqli_connect_error()){
        echo"connect failed:" . $mysqli->connect_error;
        exit();
    }
    
?>