<?php
	
	include('dbcon.php');
   
    $ID = $_POST["userID"];
	
    $statement = mysqli_prepare($con, 'SELECT userName, userPoint FROM user WHERE userID = ?');
    mysqli_stmt_bind_param($statement, 's', $tempresponse['userID']);
    mysqli_stmt_execute($statement);
	
    mysqli_stmt_store_result($statement);
    mysqli_stmt_bind_result($statement, $userID, $userPoint);
 

    $response = array();
    $total_response = array();

    while(mysqli_stmt_fetch($statement)) {
        $response['name'] = $userID;
        $response['point'] = $userPoint;
        $total_response[] = $response;
    }
	
    echo json_encode($total_response);
?>