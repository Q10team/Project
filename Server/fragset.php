<?php
	
	include('userDAO.php');
	
	$userID = $_POST["userID"];
    $Avata = $_POST["Avata"];
    $PW = $_POST["PW"];
    $Name = $_POST["Name"];
    $Email = $_POST["Email"];
	
    $statement = mysqli_prepare($con, 'UPDATE user SET userPW=?, userName=?, userEmail=?, userAvata=? WHERE userID=?;');
    mysqli_stmt_bind_param($statement, 'sssis', $PW, $Name, $Email, $Avata, $userID);
    mysqli_stmt_execute($statement);
	
    $response = array();

    $response["success"] = true;
    echo json_encode($response);
?>
