<?php
	
	include('dbcon.php');
   
    $ID = $_POST["userID"];
    $ID = 'user2';
	
    $statement = mysqli_prepare($con, 'SELECT reciever FROM friend WHERE sender = ?');
    mysqli_stmt_bind_param($statement, 's', $ID);
    mysqli_stmt_execute($statement);

    mysqli_stmt_store_result($statement);
    mysqli_stmt_bind_result($statement, $userID);


    $f_response = array();

    $response = array();
    $total_response = array();



    while(mysqli_stmt_fetch($statement)){
        $statement2 = mysqli_prepare($con, 'SELECT userName, userPoint FROM user WHERE userID = ?');
        mysqli_stmt_bind_param($statement2, 's', $userID);
        mysqli_stmt_execute($statement2);
        mysqli_stmt_store_result($statement2);
        mysqli_stmt_bind_result($statement2, $userName, $userPoint);

        while(mysqli_stmt_fetch($statement2)){
            $response['name'] = $userName;
            $response['point'] = $userPoint;
            $total_response[] = $response;
        }        
        
    }
    
    foreach($f_response as $item){
        
    }

    echo json_encode($total_response);
?>
