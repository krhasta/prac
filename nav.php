<?php
session_start();
include_once('constants.php');

# 1. 세션 배열에서 로그인한 사용자명 가져오기
$uname = $_SESSION['uname'];
$is_logged = ($uname !== NULL) ? true : false;

# 2. 링크 결정
$link = $is_logged ?
    LOC_MYPAGE : // 클릭시 마이페이지
    LOC_SIGNIN;  // 클릭시 로그인페이지

# 2.1 아이콘 CSS 클래스명 결정
$i_class = $is_logged ?
    'fas fa-user' : // 사용자 아이콘
    'fa-solid fa-arrow-right-to-bracket'; // 로그인 아이콘

# 2.2 캡션
$caption = $is_logged ?
    $uname.'님' : // 로그인한 경우: '사용자명' + '님'
    '로그인하세요'; // 손님

# 2.3 최종 html 생성
$rendered = "
    <a href='".$link."'>
        <i class='".$i_class."'></i>&nbsp;&nbsp;".$caption."
    </a>
";

# 응답
print(' 
<nav class="w100">
    <ul class="nav-main">
        <li><a class="nav-title" href="'.LOC_MAIN.'">'.SITE_NAME.'</a></li>
        <li class="nav-links">'.$rendered.'</li>
    </ul>
</nav>
');
?>