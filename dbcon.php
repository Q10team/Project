<?php

    $host = 'localhost';
    $username = 'user'; # MySQL 계정 아이디
    $password = '1234'; # MySQL 계정 패스워드
    $dbname = 'todolistapp';  # DATABASE 이름
    
    try {

        $con = mysqli_connect($host,$username,$password,$dbname);
    } catch(PDOException $e) {

        die("Failed to connect to the database: " . $e->getMessage()); 
    }
?>
