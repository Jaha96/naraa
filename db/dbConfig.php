<?php

$connect = mysql_connect("localhost","root","") or die('Database Not Connected. Please Fix the Issue! ' . mysql_error());
mysql_select_db("onlinebookstore", $connect);


$servername = "localhost";
$username = "root";
$password = "";
$dbname = "onlinebookstore";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 

?>