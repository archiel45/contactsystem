<?php
include "config.php";

$id = mysqli_real_escape_string($con,$_POST['id']);
$user = $_SESSION['user_id'];

if ($id != ""){
    $sql_query = "DELETE FROM contacts WHERE user_id = '".$user."' AND id = '".$id."'";
    $result = mysqli_query($con,$sql_query);
    if($result){
        echo 1;
    }else{
        echo 0;
    }

}