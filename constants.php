<?php
# 문자열
define('SITE_NAME', '천하제일 단타대회');

# 게임 관련
define('GAME_RUNNING_TIME', 5);

# 경로
define('PRJ_ROOT',         '/wdwp-final');
define('PRJ_PROC_ROOT',    PRJ_ROOT.'/phputils'.'/');
define('LOC_MAIN',         PRJ_ROOT.'/index.php');
define('LOC_SIGNIN',       PRJ_ROOT.'/login.php');
define('LOC_SIGNUP',       PRJ_ROOT.'/signup.php');
define('LOC_FINDACC',      PRJ_ROOT.'/findAccount.php');
define('LOC_MYPAGE',       PRJ_ROOT.'/info.php');
define('LOC_SIGNIN_PROC',  './phputils/loginProc.php');
define('LOC_SIGNOUT_PROC', './phputils/logoutProc.php');
define('LOC_SIGNUP_PROC',  './phputils/signupProc.php');
define('LOC_FINDACC_PROC', './phputils/findAccountProc.php');
define('LOC_GAME',         './phputils/game.php');
define('DBCONN',           './phputils/dbconn.php');
?>