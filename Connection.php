<?php 
                      //make connection to mysql server
$host = "localhost";
$user = "root";
$pass = "";
$db = "travelling";
$conn = new mysqli($host, $user, $pass,$db);//returns an object represent the connection to mysql server
if($conn->connect_error)//if connection is failed
{
  echo "failed to connect DB". $conn->connect_error;
}                                                   
?>

