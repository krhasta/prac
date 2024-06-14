<!DOCTYPE html>
<html lang="ko">
<?php
include_once ('head_common.php');
include_once ('constants.php');
$pretyped_email = $_GET['email'] ?? false;
?>

<body>
    <?php include_once ('nav.php') ?>
    <div id="findAccount" class="page-main vw65" style="">
        <div id="find" class="flex-c s-bet" style="align-items: flex-start;">
            <div id="find-id" class="w45 mb20">
                <h3 class="mb25">아이디 찾기</h3>
                <form action="<?php echo LOC_FINDACC_PROC ?>" method="post">
                    <div class="white-div p30 mb20">
                        <div class="form-info">
                            <h4 class="m0 mb15">휴대폰 번호</h4>
                            <div class="flex-c">
                                <input type="number" class="input-info" value="010" name="phone" />
                            </div>
                            <input type="text" name="find_type" value="find_id" hidden />
                            <p class="text-grey mt5">
                                가입 시 입력한 휴대폰 번호로 아이디(이메일)을 보내드립니다.
                            </p>
                        </div>
                    </div>
                    <button class="white-div w100" type="submit">제출</button>
                </form>
            </div>
            <div id="find-pw" class="w45 mb20">
                <h3 class="main-Title">비밀번호 찾기</h3>
                <form action="<?php echo LOC_FINDACC_PROC ?>" method="post">
                    <div class="white-div p30 mb20">
                        <div class="form-info">
                            <h4 class="m0 mb15">이메일</h4>
                            <div class="flex-c">
                                <input type="email" class="input-info" placeholder="이메일을 입력하세요" name="email"
                                    value="<?php echo $pretyped_email !== false ? $pretyped_email : '' ?>" required />
                            </div>
                        </div>
                        <div class="form-info">
                            <h4 class="m0 mb15">비밀번호 찾기 질문</h4>
                            <div class="flex-c">
                                <select name="question_type" class="input-info" required>
                                    <option value="a">기억에 남는 추억의 장소는?</option>
                                    <option value="b">자신의 인생 좌우명은?</option>
                                    <option value="c">자신의 보물 제1호는?</option>
                                    <option value="d">가장 기억에 남는 선생님 성함은?</option>
                                    <option value="e">타인이 모르는 자신만의 신체비밀이 있다면?</option>
                                    <option value="f">추억하고 싶은 날짜가 있다면?</option>
                                    <option value="g">받았던 선물 줄 기억에 남는 독특한 선물은?</option>
                                    <option value="h">유년시절 가장 생각나는 친구 이름은?</option>
                                    <option value="i">인상 깊게 읽은 책 이름은?</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-info">
                            <h4 class="m0 mb15">답변</h4>
                            <div class="flex-c">
                                <input type="text" class="input-info" placeholder="답변을 입력하세요" name="answer" required />
                            </div>
                        </div>
                    </div>
                    <input type="text" name="find_type" value="find_passwd" hidden />
                    <button class="white-div w100" type="submit">제출</button>
                </form>
            </div>
        </div>
    </div>

    <script src="./js/f-login.js"></script>
</body>

</html>