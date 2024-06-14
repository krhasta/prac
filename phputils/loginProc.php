<?php
session_start();
include_once('../constants.php');
include_once("../".DBCONN);

$email = $_POST['email'];
$passwd = $_POST['passwd'];

$sql = "SELECT * FROM user WHERE email = '$email' AND pwd = '$passwd'";
$result = $conn->query($sql);
try {
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        
        $_SESSION['email'] = $row['email'];
        $_SESSION['uname'] = $row['uname'];
        $_SESSION['ctry']  = $row['ctry'];
    
        echo
        "<script>
            alert('".$row['uname']."님 환영합니다.');
            location.href='".LOC_MAIN."';
        </script>";
    
    } else {
        echo
        "<script>
            alert('입력하신 이메일 또는 비밀번호가 올바르지 않습니다.');
            history.go(-1);
        </script>";
    }

} catch (Exception $e) {
    echo
    "<script>
        alert('요청이 잘못되었습니다.');
        history.go(-1);
    </script>";
} 

?>