<?php
	include_once "../db/dbConfig.php";


	//бүртгүүлэх
	if(isset($_POST['bnt-save'])){
	
		$c_name = $_POST['user_name'];
		$c_email = $_POST['email'];
		$c_password = $_POST['password'];
		
		$target = "insert into user(userName,email,user_password) values('$c_name','$c_email','$c_password')";
		$result = mysqli_quire($connect, $target);
		if($result){
			die('Error : Query Not Executed. Please Fix the Issue!  ' . mysql_error());
		}
		else{
            echo "Амжилттай!!!";
     }
	}
	if(isset($_POST['login'])){
		$user = $_POST['user'];
		$pass = $_POST['pass'];
		$sql="select * user where userName='".$user."' and user_password='".$pass."'"
	
	$result = mysqli_quire($connect, $target);
		if($result){
			die('Error : Query Not Executed. Please Fix the Issue!  ' . mysql_error());
		}
		else{
            echo "Амжилттай!!!";
     }
 }
?>