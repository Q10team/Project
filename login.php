<?php
	
	include('userDAO.php');
	
	$ID = $_POST["ID"];
    $PW = $_POST["PW"];
   
	
    $statement = mysqli_prepare($con, 'SELECT * FROM user WHERE userID = ? AND userPW = ?');
    mysqli_stmt_bind_param($statement, 'ss', $ID, $PW);
    mysqli_stmt_execute($statement);
	
    mysqli_stmt_store_result($statement);
    mysqli_stmt_bind_result($statement, $ID, $PW, $Name, $Age);
 
    $response = array();
    $response["success"] = false;
	$response["Name"] = null;
 
    while(mysqli_stmt_fetch($statement)) {
        $response["success"] = true;
		$response["Name"] = $Name;
    }
	
    echo json_encode($response);
?>
