<?php
include_once('../constants.php');
try {
    setcookie('PHPSESSID', '', -1, '/');
    echo "
    <script>
        alert('로그아웃 되었습니다.');
        location.href='".LOC_MAIN."'
    </script>";

} catch (Exception $e) {
    echo "
    <script>
        alert('로그아웃 중 문제가 발생했습니다.');
        history.go(-1);
    </script>
    ";
}
?>