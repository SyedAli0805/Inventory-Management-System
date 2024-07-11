<?php 
session_start();

unset($_SESSION['login']);
session_destroy();
sleep(2);
header("Location: login.php");
exit();
?>