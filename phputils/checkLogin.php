<?php
include_once ('constants.php');
include_once (DBCONN);
session_start();

if ($_SESSION['email'] == NULL) {
    die("
    <script>
        alert('로그인이 필요합니다.');
        location.href='" . LOC_SIGNIN . "';
    </script>
    ");
}
?>