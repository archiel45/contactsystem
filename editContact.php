<?php
include "config.php";

$email = mysqli_real_escape_string($con,$_POST['email']);
$phone = mysqli_real_escape_string($con,$_POST['phone']);
$name = mysqli_real_escape_string($con,$_POST['name']);
$company = mysqli_real_escape_string($con,$_POST['company']);
$id = mysqli_real_escape_string($con,$_POST['id']);


if ($name != ""){
    
    $sql_query = "UPDATE contacts SET name='".$name."',phone='".$phone."',email='".$email."',company='".$company."' WHERE id='".$id."' AND user_id = '".$_SESSION['user_id']."' ";

    $result = mysqli_query($con,$sql_query);
    if($result){
        echo 1;
    }else{
        echo $sql_query;
    }

}