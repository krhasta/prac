<?php
session_start();
include_once ('constants.php');
include_once (DBCONN);
include_once ('./phputils/getRanks.php');

$current_email = $_SESSION['email'];
$is_guest = $_SESSION['email'] == NULL;
$user_msg = '';
$sql = "SELECT * FROM user WHERE email = '$current_email'";
$result = $conn->query($sql);

if ($result->num_rows == 1) {
    $row = $result->fetch_assoc();
    $user_msg = $row['msg'];
}
$current_ctry = $_SESSION['ctry'];
$def_msg = '단타는 인생의 소금이다.';
?>
<!DOCTYPE html>
<html lang="ko">
<?php include_once ('head_common.php') ?>

<body>
    <?php include_once ('nav.php') ?>
    <div id="index" class="page-main vw65">

        <h2 class="mb25">환영합니다!</h2>

        <div class="crs-n-btn flex-c s-eve">
            <div class="vw20"></div>
        </div>

        <div id="carouselExampleAutoplaying" class="carousel slide flex-c" data-bs-ride="carousel"
            style="margin-top:50px;margin-bottom: 60px">
            <div class="crs-n-btn flex-c s-eve">
                <div class="vw20">
                    <div class="carousel-inner">
                        <div class="carousel-item active vw20 text-center">
                            <div class="d-block w100 carousel-texts">세 살 단타<br>여든까지 간다</div>
                        </div>
                        <div class="carousel-item vw20 text-center">
                            <div class="d-block w100 carousel-texts">과도한 단타,<br />휴식도 필요합니다.</div>
                        </div>
                        <div class="carousel-item vw20 text-center">
                            <div class="d-block w100 carousel-texts">남녀노소 모두<br />즐거운 단타</div>
                        </div>
                    </div>
                </div>

                <button type="button" class="white-div btn-start" style="border: 3px solid #6f87ff;">
                    <i class="fa-solid fa-chart-line "></i>&nbsp;&nbsp; 게임 시작!
                </button>
            </div>
        </div>

        <div id="page-infos" class="page-main-info flex-c s-bet">
            <div class="page-info-standings mb20">
                <h3>유저 랭킹</h3>
                <div id="page-standings" class="white-div vw30 vh40 p30 p-rel">
                    <ul class="info-standings">
                        <h4 class="m0 mb10">Top 5</h4>
                        <?php
                        # 잔고 상위 5명만 추려서 표시
                        $max_ranks = 5;
                        $current_rank = 1;
                        foreach ($now_ranks as $uname => $balance_ctry_pair) {
                            if ($current_rank == $max_ranks + 1)
                                break;
                            print ('
                            <li class="standing-info p-rel">
                                <img class="country" src="./public/img/country/circle/' . $balance_ctry_pair[1] . '.svg" />
                                <div class="standing-info-profile">
                                    #<span class="standing-num">' . $current_rank . '</span> &nbsp;<span class="nickname">' . $uname . '님' . '</span><br>
                                    <span class="asset">' . number_format($balance_ctry_pair[0]) . '</span>원
                                </div>
                            </li>
                            ');
                            $current_rank++;
                        }
                        $template = '
                        <li class="standing-info p-rel">
                            <img class="country" src="./public/img/country/circle/.svg" />
                            <!-- 랭킹 목록은 데이터를 받아와서 동적으로 생성되어야 함. -->
                            <div class="standing-info-profile">
                                #<span class="standing-num">1</span> &nbsp;<span class="nickname">세계평화와국제기구</span><br>
                                <span class="asset">100</span>원
                            </div>
                        </li>
                        ';
                        ?>

                        <span id="standing" class="text-grey m0 text-right view-more p-abs">
                            <i class="fa-solid fa-ranking-star fontasm-i"></i>&nbsp;&nbsp;랭킹 더 보기
                        </span>
                    </ul>
                </div>
            </div>
            <div class="page-info-myinfo mb20">
                <h3>나의 정보</h3>

                <div id="page-myinfo" class="white-div vw30 vh40 p30 p-rel">
                    <div id="go-login" class="vw30 vh40 flex-c">
                        <i
                            class="<?php echo $is_guest == true ? "fas fa-lock" : '' ?>"></i>&nbsp;&nbsp;<?php echo $is_guest == true ? "로그인 후 나의 정보를 확인하세요!" : '' ?>
                    </div>
                    <div class="<?php echo $is_guest == true ? "login-plz" : '' ?> p-abs"></div>
                    <div class="myinfo <?php echo $is_guest == true ? "blur" : '' ?> no-select">
                        <h4 class="m0 mb10">
                            #<span class="myinfo-standing">
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
                            </span> <span class="nickname">
                                &nbsp;
                                <?php echo strtoupper($_SESSION['uname']) ?>
                            </span>
                        </h4>
                        <div class="myinfo-profile flex mb15">
                            <p class="myinfo-country"><?php echo strtoupper($current_ctry) ?>&nbsp;-&nbsp;</p>
                            <img class="country"
                                src="./public/img/country/circle/<?php echo strtoupper($current_ctry) ?>.svg" />
                        </div>

                        <div class="myinfo-score">
                            <h4>
                                나의 자산:&nbsp;<span class="score">
                                    <?php echo number_format($row['balance'] ?? "7700000") ?>
                                </span>원
                            </h4>
                        </div>

                        <h4 class="m10 mb10">나의 한 마디</h4>
                        <div class="myinfo-determination">
                            "<?php echo $is_guest ? $def_msg : $user_msg ?>"
                        </div>

                        <span id="info" class="text-grey m0 text-right view-more p-abs">
                            <span><i class="fa-solid fa-info fontasm-i"></i>&nbsp;&nbsp;정보 더 보기</span>
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>
    <script>
    $('#standing.view-more').click(() => {
        window.location.href = 'standings.php';
    });

    $('#info.view-more').click(() => {
        window.location.href = 'info.php';
    });

    $('.btn-start').click(() => {
        window.location.href = 'game.php';
    });

    $('.login-plz').click(function() {
        window.location.href = 'info.php';
    })
    </script>
</body>

</html>