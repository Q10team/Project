<?php
	
	include('todolistDAO.php');
	
    $userID = $_POST["userID"];
    $uploadDate = $_POST["uploadDate"];
    
    $statement = mysqli_prepare($con, 'SELECT * FROM todolist WHERE userID=? AND uploadDate=?');
    mysqli_stmt_bind_param($statement, 'ss', $userID, $uploadDate);
    mysqli_stmt_execute($statement);
	
    mysqli_stmt_store_result($statement);
    mysqli_stmt_bind_result($statement, $listID, $userID, $title, $content, $importance, $processHours, $uploadDate, $isAchieved);
 
    $response = array();
    $total_response = array();
 
    while(mysqli_stmt_fetch($statement)) {
        $response['listID'] = $listID;
	    $response['userID'] = $userID;
        $response['title'] = $title;
        $response['content'] = $content;
        $response['importance'] = $importance;
        $response['processHours'] = $processHours;
        $response['uploadDate'] = $uploadDate;
        $response['isAchieved'] = $isAchieved;
        $total_response[] = $response;
    }
	
    //echo json_encode(array('total_response', $total_response));
    echo json_encode($total_response);
?>
