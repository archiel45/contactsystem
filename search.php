<?php
include "config.php";

$keyword = mysqli_real_escape_string($con,$_POST['key']);

if ($keyword != ''){
    $keyword = strtolower($keyword);
    $sql_query = "SELECT *  FROM contacts WHERE LOWER(email) LIKE '".$keyword."' OR LOWER(phone) LIKE '".$keyword."' OR LOWER(name) LIKE '".$keyword."' OR LOWER(company) LIKE '".$keyword."'" ;
    $result = mysqli_query($con,$sql_query);
    $row = mysqli_fetch_array($result);
    if($row['id'] != null){
        $_SESSION['user_id'] = $row['id'];
        echo 1;
    }else{
        echo 0;
    }

    // $count = $row['id'];

    // if($count > 0){
    //     $_SESSION['email'] = $email;
    //     echo 1;
    // }else{
    //     echo 0;
    // }

}