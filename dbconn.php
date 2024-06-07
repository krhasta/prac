<?php
$server = "localhost";
$user = "game";
$pwd = "IUez8XhE3vH.";
$dbname = "game";
$conn = new mysqli($server, $user, $pwd, $dbname);

if ($conn->connect_error)
    echo "DB 접속 오류<br>";
?>