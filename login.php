<!DOCTYPE html>
<html lang="ko">
<?php
include_once ('head_common.php');
include_once ('constants.php');
?>

<body>
    <?php include_once ('nav.php') ?>
    <div class="page-main">
        <div class="flex-c">
            <div id="login" class="vw30">
                <h2 class="mb25">로그인</h2>
                <form method="POST" action="<?php echo LOC_SIGNIN_PROC ?>">
                    <div class="white-div p30 w100 mb20">
                        <div class="form-info">
                            <h4 class="m0 mb15">이메일</h4>
                            <div class="flex-c">
                                <input type="email" class="input-info" id="email" placeholder="이메일을 입력하세요"
                                    name="email" />
                                <i id="f-email" class="fa-solid fa-xmark fontasm-c black" data-clear="0"></i>
                            </div>
                        </div>
                        <div class="form-info mb0">
                            <h4 class="m0 mb15">비밀번호</h4>
                            <div class="flex-c">
                                <input type="password" class="input-info" id="password" placeholder="비밀번호를 입력하세요"
                                    name="passwd" />
                                <i id="f-password" class="fa-solid fa-xmark fontasm-c black" data-clear="1"></i>
                                <i id="f-show-password" class="fa-regular fa-eye fontasm-v" data-id="password"
                                    data-vnum="0"></i>
                            </div>
                            <br />

                            <div class="flex-c s-bet">
                                <p class="mt5 mb0" style="text-align: right">
                                    <a href="<?php echo LOC_FINDACC ?>" style="font-size: 13px; color: gray">계정을
                                        잊으셨다구요?</a>
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

    <script src="./js/f-login.js"></script>
    <script src="./js/f-awesome.js"></script>
</body>

</html>