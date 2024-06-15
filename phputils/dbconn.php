<?php
$addr = 'localhost';
$port = 3306;
$uname = 'pizza';
$passwd = 'password';
$dbname = 'game';

$conn = new mysqli($addr, $uname, $passwd, $dbname);

if ($conn->connect_error) {
    die("
    <script>
        alert('DB 연결 실패');
        history.go(-1);
    </script>
    ");
}
?>