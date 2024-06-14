<?php
include_once('../constants.php');
include_once('dbconn.php');

$target = $_GET['arg'] ?? '';

# 파라미터 검사
if ($target === '') {
    http_response_code(400);
    die("_ERROR");
}

# 사용자명 길이 검사(4자 이상인지)
if (strlen($target) < 4) {
    echo "_ERROR";
    exit;
}

# 닉네임 중복 검사
$sql = "SELECT uname FROM user WHERE uname = '$target'";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
    echo "_FALSE";

} else if ($result->num_rows == 0) {
    echo "_TRUE";
}
?>