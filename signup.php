<!DOCTYPE html>
<html lang="ko">
<?php include_once ('head_common.php');
include_once ('constants.php'); ?>

<body>
    <?php include_once ('nav.php') ?>
    <div class="page-main flex-c mb20" style="flex-direction: row; align-items: flex-start">
        <div id="signup" class="vw30">
            <h2 class="mb25">잠시 검문이 있겠습니다.</h2>
            <form action="<?php echo LOC_SIGNUP_PROC ?>" method="post">
                <div class="white-div p30 mb20 h500 ">
                    <div class="form-inner">
                        <div class="form-info">
                            <h4 class="m0 mb15">이메일</h4>
                            <div class="flex-c">
                                <input type="email" id="email" class="input-info" placeholder="이메일을 입력하세요"
                                    name="email" />
                                <i id="f-email" class="fa-solid fontasm-c" data-clear="0"></i>
                            </div>
                            <div class="flex s-bet" style="align-items:flex-start">
                                <p class="text-grey mt5">예)
                                    xxx@example.com
                                </p>
                                <button id="validate-email" class="white-div text-grey mt5 info-btn"
                                    style="cursor: pointer; display: inline-block; margin-left: 5px;">
                                    이메일 중복검사
                                </button>
                            </div>
                        </div>

                        <div class="form-info">
                            <h4 class="m0 mb15">비밀번호</h4>
                            <div class="flex-c">
                                <input type="password" id="password" class="input-info" placeholder="비밀번호를 입력하세요"
                                    name="password" />
                                <i id="f-password" class="fa-solid fontasm-c" data-clear="1"></i>
                                <i id="f-show-password" class="fa-regular fa-eye fontasm-v" data-id="password"
                                    data-vnum="0"></i>
                            </div>
                            <p class="text-grey mt5">숫자, 특수문자, 영어 소문자, 대문자들이 포함되어야 합니다.</p>
                        </div>

                        <div class="form-info">
                            <h4 class="m0 mb15">비밀번호 확인</h4>
                            <div class="flex-c">
                                <input type="password" class="input-info" id="confirm-password"
                                    placeholder="비밀번호를 입력하세요" name="confirm-password" />
                                <i id="f-confirm-password" class="fa-solid fontasm-c" data-clear="2"></i>
                                <i id="f-show-confirm-password" class="fa-regular fa-eye fontasm-v"
                                    data-id="confirm-password" data-vnum="1"></i>
                            </div>
                            <p class="text-grey mt5">비밀번호를 한 번 더 입력하세요.</p>
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
                                    <option value="g">받았던 선물 중 기억에 남는 독특한 선물은?</option>
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

                        <div class="form-info">
                            <h4 class="m0 mb15">국가</h4>
                            <div class="flex-c">
                                <select name="country" id="country" class="input-info">
                                    <option value="kr">대한민국 - Korea</option>
                                    <option value="sw">스웨덴 - Sweden</option>
                                    <option value="uk">영국 - UK</option>
                                    <option value="us">미국 - US</option>
                                    <option value="jp">일본 - JP</option>
                                    <option value="it">이탈리아 - Italia</option>
                                    <option value="ge">독일 - Germany</option>
                                    <option value="sp">스페인 - Spain</option>
                                    <option value="cn">중국 - China</option>
                                    <option value="br">브라질 - Brazil</option>
                                    <option value="ca">캐나다 - Canada</option>
                                </select>
                            </div>
                            <p class="text-grey mt5">국가를 선택하세요</p>
                        </div>

                        <div class="form-info" style="margin-bottom: 0">
                            <h4 class="m0 mb15">닉네임</h4>
                            <div class="flex-c">
                                <input class="input-info" type="text" id="username" placeholder="닉네임을 입력하세요"
                                    name="username" />
                                <i id="f-username" class="fa-solid fontasm-c" data-clear="6"></i>
                            </div>
                            <div class="flex s-bet mt5" style="align-items:flex-start;">
                                <p id="create-username" class="text-grey mt5" style="display: inline-block;">
                                    작명이 고민이라면?
                                </p>
                                <button id="validate-username" class="white-div text-grey mt5 info-btn"
                                    style="display: inline-block">
                                    닉네임 중복검사
                                </button>
                            </div>
                        </div>

                        <div class="form-info" style="margin-bottom: 0">
                            <h4 class="m0 mb15">휴대폰 번호</h4>
                            <div class="flex-c">
                                <input class="input-info" type="number" id="phone" name="phone"
                                    placeholder="하이픈('-') 없이 전화번호를 입력하세요" />
                                <i id="f-phone" class="fa-solid fontasm-c" data-clear="7"></i>
                            </div>
                            <p class="text-grey mt5">
                                전화번호는 아이디를 찾을 때 사용됩니다.
                            </p>
                        </div>

                        <div class="form-info" style="margin-bottom: 0">
                            <h4 class="m0 mb15">나의 한 마디</h4>
                            <div class="flex-c">
                                <input class="input-info" type="text" id="determination" placeholder="나의 각오! (선택)"
                                    name="determination" />
                            </div>
                            <p id="gotoLogin" class="text-grey mt5" style="text-align:right; cursor: pointer">
                                <a>이미 회원이신가요?</a>
                            </p>
                        </div>
                    </div>
                </div>
                <button id="goSignup" class="white-div w100 disable" type="submit">가입</button>
            </form>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>
    <script>
    $('#gotoLogin').click(() => {
        location.href = '<?php echo LOC_SIGNIN ?>';
    });
    </script>
    <script src="./js/f-signup.js"></script>
    <script src="./js/f-awesome.js"></script>
    <script src="./js/koAliasGen.js"></script>
</body>

</html>