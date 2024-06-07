<!DOCTYPE php>
<html lang="en">
<?php include_once ('head_common.php') ?>

<body>
    <nav class="w100">
        <div class="nav-main">
            <a class="nav-title" href="index.php">천하제일 단타대회</a>
            <a href="login.php"><i class="fa-solid fa-arrow-right-to-bracket"></i>&nbsp;&nbsp;로그인하세요</a>
        </div>
    </nav>

    <div class="page-main vw65">
        <h2 class="main-Title">내 정보</h2>
        <div class="flex-c s-bet">
            <div class="w45">
                <form action="./aaa.php" method="post">
                    <div class="white-div p30 mb20 h500 signup">
                        <div class="form-inner">
                            <div class="form-info">
                                <h4 class="m0 mb15">이메일</h4>
                                <!-- 사용자의 이메일을 php로 보여주기 -->
                                <div class="m0 mb15 myinfo-info">xxx@example.com</div>
                            </div>
                            <div class="form-info">
                                <h4 class="m0 mb15">국가</h4>
                                <!-- 사용자의 이메일을 php로 보여주기 -->
                                <div class="m0 mb15 myinfo-info">대한민국 - KR</div>
                            </div>

                            <div class="form-info">
                                <h4 class="m0 mb15">닉네임</h4>
                                <!-- 사용자의 닉네임을 php로 보여주기 -->
                                <div class="m0 mb15 myinfo-info">깐따삐야명예시민</div>
                            </div>
                            <div class="form-info">
                                <h4 class="m0 mb15">순위</h4>
                                <!-- 사용자의 랭킹을 php로 보여주기 -->
                                <div class="m0 mb15 myinfo-info"><i
                                        class="fas fa-trophy fontasm-i"></i>&nbsp;&nbsp;#<span>1</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="w45">
                <form action="./aaa.php" method="post">
                    <div class="white-div p30 mb20 h500 signup">
                        <div class="form-inner">
                            <!-- <h3 class="m0 mb15">이메일 수정</h3> -->
                            <!-- php로 사용자의 이메일 보여주기 -->
                            <!-- <div class="m0 mb15 myinfo-info">xxx@example.com</div> -->
                            <div class="form-info">
                                <h3 class="m0 mb15">이메일 수정<h3>
                                        <div class="flex-c">
                                            <input type="email" id="email-signup" class="input-info"
                                                placeholder="수정할 이메일을 입력하세요" name="email-signup" />
                                            <i id="f-email-signup" class="fa-solid fa-check fontasm-c"
                                                data-clear="2"></i>
                                        </div>
                                        <div class="flex" style="justify-content:right">
                                            <button class="white-div myinfo-btn-submit mt10" type="submit">이메일
                                                변경</button>
                                        </div>
                            </div>

                            <div class="form-info">
                                <h3 class="m0 mb15">비밀번호 변경</h3>
                                <div class="flex-c">
                                    <input type="password" id="password-signup" class="input-info"
                                        placeholder="비밀번호를 입력하세요" name="password-signup" />
                                    <i id="f-password-signup" class="fa-solid fa-check fontasm-c" data-clear="3"></i>
                                    <i id="f-show-password-signup" class="fa-regular fa-eye fontasm-v"
                                        data-id="password-signup" data-vnum="1"></i>
                                </div>
                                <p class="text-grey mt5">숫자, 특수문자, 영어 소문자, 대문자들이 포함되어야 합니다.</p>
                            </div>

                            <div class="form-info">
                                <h4 class="m0 mb15">비밀번호 확인</h4>
                                <div class="flex-c">
                                    <input type="password" class="input-info" id="confirm-password"
                                        placeholder="비밀번호를 입력하세요" name="confirm-password" />
                                    <i id="f-confirm-password" class="fa-solid fa-check fontasm-c" data-clear="4"></i>
                                    <i id="f-show-confirm-password" class="fa-regular fa-eye fontasm-v"
                                        data-id="confirm-password" data-vnum="2"></i>
                                </div>
                                <p class="text-grey mt5">비밀번호를 한 번 더 입력하세요.</p>
                                <div class="flex" style="justify-content:right">
                                    <button class="white-div myinfo-btn-submit mt10" type="submit">비밀번호 변경</button>
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
                                <div class="flex" style="justify-content:right">
                                    <button class="white-div myinfo-btn-submit mt10" type="submit">국가 변경</button>
                                </div>
                            </div>

                            <div class="form-info" style="margin-bottom: 0">
                                <h4 class="m0 mb15">닉네임</h4>
                                <div class="flex-c">
                                    <input class="input-info" type="text" id="username-signup" placeholder="닉네임을 입력하세요"
                                        name="username-signup" />
                                    <i id="f-username-signup" class="fa-solid fa-check fontasm-c" data-clear="5"></i>
                                </div>
                                <div class="-c s-bet">
                                    <p id="create-username-signup" class="text-grey" style="cursor: pointer">
                                        작명이 고민이라면?
                                    </p>

                                </div>
                                <div class="flex" style="justify-content:right">
                                    <button class="white-div myinfo-btn-submit mt10" type="submit">닉네임 변경</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>

        </div>

    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>
    <script>
    $('#gotoLogin').click(() => {
        location.href = 'login.php';
    });
    </script>
    <script src="/js/login.js"></script>
    <script src="/js/signup.js"></script>
    <script src="/js/koAliasGen.js"></script>
</body>

</html>