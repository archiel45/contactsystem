<?php
include "config.php";

$page = mysqli_real_escape_string($con,$_POST['page']);
$id = $_SESSION['user_id'];
$page = $page == ''? 0: $page;
$sql_query = "SELECT * FROM contacts WHERE user_id='".$id."' LIMIT 10 OFFSET ".$page."";
$result = mysqli_query($con,$sql_query);
if($result){
    $row = mysqli_fetch_all($result);
    if($row){
       echo json_encode($row);
    }else{
        echo 0;
    }
}else{
    echo 0;
}
