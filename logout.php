<?php 


// Destroy session
unset($_SESSION['user_id']);
session_unset();
session_destroy();

header('Location: index.php');
