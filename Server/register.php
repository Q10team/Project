<?php
	
	include('userDAO.php');
	
	$ID = $_POST["ID"];
    $PW = $_POST["PW"];
	$Name = $_POST["Name"];
	$Email = $_POST["Email"];
   
	
    $statement = mysqli_prepare($con, 'INSERT INTO user(userID, userPW, userName, userEmail) VALUES(?, ?, ?, ?)');
    mysqli_stmt_bind_param($statement, 'ssss', $ID, $PW, $Name, $Email);
    mysqli_stmt_execute($statement);
?>
