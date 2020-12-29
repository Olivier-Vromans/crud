<?php
//making the connection db so you don't have to change every file only this one
function openCon() {
    $dbHost = "localhost"; //host of server
    $dbUser = "root"; //user
    $dbPass = ""; //password of user
    $db = "covid-db"; //name of database

    //connecting to the database's
    $conn = new mysqli($dbHost, $dbUser, $dbPass, $db) or die("Connect Failed; %s\n".
    $conn -> error);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
//    echo "Connected successfully" ."<br>";
    return $conn;
}
// closing connection to database
function closeCon($conn){
    $conn -> close();
}
?>