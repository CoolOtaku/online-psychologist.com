<?php
    global $db;
    $Ip = "localhost";
    $UserName = "root";
    $Password = "";
    $DbName = "otak_online_psychologist";
    
    $db = mysqli_connect($Ip, $UserName, $Password, $DbName);
    mysqli_set_charset($db, "utf8mb4");
    
    if(!$db){
        die ("ПОМИЛКА підключення до БД!");
    }

    date_default_timezone_set('Europe/Kiev');

?>