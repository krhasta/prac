<?php
require_once ('./utils/sanitizer.php');

date_default_timezone_set('Asia/Seoul');
# DB 접속 정보
$dbHost = "localhost";
$dbUser = "game";
$dbPasswd = "IUez8XhE3vH.";
$dbName = "game";

# action 핸들러 이름 정의
$handlerNames = ['signup', 'signin', 'withdraw', 'nameavail'];
$response = array(
  'status' => '',
  'resource' => ''
);

function nameavail($conn, $arg)
{
  $username = $arg['username'];

  # 검사
  if (filter_var($username, FILTER_VALIDATE_EMAIL) !== $username)
    throw new Exception('MALFORMED_EMAIL');

  # 쿼리 생성
  $query = "SELECT * FROM accounts WHERE username='{$username}'";

  # 실행
  $result = mysqli_query($conn, $query);

  echo $result->num_rows;
}

function signin($conn, $arg)
{
  $username = $arg['username'];
  $password = $arg['password'];

  # 검사
  if (filter_var($username, FILTER_VALIDATE_EMAIL) !== $username)
    throw new Exception('MALFORMED_EMAIL');
  if (preg_match('/^([A-Za-z1234567890!@#$%^&*()]){6,12}$/', $password) === 0)
    throw new Exception('MALFORMED_PASSWORD');

}

function signup($conn, $arg)
{
  $username = $arg['username'];
  $password = $arg['password'];
  $phone = $arg['phone'];
  $now = time();

  # 검사
  if (filter_var($username, FILTER_VALIDATE_EMAIL) !== $username)
    throw new Exception('MALFORMED_EMAIL');
  if (preg_match('/^([A-Za-z1234567890!@#$%^&*()]){6,12}$/', $password) === 0)
    throw new Exception('MALFORMED_PASSWORD');
  if (preg_match('/^[0-9]{8}$/', $phone) === 0)
    throw new Exception('MALFORMED_PHONE_NUMBER');

  # 전처리
  $password = hash('sha256', $password);
  $query = "INSERT INTO accounts(username, hashed_passwd, phone, registered_on) VALUES('{$username}', '{$password}', '{$phone}', '{$now}')";

  # 실행
  $result = mysqli_query($conn, $query);

  $response['resource'] = $result;
  return $result;
}

try {
  header('Content-type: application/json');
  # DB 연결 및 접속 여부 검사
  $db = mysqli_connect($dbHost, $dbUser, $dbPasswd, $dbName);
  if (!$db)
    throw new Exception('DB_FAULT');
  # action 파라미터 확인
  $action = $_GET['action'];
  # action 파라미터 검사
  if (array_search($action, $handlerNames, true) === false)
    throw new Exception('ACTION_NOT_FOUND');
  # 2. json to 배열
  $body = json_decode(file_get_contents("php://input"), true);

  # 핸들러 실행
  $handler_response = $action($db, $body);
  $handler_response ? $response['status'] = 'success' : $response['status'] = 'failed';

  echo json_encode($response);

} catch (Exception $e) {
  # HTTP 상태코드 지정
  http_response_code(500);
  $response['status'] = 'failed';
  $response['resource'] = $e->getMessage();
  echo json_encode($response);
}
?>
