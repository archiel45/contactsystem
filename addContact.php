<?php
include "config.php";

$email = mysqli_real_escape_string($con,$_POST['email']);
$phone = mysqli_real_escape_string($con,$_POST['phone']);
$name = mysqli_real_escape_string($con,$_POST['name']);
$company = mysqli_real_escape_string($con,$_POST['company']);
$user = $_SESSION['user_id'];

if ($name != ""){
    $sql_query = "INSERT INTO contacts (name, phone, email, company, user_id) VALUES ('".$name."', '".$phone."', '".$email."','".$company."','".$user."')";
    $result = mysqli_query($con,$sql_query);
    if($result){
        echo 1;
    }else{
        echo 0;
    }

}