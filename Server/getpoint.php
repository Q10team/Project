<?php
	
	include('userDAO.php');
   
    $ID = $_POST["ID"];
	
    $statement = mysqli_prepare($con, 'SELECT userPoint FROM user WHERE userID = ?');
    mysqli_stmt_bind_param($statement, 's', $ID);
    mysqli_stmt_execute($statement);
	
    mysqli_stmt_store_result($statement);
    mysqli_stmt_bind_result($statement, $point);
 
    $response = array();
    $response["success"] = false;
	$response["point"] = null;
 
    while(mysqli_stmt_fetch($statement)) {
        $response["success"] = true;
		$response["point"] = $point;
    }
	
    echo json_encode($response);
?>
