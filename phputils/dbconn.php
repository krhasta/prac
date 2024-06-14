<?php
$addr = 'localhost';
$port = 3306;
$uname = 'pizza';
$passwd = 'password';
$dbname = 'game';

$conn = new mysqli($addr, $uname, $passwd, $dbname);

if ($conn->connect_error) {
    echo 'db_fault';
}
?>