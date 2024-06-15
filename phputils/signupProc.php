<?php
include_once('../constants.php');
include_once('dbconn.php');

$email = $_POST["email"];
$password = $_POST["password"];
$cfrm_password = $_POST["confirm-password"];
$country = $_POST["country"];
$username = $_POST['username'];
$determination = $_POST['determination'] ?? "";
$question_type = $_POST['question_type'];
$answer = $_POST['answer'];
$phone = $_POST['phone'];
$reg_date = date('Y/m/d');

# 가입시 기본 잔액
define('INITIAL_BALANCE', 100 * 10000);

# 비밀번호 확인
if ($password != $cfrm_password) {
    print("
        <script>
            alert('비밀번호 확인이 일치하지 않습니다.');
            history.go(-1);
        </script>
    ");
    exit;
    
} else if (strlen($passwd) < 8) {
    die("
    <script>
        alert('비밀번호는 8자 이상이어야 합니다.');
        history.go(-1);
    </script>");
}

# 닉네임 중복검사
$check_uname_sql = "SELECT * FROM user WHERE uname = '$username'";
$uname_result = $conn->query($check_uname_sql);
if ($uname_result->num_rows > 0) {
    print("
    <script>
    alert('이미 사용중인 닉네임입니다.');
    history.go(-1);
    </script>
    ");
    exit;
}

# 사용자명이 너무 짧은 경우
if (strlen($username) < 4) {
    print("
        <script>
            alert('사용자명은 4자 이상이어야 합니다.');
            history.go(-1);
        </script>
    ");
    exit;
}

# 오류가 발생하지 않았다면 회원가입 진행
$sql = "INSERT INTO user
        VALUES ('$email', '$password', '$country', '$username', '$determination', '$question_type', '$answer', '$phone', '$reg_date', INITIAL_BALANCE)";
try {
    if ($conn->query($sql)) {
        print("
            <script>
                alert('회원가입이 완료되었습니다.');
                location.href='".LOC_MAIN."';
            </script>
        ");

    } else {
        print("
            <script>alert('회원가입에 실패했습니다.');</script>
        ");
    }

} catch (Exception $e) {
    $reason_code = $e->getCode();
    $reason_str = '';

    # 오류 코드에 따라 오류 메시지 결정
    switch ($reason_code) {
        case 1062:
            $reason_str = '이메일 또는 닉네임이 중복됩니다';
            break;
    
        default:
            $reason_str = '알 수 없는 오류/'.$reason_code;
    }

    print("
            <script>
                alert('오류가 발생했습니다.($reason_str)');
                history.go(-1);
            </script>
        ");
}

$conn->close();
?>