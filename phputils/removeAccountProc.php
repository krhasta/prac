<?php
session_start();
include_once('../constants.php');
include_once('dbconn.php');

# 회원 탈퇴 처리 후 메인으로 이동
if ($_SESSION['email'] == NULL) {
    die("
    <script>
        alert('로그인이 필요합니다.');
        location.href='./login.php';
    </script>
    ");
}

$curr_email = $_SESSION['email'];
$sql = "DELETE FROM user WHERE email = '$curr_email'";
$result = $conn->query($sql);
if ($result) {
    session_destroy();
    echo "<script>
        alert('회원 탈퇴가 완료되었습니다.');
        location.href='".LOC_MAIN."';
    </script>";
    
} else {
    die("
    <script>
        alert('회원 탈퇴에 실패했습니다.');
        history.go(-1);
    </script>
    ");
}

?>