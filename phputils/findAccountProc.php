<?php
include_once ('../constants.php');
include_once('dbconn.php');

$find_type = $_POST["find_type"] ?? '';
$phone = $_POST['phone'] ?? '';
$email = $_POST['email'] ?? '';
$question_type = $_POST["question_type"] ?? '';
$answer = $_POST["answer"] ?? '';
    
    try {
    switch ($find_type) {
        # 비밀번호를 찾는 경우
        case "find_passwd":
            $sql = "SELECT pwd, uname FROM user WHERE email = '$email' AND q_type = '$question_type' AND answer = '$answer'";
            $result = $conn->query($sql);
    
            if ($result->num_rows > 0) {
                $row = $result->fetch_assoc();
    
                echo "<script>
                    alert('".$row['uname']."님의 비밀번호는 " . $row['pwd'] . " 입니다.');
                    location.href = '" . LOC_SIGNIN . "';
                </script>
                ";
            
            } else {
                echo "<script>
                    alert('가입된 정보가 없습니다.');
                    history.go(-1);
                </script>";
            }
            break;
    
        # 아이디를 찾는 경우
        case "find_id":
            $sql = "SELECT * FROM user WHERE phone = '$phone'";
            $result = $conn->query($sql);
    
            if ($result->num_rows > 0) {
                $row = $result->fetch_assoc();
                $sms_content = "[천하제일 단타대회]\\n가입하신 이메일은 " . $row['email'] . " 입니다.";
    
                echo "<script>
                        alert('$sms_content');
                        location.href = '" . LOC_SIGNIN . "';
                    </script>";
            
                } else {
                    echo "<script>
                        alert('가입된 정보가 없습니다.');
                        history.go(-1);
                    </script>";
                }
    }
} catch (Exception $e) {
    echo "<script>
        alert('입력하신 정보가 올바르지 않습니다.');
        history.go(-1);
    </script>";
}

?>