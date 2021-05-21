<?php
	
	include('todolistDAO.php');
	
    $listID = $_POST["listID"];
    $title = $_POST["title"];
    $content = $_POST["content"];
    $importance = $_POST["importance"];
    $processHours = $_POST["processHours"];
    $uploadDate = $_POST["uploadDate"];
    $isAchieved = $_POST["isAchieved"];
	
    $statement = mysqli_prepare($con, 'UPDATE todolist SET title=?, content=?, importance=?, processHours=?, uploadDate=?, isAchieved=? WHERE listID=?;');
    mysqli_stmt_bind_param($statement, 'ssiisii', $title, $content, $importance, $processHours, $uploadDate, $isAchieved, $listID);
    mysqli_stmt_execute($statement);
	
    $response = array();

    $response["success"] = true;
    echo json_encode($response);
?>
