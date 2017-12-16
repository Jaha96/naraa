<?php
	include_once "../db/dbConfig.php";


	//бүртгүүлэх
	if(isset($_POST['action'])){
		
	}

		$obj = $_POST;

		print_r($obj);

		$firstName = $obj['firstName'];
		$lastName = $obj['lastName'];
		$userName = $obj['userName'];
		$email = $obj['email'];


		$query = "INSERT INTO user(firstName, lastName, userName, email)
    				VALUES('$firstName', '$lastName', '$userName', '$email')";

	if(!mysql_query($query,$connect))
    {
        die('Error : Query Not Executed. Please Fix the Issue!  ' . mysql_error());
    }
     else{
            echo "Ажилттай!!!";
     }
?>