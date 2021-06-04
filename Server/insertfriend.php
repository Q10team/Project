<?php
	
	include('dbcon.php');
	
    $sendID = $_POST["sendID"];
    $recieveID = $_POST["recieveID"];

    $response = array();

    $statement = mysqli_prepare($con, 'SELECT userID FROM user WHERE userID = ?');
    mysqli_stmt_bind_param($statement, 's', $recieveID);
    mysqli_stmt_execute($statement);
        
    mysqli_stmt_store_result($statement);
    mysqli_stmt_bind_result($statement, $userID);

    $response["success"] = false;
     
    while(mysqli_stmt_fetch($statement)) {
        $statement = mysqli_prepare($con, 'INSERT INTO friend(sender, reciever) VALUES(?, ?);');
        mysqli_stmt_bind_param($statement, 'ss', $sendID, $recieveID);
        mysqli_stmt_execute($statement);
                
        $response["success"] = true;
    }

    echo json_encode($response);
?>
