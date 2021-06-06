<?php
	
	include('dbcon.php');
	
    $sendID = $_POST["sendID"];
    $recieveID = $_POST["recieveID"];

    $statement = mysqli_prepare($con, 'SELECT userID FROM user WHERE userID = ?');
    mysqli_stmt_bind_param($statement, 's', $recieveID);
    mysqli_stmt_execute($statement);
        
    mysqli_stmt_store_result($statement);
    mysqli_stmt_bind_result($statement, $userID);

    $response = array();

     
    if(mysqli_stmt_fetch($statement)) {
        $tempstatement = mysqli_prepare($con, 'SELECT * FROM friend WHERE sender = ? AND reciever = ?');
        mysqli_stmt_bind_param($tempstatement, 'ss', $sendID, $recieveID);
        mysqli_stmt_execute($tempstatement);

        mysqli_stmt_store_result($tempstatement);
        mysqli_stmt_bind_result($tempstatement, $sender, $reciever);

        if(mysqli_stmt_fetch($tempstatement)) {
            $response["success"] = 2;
        }
        else {
            $statement = mysqli_prepare($con, 'INSERT INTO friend(sender, reciever) VALUES(?, ?);');
            mysqli_stmt_bind_param($statement, 'ss', $sendID, $recieveID);
            mysqli_stmt_execute($statement);
                    
            $response["success"] = 1;
        }
    }
    else{
        $response["success"] = 3;
    }

    echo json_encode($response);
?>
