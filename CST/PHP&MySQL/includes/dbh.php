<?php //accessed through books.php.
    $dbServername = "localhost"; //will have to change on different server to absolute http path.
    $dbUsername = "root"; //will have to change on different server to last-name.
    $dbPassword = "";
    $dbName = "ctbookdatabase"; //my local database name.

    $connection = mysqli_connect($dbServername, $dbUsername, $dbPassword, $dbName);

/*
$dbServername = "localhost";  $dbUsername = "tharpe";
$dbPassword = "w#";  $dbName = "w#";  //other server.
https://ck.csit.selu.edu/pma //other server's phpMyAdmin.
phpMyAdmin pw1 user = cmps394, pw = Lion Up!;
phpMyAdmin pw2 user = tharpe, pw = w#;

http://ck.csit.selu.edu/~tharpe/mySql/books.html //connect to user interface.
*/