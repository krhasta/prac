<?php
ini_set('display_errors', 1);

include_once('../constants.php');
include_once('./dbconn.php');
session_start();

$change_type = $_POST['change_type'];
$new_email = $_POST['new_email'];
$new_password = $_POST['new_password'];
$new_password_confirm = $_POST['confirm_password'];
$new_country = $_POST['new_country'];
$new_uname = $_POST['new_uname'];

$sql = '';

if ($change_type === NULL) {
    die("
    <script>
        alert('변경할 값의 타입이 전달되지 않았습니다.');
        history.go(-1);
    </script>");
}

function verify_email($email) {
    global $conn;
    $ver_email_sql = "SELECT email FROM user WHERE email = '$email'";
    $result = $conn->query($ver_email_sql);

    if ($result->num_rows > 0) {
        die("
        <script>
            alert('이미 사용중인 이메일입니다.');
            history.go(-1);
        ");
    }
}

function verify_uname($uname) {
    global $conn;
    $ver_uname_sql = "SELECT uname FROM user WHERE uname = '$uname'";
    $result = $conn->query($ver_uname_sql);

    if ($result->num_rows > 0) {
        die("
        <script>
            alert('이미 사용중인 사용자명입니다.');
            history.go(-1);
        ");
    }
}

function verify_passwd($passwd, $confirm_passwd) {
    if ($passwd != $confirm_passwd) {
        die("
        <script>
            alert('비밀번호 확인이 일치하지 않습니다.');
            history.go(-1);
        </script>");

    } else if (strlen($passwd) < 8) {
        die("
        <script>
            alert('비밀번호는 8자 이상이어야 합니다.');
            history.go(-1);
        </script>");
    }
}

switch ($change_type) {
    case 'email':
        verify_email($new_email);
        $sql = "UPDATE user SET email = '$new_email' WHERE email = '$_SESSION[email]'";
        break;

    case 'passwd':
        verify_passwd($new_password, $new_password_confirm);
        $sql = "UPDATE user SET password = '$new_password' WHERE email = '$_SESSION[email]'";
        break;

    case 'ctry':
        $sql = "UPDATE user SET country = '$new_country' WHERE email = '$_SESSION[email]'";
        break;

    case 'uname':
        verify_uname($new_uname);
        $sql = "UPDATE user SET uname = '$new_uname' WHERE email = '$_SESSION[email]'";
        break;

    default:
        die("
        <script>
            alert('변경할 값의 타입이 잘못되었습니다.');
            history.go(-1);
        </script>");
}

$change_result = $conn->query($sql);

if ($change_result) {
    echo "
    <script>
        alert('정보 변경이 완료되었습니다.');
        history.go(-1);
    </script>";

} else {
    die("
    <script>
        alert('정보 변경에 실패했습니다.');
        history.go(-1);
    </script>");
}
?>