<?php

$login = "admin";
$pass = "nie_admin";

// ||--------------Pobranie Połączenia Z Bazą Danych--------------||

function GetConn(){
    $dbhost = 'localhost';
    $dbuser = 'root';
    $dbpass = '';
    $baza = 'stronka';

    $conn = new mysqli($dbhost, $dbuser, $dbpass, $baza);
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    return $conn;
}
    
?>