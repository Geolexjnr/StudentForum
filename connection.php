<?php
$host = "localhost";
$user = "root";
$password = "";
$database = "studentforum";

$connect = mysqli_connect($host, $user, $password, $database) or die("couldn't connect to server");
mysqli_select_db($connect,'studentforum') or die("couldn't connect to database");
?>