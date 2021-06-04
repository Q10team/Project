<?php
	
	include('dbcon.php');
   
    $ID = $_POST["userID"];
	
    $statement = mysqli_prepare($con, 'SELECT * FROM friend WHERE sender = ?');
    mysqli_stmt_bind_param($statement, 's', $ID);
    mysqli_stmt_execute($statement);
	
    mysqli_stmt_store_result($statement);
    mysqli_stmt_bind_result($statement, $send, $recieve);
 
    $response = array();
    $total_response = array();
 
    while(mysqli_stmt_fetch($statement)) {
	    $response['friendID'] = $recieve;
        $total_response[] = $response;
    }
	
    echo json_encode($total_response);
?>
