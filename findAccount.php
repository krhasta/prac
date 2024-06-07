<!DOCTYPE html>
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
        <div class="flex-c s-bet">
            <div class="w45">
                <h3 class="main-Title">아이디 찾기</h3>
                <form action="./aaa.php" method="post">
                    <div class="white-div p30 mb20">
                        <div class="form-info">
                            <h4 class="m0 mb15">이메일</h4>
                            <div class="flex-c">
                                <input type="password" id="password" class="input-info" placeholder="이메일을 입력하세요"
                                    name="password" />
                            </div>
                        </div>
                        <div class="form-info">
                            <h4 class="m0 mb15">닉네임</h4>
                            <div class="flex-c">
                                <input type="email" id="email" class="input-info" placeholder="닉네임을 입력하세요"
                                    name="email" />
                            </div>
                        </div>
                    </div>
                    <button class="white-div w100" type="submit">제출</button>
                </form>
            </div>
            <div class="w45">
                <h3 class="main-Title">비밀번호 찾기</h3>
                <form action="./aaa.php" method="post">
                    <div class="white-div p30 mb20">
                        <div class="form-info">
                            <h4 class="m0 mb15">이메일</h4>
                            <div class="flex-c">
                                <input type="password" id="password" class="input-info" placeholder="이메일을 입력하세요"
                                    name="password" />
                            </div>
                        </div>
                        <div class="form-info">
                            <h4 class="m0 mb15">아이디</h4>
                            <div class="flex-c">
                                <input type="email" id="email" class="input-info" placeholder="아이디를 입력하세요"
                                    name="email" />
                            </div>
                        </div>
                    </div>
                    <button class="white-div w100" type="submit">제출</button>
                </form>
            </div>
        </div>
    </div>

    <script src="./js/index.js"></script>
    <script src="./js/login.js"></script>
</body>

</html>