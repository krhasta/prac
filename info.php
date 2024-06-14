<?php
include_once ('constants.php');
include_once (DBCONN);
include_once ('./phputils/checkLogin.php');
include_once ('./phputils/getRanks.php');
session_start();

$user_info_sql = "SELECT * FROM user WHERE email = '" . $_SESSION['email'] . "'";
$result = $conn->query($user_info_sql);
if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
}

?>
<!DOCTYPE html>
<html lang="ko">
<?php include_once ('head_common.php') ?>

<body>
    <?php include_once ('nav.php') ?>
    <div id="info" class="page-main vw65">
        <h2 class="mb25">내 정보</h2>
        <div id="aaa" class="flex s-bet">
            <div class="w45 mb20">
                <div id="info-myinfo" class="info">
                    <div class="white-div p30 mb20 h550">
                        <div class="form-inner">
                            <div class="form-info">
                                <h4 class="m0 mb5">이메일</h4>
                                <div class="m0 mb15 myinfo-info"><?php echo $_SESSION['email'] ?></div>
                            </div>
                            <div class="form-info">
                                <h4 class="m0 mb5">국가</h4>
                                <div class="m0 mb15 myinfo-info">
                                    <?php echo strtoupper($_SESSION['ctry']) ?>
                                </div>
                            </div>

                            <div class="form-info">
                                <h4 class="m0 mb5">닉네임</h4>
                                <div class="m0 mb15 myinfo-info">
                                    #<span>
                                        <?php
                                        $my_rank = NULL;
                                        $curr_index = 1;
                                        foreach ($now_ranks as $uname => $balance_ctry_pair) {
                                            if ($uname == $_SESSION['uname']) {
                                                $my_rank = $curr_index;
                                                break;
                                            }
                                            $curr_index++;
                                        }
                                        print ($my_rank);
                                        ?>
                                    </span>&nbsp;&nbsp;<?php echo $_SESSION['uname'] ?> 님
                                </div>
                            </div>

                            <div class="form-info">
                                <h4 class="m0 mb5">잔고</h4>
                                <div class="m0 mb15">
                                    ₩&nbsp;<?php echo number_format($row['balance']) ?>원
                                </div>
                            </div>

                            <div class="form-info">
                                <h4 class="m0 mb5">전화번호</h4>
                                <div class="m0 mb15">
                                    <?php echo $row['phone'] ?>
                                </div>
                            </div>

                            <div class="form-info">
                                <h4 class="m0 mb5">가입일자</h4>
                                <div class="m0 mb15">
                                    <?php echo $row['rdate'] ?>
                                </div>
                            </div>

                            <div class="form-info">
                                <h4 class="m0 mb5"><?php echo $row['msg'] ?></h4>
                            </div>


                            <div class="flex" style="justify-content:right; gap: 10px;">
                                <button class="white-div myinfo-btn-submit mb0" type="submit" onClick="logout()"><i
                                        class="fa-solid fa-arrow-right-from-bracket logout"></i>&nbsp;&nbsp;로그아웃</button>

                                <button class="white-div myinfo-btn-submit mb0"
                                    style="background-color: #e74c3c; color: white;" type="submit"
                                    onClick="removeAccount()"><i
                                        class="fa-regular fa-circle-xmark logout"></i>&nbsp;&nbsp;회원탈퇴</button>
                            </div>
                        </div>

                    </div>
                </div>
            </div>

            <div class="w45 mb20">
                <form action="/wdwp-final/phputils/modifyInfoProc.php" method="post">
                    <div id="info-edit" class="white-div p30 mb20 h550 edit">
                        <div class="form-inner">
                            <div class="form-info">
                                <h3 class="m0 mb15">이메일</h3>
                                <div class="flex-c">
                                    <input type="email" id="email" class="input-info" placeholder="수정할 이메일을 입력하세요"
                                        name="new_email" />
                                    <i id="f-email" class="fa-solid fa-check fontasm-c" data-clear="0"></i>
                                </div>
                                <p class="text-grey mt5">예) xxx@example.com</p>
                                <div class="flex" style="justify-content:right">
                                    <button class="white-div myinfo-btn-submit mt10" name="change_type" value="email"
                                        type="submit">이메일
                                        변경</button>
                                </div>
                            </div>


                            <div class="form-info">
                                <h3 class="m0 mb15">비밀번호 변경</h3>
                                <div class="flex-c">
                                    <input type="password" id="password" class="input-info" placeholder="비밀번호를 입력하세요"
                                        name="new_password" />
                                    <i id="f-password" class="fa-solid fa-check fontasm-c" data-clear="1"></i>
                                    <i id="f-show-password" class="fa-regular fa-eye fontasm-v" data-id="password"
                                        data-vnum="0"></i>
                                </div>
                                <p class="text-grey mt5">숫자, 특수문자, 영어 소문자, 대문자들이 포함되어야 합니다.</p>
                            </div>

                            <div class="form-info">
                                <h4 class="m0 mb15">비밀번호 확인</h4>
                                <div class="flex-c">
                                    <input type="password" class="input-info" id="confirm-password"
                                        placeholder="비밀번호를 입력하세요" name="confirm_password" />
                                    <i id="f-confirm-password" class="fa-solid fa-check fontasm-c" data-clear="2"></i>
                                    <i id="f-show-confirm-password" class="fa-regular fa-eye fontasm-v"
                                        data-id="confirm-password" data-vnum="1"></i>
                                </div>
                                <p class="text-grey mt5">비밀번호를 한 번 더 입력하세요.</p>
                                <div class="flex" style="justify-content:right">
                                    <button class="white-div myinfo-btn-submit mt10" name="change_type" value="passwd"
                                        type="submit">비밀번호 변경</button>
                                </div>
                            </div>

                            <div class="form-info">
                                <h4 class="m0 mb15">국가</h4>
                                <div class="flex-c">
                                    <select name="new_country" id="country" class="input-info">
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
                                    <button class="white-div myinfo-btn-submit mt10" name="change_type" value="ctry"
                                        type="submit">국가 변경</button>
                                </div>
                            </div>

                            <div class="form-info" style="margin-bottom: 0">
                                <h4 class="m0 mb15">닉네임</h4>
                                <div class="flex-c">
                                    <input class="input-info" type="text" id="username" placeholder="닉네임을 입력하세요"
                                        name="new_uname" />
                                    <i id="f-username" class="fa-solid fa-check fontasm-c" data-clear="4"></i>
                                </div>
                                <div class="flex-c s-bet">
                                    <p id="create-username" class="text-grey" style="cursor: pointer">
                                        작명이 고민이라면?
                                    </p>

                                </div>
                                <div class="flex" style="justify-content:right">
                                    <button class="white-div myinfo-btn-submit mt10 mb0" name="change_type"
                                        value="uname" type="submit">닉네임 변경</button>
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
    <script src="./js/f-signup.js"></script>
    <script src="./js/f-awesome.js"></script>
    <script src="/js/koAliasGen.js"></script>
    <script>
    function logout() {
        confirm('정말 로그아웃할까요?') == true ?
            location.href = '/wdwp-final/phputils/logoutProc.php' : '';
    }

    function removeAccount() {
        confirm('정말 탈퇴할까요?\n확인 버튼을 클릭하시면 계정이 삭제됩니다.') == true ? (() => {
                alert('그동안 이용해 주셔서 감사합니다.');
                location.href = '/wdwp-final/phputils/removeAccountProc.php';
            })() :
            console.log('탈퇴 취소');
    }

    $('#create-username').on('click', function(e) {
        $('#username').val(koAliasGen());
        let check = test_korean.test($('#username').val());
        showXMark('username', check, null);
    });
    </script>
</body>

</html>