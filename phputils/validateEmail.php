<?php
include_once('../constants.php');
include_once('dbconn.php');

$target = $_GET['arg'] ?? '';

# 파라미터 검사
if ($target === '') {
    http_response_code(400);
    die("_ERROR");
}

# 이메일 형식 검사
if (!filter_var($target, FILTER_VALIDATE_EMAIL)) {
    echo "_ERROR";
    exit;
}

# 이메일 중복 검사
$sql = "SELECT email FROM user WHERE email = '$target'";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
    echo "_FALSE";

} else if ($result->num_rows == 0) {
    echo "_TRUE";
}
?>