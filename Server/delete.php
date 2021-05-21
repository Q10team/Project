<?php
	
	include('todolistDAO.php');
	
    $listID = $_POST["listID"];
	
    $statement = mysqli_prepare($con, 'DELETE FROM todolist WHERE listID=?;');
    mysqli_stmt_bind_param($statement, 'i', $listID);
    mysqli_stmt_execute($statement);
    
    $response = array();

    $response["success"] = true;
    echo json_encode($response);
?>
