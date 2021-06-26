<?php
include "config.php";

$user = $_SESSION['user_id'];

if ($id != ""){
    $sql_query = "SELECT count(*) as total from contacts WHERE user_id ='".$id."'";
    $result = mysqli_query($con,$sql_query);
    if($result){
        $data= mysqli_fetch_assoc($result);
        echo $data['total'];
    }else{
        echo 0;
    }

}