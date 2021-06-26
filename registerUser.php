<?php
include "config.php";

$email = mysqli_real_escape_string($con,$_POST['email']);
$password = mysqli_real_escape_string($con,$_POST['password']);
$name = mysqli_real_escape_string($con,$_POST['name']);

if ($email != "" && $password != "" && $name != ""){
    $password = md5($password);

    $find = "SELECT count(*) as cntUser FROM user WHERE email='".$email."'";
    $result = mysqli_query($con,$find);
    $count = 0;
    if($result){
        $row = mysqli_fetch_array($result);
        $count = $row['cntUser'];
    }
    
    if($count == 0){
        $sql_query = "INSERT INTO user (name, email, password) VALUES ('".$name."', '".$email."', '".$password."')";
        $result = mysqli_query($con,$sql_query);
        if($result){
            $last_id = $con->insert_id;
            $_SESSION['user_id'] = $last_id;
            echo 1;
        }else{
            echo 0;
        }
    }else{
        echo 2;
    }

}