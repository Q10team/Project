<?php
	
	include('userDAO.php');
	
	$userID = $_POST["userID"];
	
	$statement = mysqli_prepare($con, 'SELECT userPW, userName, userEmail, userAvata FROM user WHERE userID = ?');
    mysqli_stmt_bind_param($statement, 's', $userID);
    mysqli_stmt_execute($statement);
	
    mysqli_stmt_store_result($statement);
    mysqli_stmt_bind_result($statement, $PW, $Name, $Email, $Avata);
 
    $response = array();
    $response["success"] = false;
	$response["userPW"] = null;
	$response["userName"] = null;
	$response["userEmail"] = null;
	$response["userAvata"] = null;
	
    while(mysqli_stmt_fetch($statement)) {
        $response["success"] = true;
		$response["userPW"] = $PW;
		$response["userName"] = $Name;
		$response["userEmail"] = $Email;
		$response["userAvata"] = $Avata;
    }
	
    echo json_encode($response);
?>
