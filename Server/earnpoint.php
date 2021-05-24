<?php
	
	include('userDAO.php');
   
    $userID = $_POST["userID"];
    $userpoint = $_POST["userpoint"];
	
    $statement = mysqli_prepare($con, 'UPDATE user SET userpoint=? WHERE userID=?;');
    mysqli_stmt_bind_param($statement, 'is', $userpoint, $userID);
    mysqli_stmt_execute($statement);
	
    $response = array();

    $response["success"] = true;
    echo json_encode($response);
?>
