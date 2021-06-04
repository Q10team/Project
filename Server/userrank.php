<?php
	
	include('dbcon.php');
   	
    $statement = mysqli_prepare($con, 'SELECT userName, userPoint FROM user');
    mysqli_stmt_execute($statement);
	
    mysqli_stmt_store_result($statement);
    mysqli_stmt_bind_result($statement, $userName, $userPoint);
 

    $response = array();
    $total_response = array();

    while(mysqli_stmt_fetch($statement)) {
        $response['name'] = $userName;
        $response['point'] = $userPoint;
        $total_response[] = $response;
    }
	
    echo json_encode($total_response);
?>
