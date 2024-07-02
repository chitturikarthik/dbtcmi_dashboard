<?php


    // $servername="localhost";
    // $username="root";
    // $password="dbtcmi@123";
    // $databasename="DBT_CMI_TEST1";
    $servername = "localhost";
    $username = "root";
    $password = "";
    $databasename = "dbt_cmi";
    
    // $servername = "sql303.infinityfree.com";
    // $username = "if0_36383848";
    // $password = "wSquS4iRXCUSn";
    // $databasename = "if0_36383848_dbtcmi";

    $conn = mysqli_connect($servername,$username,$password,$databasename);

    if ($conn) {
//    echo "connect successful";
    }
    else {
    echo "Not Connected";   
    }


?>
