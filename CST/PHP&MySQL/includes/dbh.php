<?php 
    $dbServername = "localhost"; //will have to change on different server to absolute http path most likely TODO
    $dbUsername = "root"; //will have to change on different server to w# most likely TODO
    $dbPassword = "";
    $dbName = "ctbookdatabase"; //my local database name.

    $conn = mysqli_connect($dbServername, $dbUsername, $dbPassword, $dbName);