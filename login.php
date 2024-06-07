<!DOCTYPE html>
<html lang="en">
<?php include_once ('head_common.php') ?>

<body>
    <nav class="w100">
        <div class="nav-main">
            <a class="nav-title" href="index.php">천하제일 단타대회</a>
            <a href="login.php" style="cursor: pointer"><i
                    class="fa-solid fa-arrow-right-to-bracket"></i>&nbsp;&nbsp;로그인하세요</a>
        </div>
    </nav>

    <div class="page-main vw65">
        <div class="flex-c">
            <div class="vw30">
                <h2 class="main-Title">로그인</h2>
                <form action="POST">
                    <div class="white-div p30 w100 mb20">
                        <div class="form-info">
                            <h4 class="m0 mb15">이메일</h4>
                            <div class="flex-c">
                                <input type="email" class="input-info" id="email-login" placeholder="이메일을 입력하세요"
                                    name="email-login" />
                                <i id="f-email-login" class="fa-solid fa-xmark fontasm-c" data-clear="0"></i>
                            </div>
                        </div>
                        <div class="form-info mb0">
                            <h4 class="m0 mb15">비밀번호</h4>
                            <div class="flex-c">
                                <input type="password" class="input-info" id="password-login" placeholder="비밀번호를 입력하세요"
                                    name="password-login" />
                                <i id="f-password-login" class="fa-solid fa-xmark fontasm-c" data-clear="1"></i>
                                <i id="f-show-password-login" class="fa-regular fa-eye fontasm-v"
                                    data-id="password-login" data-vnum="0"></i>
                            </div>
                            <br />

                            <div class="flex-c s-bet">
                                <p class="mt5 mb0" style="text-align: right">
                                    <a href="./findAccount.php" style="font-size: 13px; color: gray">계정을 잊으셨다구요?</a>
                                </p>
                                <p class="mt5 mb0" style="text-align: right">
                                    <a href="signup.php" style="font-size: 13px; color: gray">아직 회원이 아니라구요?</a>
                                </p>
                            </div>
                        </div>
                    </div>

                    <button type="submit" class="white-div w100" style="color:black">
                        <i class="fa-solid fa-arrow-right-to-bracket"></i>&nbsp;&nbsp;로그인
                    </button>
                </form>
            </div>
        </div>
    </div>

    <script src="./js/index.js"></script>
    <script src="./js/login.js"></script>
</body>

</html>