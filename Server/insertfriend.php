<?php
	
	include('dbcon.php');
	
    $sendID = $_POST["sendID"];
    $recieveName = $_POST["recieveID"];
	
    $statement = mysqli_prepare($con, 'INSERT INTO friend(sender, reciever) VALUES(?, ?);');
    mysqli_stmt_bind_param($statement, 'ss', $sendID, $recieveName);
    mysqli_stmt_execute($statement);
	
    $response = array();

    $response["success"] = true;
    echo json_encode($response);
?>
?>
