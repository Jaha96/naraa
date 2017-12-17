<?php
	

	include_once "../db/dbConfig.php";
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
			
			default:
				# code...
				break;
		}
		$conn->close();
	}
?>