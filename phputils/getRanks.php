<?php
include_once('dbconn.php');

$result = $conn->query('SELECT uname, balance, ctry, last, last_delta
                        FROM user
                        ORDER BY balance DESC
                        LIMIT 10
                      ');

$now_ranks = array(); // 연관 배열을 초기화

if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $now_ranks[$row['uname']] = [
            $row['balance'],
            strtoupper($row['ctry']),
            $row['last'] ?? 'NA',
            $row['last_delta'] ?? 'NA'
        ];
    }
}

?>