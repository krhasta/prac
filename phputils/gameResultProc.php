<?php
include_once('../constants.php');
include_once('dbconn.php');
session_start();

error_reporting( E_ALL );
ini_set( "display_errors", 1 );

if ($_SESSION['email'] == NULL) {
    die("
    <script>
        alert('로그인이 필요합니다.');
        location.href='./login.php';
    </script>
    ");
}

if (!isset($_GET['delta'])) {
    die("
    <script>
        alert('잘못된 접근입니다.');
        history.go(-1);
    </script>
    ");
}

$curr_email = $_SESSION['email'];

$curr_balance = NULL; // 게임 전 잔액
$delta = $_GET['delta']; // 게임 후 잔액 변화량
$after_balance = NULL; // 게임 후 잔액

$current_balance_sql = "SELECT balance
                        FROM user
                        WHERE email = '$curr_email'"; // 최초 잔액 쿼리

$result = $conn->query($current_balance_sql);
if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $curr_balance = $row['balance']; // 현재 잔액 가져오기
}

$after_balance = $curr_balance + (int)$delta; // 게임 종료 후 잔고 계산
$now_datetime = date('Y-m-d H:i:s', strtotime('+0 hours'));

// 잔고 반영 + 마지막 게임완료시간 업데이트 + 잔액변동 업데이트 쿼리
$update_balance_sql  = "UPDATE user 
                        SET balance = $after_balance,
                            last = '$now_datetime',
                            last_delta = $delta
                        WHERE email = '$curr_email'";

$update_result = $conn->query($update_balance_sql); // 잔액 반영
if ($update_result) {
    header('Content-Type: application/json');
    $result = array(
        'status'      => true,
        'message'     => '게임 결과가 반영되었습니다.',
        'before_game' => $curr_balance,
        'delta'       => $delta,
        'after_game'  => $after_balance
    );

    echo json_encode($result);

} else {
    die("
        <script>
            alert('게임 결과를 반영하지 못했습니다.');
            history.go(".LOC_MAIN.");
        </script>
    ");
}
?>