<?php

session_start();
$base64 = null;
include_once "../db/dbConfig.php";

//бүртгүүлэх
if(isset($_POST['datatype']) && $_POST['datatype']=='data'){
    $obj = $_POST;

    $name = $obj['name'];
    $category = $obj['category'];
    $author = $obj['author'];
    $quantity = $obj['quantity'];
    $price = $obj['price'];
    $description = $obj['description'];
    if(isset($_SESSION["image"])){
        $image = $_SESSION["image"];
        $_SESSION["image"]="";
    }else{
        $image = " ";
    }
    
    $sql  = "INSERT INTO book(name, categoryId, author, quantity, price, description, image) VALUES('$name', $category, '$author', $quantity, $price, '$description', '$image')";
    
    if ($conn->query($sql ) === TRUE) {
        echo "New record created successfully".$name;
    } else {
        echo "Error: " . $sql  . "<br>" . $conn->error;
    }
}else{
    if(isset($_POST) == true && isset($_FILES["file"]["name"])){
        //generate unique file name
        $fileName = time().'_'.basename($_FILES["file"]["name"]);
        
        //file upload path
        $targetDir = "../uploads/";
        $targetFilePath = $targetDir . $fileName;
        
        //allow certain file formats
        $fileType = pathinfo($targetFilePath,PATHINFO_EXTENSION);
        $allowTypes = array('jpg','png','jpeg','gif');
        
        if(in_array($fileType, $allowTypes)){
            //upload file to server
            if(move_uploaded_file($_FILES["file"]["tmp_name"], $targetFilePath)){
                // $data = file_get_contents($targetFilePath);
                // $base64 = 'data:image/' . $fileType . ';base64,' . base64_encode($data);

                $_SESSION["image"] = $targetFilePath;
                $response['status'] = 'ok';
            }else{
                $response['status'] = 'err';
            }
        }else{
            $response['status'] = 'type_err';
        }
        echo json_encode($response);
    }
}

	if(isset($_GET['type'])){
		switch ($_GET['type']) {
			case 'getAllBooks':
			    $sql = "SELECT * FROM book";
				$result = $conn->query($sql);

				if ($result->num_rows > 0) {
				    // output data of each row
				    while($row = $result->fetch_assoc()) {
				        $new_array[] = $row;
				    }
				    echo json_encode($new_array);
				} else {
				    echo "0 results";
				}
                # code...
                break;

            case 'getCategories':
                $sql = "SELECT * FROM category";
                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                    // output data of each row
                    while($row = $result->fetch_assoc()) {
                        $new_array[] = $row;
                    }
                    echo json_encode($new_array);
                } else {
                    echo "0 results";
                }
                break;

			case 'ereltbooks':
                $sql = "SELECT * FROM book";
                if(isset($_GET['category']) && $_GET['category'] !=0){
                    $sql = $sql." where categoryId =".$_GET['category'];
                }
                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                    while($row = $result->fetch_assoc()) {
                        $new_array[] = $row;
                    }
                    echo json_encode($new_array);
                } else {
                    echo "0";
                }
                
				break;
            case 'adminbooklist':
                $sql = "SELECT * FROM book";
                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                    while($row = $result->fetch_assoc()) {
                        $new_array[] = $row;
                    }
                    echo json_encode($new_array);
                } else {
                    echo "0";
                }
            break;
			default:
				break;
		}
		$conn->close();
	}
?>