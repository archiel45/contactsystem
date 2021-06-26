<?php
include "config.php";

$email = mysqli_real_escape_string($con,$_POST['email']);
$password = mysqli_real_escape_string($con,$_POST['password']);


if ($email   != "" && $password != ""){
    $password = md5($password);
    $sql_query = "SELECT id FROM user WHERE email='".$email."' and password='".$password."' LIMIT 1";
    $result = mysqli_query($con,$sql_query);
    if($result){
        $row = mysqli_fetch_array($result);
        $_SESSION['user_id'] = $row['id'];
        echo 1;
    }else{
        echo 0;
    }

}