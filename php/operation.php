<?php
require_once ("db_connection.php");
require_once ("components.php");

$conn = openCon(); //making connection to the database

// Create button Click
if(isset($_POST['create'])){
    createData();
}

if(isset($_POST['update'])){
    updateData();
}

if(isset($_POST['delete'])){
    deleteRecord();
}

// Data from textbox in to db
function createData(){
    //making variables of the checked input
    $firstname = textboxValue("firstname");
    $lastname = textboxValue("lastname");
    $email = textboxValue("email");
    $phone = textboxValue("phone");
    $adress = textboxValue("adress");
    $zipcode = textboxValue("zipcode");
    $city = textboxValue("city");
    $state = textboxValue("state");
    $products = textboxValue("products");
    $date = textboxValue("date");
    $time = textboxValue("time");

    // variables in to the db
    if ($firstname&&$lastname&&$email&&$phone&&$adress&&$zipcode&&$city&&$state&&$products&&$date&&$time){
        $sql = "INSERT INTO contact(firstname, lastname, email, phone, adress, zipcode, city, state, products, date, time) 
        VALUES('$firstname', '$lastname', '$email', '$phone', '$adress', '$zipcode', '$city', '$state', '$products', '$date', '$time')";
        if(mysqli_query($GLOBALS['conn'], $sql)){
            TextNode("succes", "Afpraak is goed toegevoegd!");
        }else{
            echo "Error";
        }
    }else{
        TextNode("error", "Voer alle gegevens in");   }
}


//checking textbox value and mysql injections
function textboxValue($value){
    $textbox = mysqli_real_escape_string($GLOBALS['conn'], trim($_POST[$value]));
    if(empty($textbox)){
        return false;
    }else{
        return $textbox;
    }
}

//message
function TextNode($classname, $msg){
    $element = "<h6 class='$classname'>$msg</h6>";
    echo $element;
}

// get data from mysql database
function getData(){
    $sql = "SELECT * FROM contact";

    $result = mysqli_query($GLOBALS['conn'], $sql);

    if(mysqli_num_rows($result) > 0){
        return $result;
     }
}

//update data
function updateData(){
    $id = textboxValue("id");
    $firstname = textboxValue("firstname");
    $lastname = textboxValue("lastname");
    $email = textboxValue("email");
    $phone = textboxValue("phone");
    $tempadress = textboxValue("adress");
    $tempnumber = textboxValue("housenumber");
    $adress = $tempadress. " " . $tempnumber;
    $zipcode = textboxValue("zipcode");
    $city = textboxValue("city");
    $state = textboxValue("state");
    $products = textboxValue("products");
    $date = textboxValue("date");
    $time = textboxValue("time");

    if ($firstname&&$lastname&&$email&&$phone&&$adress&&$zipcode&&$city&&$state&&$products&&$date&&$time){
        $sql ="UPDATE contact SET id='$id', firstname='$firstname', lastname='$lastname', email='$email', phone='$phone', adress='$adress',  zipcode='$zipcode', city='$city', state='$state', products='$products', date='$date', time='$time'
               WHERE id=$id";
        if(mysqli_query($GLOBALS['conn'], $sql)) {
            TextNode("success", "Afspraak is toegevoegt");
        }else{
            TextNode("error", "Error: Afspraak is niet toegevoegt");
        }

    }else{
        TextNode("error", "Afspraak kon niet worden ingevoerd");
    }
}

function deleteRecord(){
    $id = (int)textboxValue("id");

    $sql = "DELETE FROM contact WHERE id=$id";
    if(mysqli_query($GLOBALS['conn'], $sql)){
        TextNode("success", "Record Deleted Successfully!");
    } else {
        TextNode("error", "Enable to Deleted Record!");
    }
}