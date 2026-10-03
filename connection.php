<?php 

$host= "localhost";
$username= "root";
$password= "";
$database = "library_management_system";
$port = 3307;
$connection = mysqli_connect($host,$username,$password,$database, $port) 
or die("failed to connect");
// echo "connection success";
?>