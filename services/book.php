<?php
    include_once "../db/dbConfig.php";
    session_start();
    $base64 = null;

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
        if(isset($_POST) == true){
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
?>