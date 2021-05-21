<?php
	
	include('todolistDAO.php');
	
    $userID = $_POST["userID"];
    $title = $_POST["title"];
    $content = $_POST["content"];
    $importance = $_POST["importance"];
    $processHours = $_POST["processHours"];
    $uploadDate = $_POST["uploadDate"];
	
    $statement = mysqli_prepare($con, 'INSERT INTO todolist(userID, title, content, importance, processHours, uploadDate) VALUES(?, ?, ?, ?, ?, ?);');
    mysqli_stmt_bind_param($statement, 'sssiis', $userID, $title, $content, $importance, $processHours, $uploadDate);
    mysqli_stmt_execute($statement);
	
    $response = array();

    $response["success"] = true;
    echo json_encode($response);
?>
?>
