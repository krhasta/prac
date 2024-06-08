<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<?php include_once ('head_common.php') ?>

<body style="background-color: #f2f3f5">
    <nav class="w100">
        <ul class="nav-main">
            <li class="nav-title">천하제일 단타대회</li>
            <li class="nav-links">
                <a href="login.php"><i class="fa-solid fa-arrow-right-to-bracket"></i>&nbsp;&nbsp;로그인하세요</a>
            </li>
        </ul>
    </nav>

    <div class="page-main vw65">
        <div class="center-links">
            오늘의 추천 종목: xxxxx
        </div>
        <h2 class="main-Title">환영합니다!</h2>

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
                <button type="button" class="white-div vw10 btn-start" style="border: 3px solid #6f87ff;">
                    <i class="fa-solid fa-chart-line "></i>&nbsp;&nbsp; 게임 시작!
                </button>
            </div>
        </div>

        <div class="page-main-info flex-c s-bet">
            <div class="page-info-standings">
                <h3>Standings</h3>
                <div class="white-div vw30 vh40 p30">
                    <ul class="standings">
                        <h4 class="m0 mb10">Players - Top 5</h4>
                        <li class="standing-info p-relative">
                            <img class="country" src="./public/img/country/circle/Sweden.svg" />
                            <!-- 랭킹 목록은 데이터를 받아와서 동적으로 생성되어야 함. -->
                            <div class="standing-info-profile">
                                #<span class="standing-num">1</span> &nbsp;<span class="nickname">세계평화와국제기구</span>
                                <span class="p-absolute" style="right: 20px">
                                    <span class="score">100</span>점
                                </span>
                            </div>
                        </li>
                        <li class="standing-info p-relative">
                            <img class="country" src="./public/img/country/circle/Sweden.svg" />
                            <!-- 랭킹 목록은 데이터를 받아와서 동적으로 생성되어야 함. -->
                            <div class="standing-info-profile">
                                #<span class="standing-num">1</span> &nbsp;<span class="nickname">세계평화와국제기구</span>
                                <span class="p-absolute" style="right: 20px">
                                    <span class="score">100</span>점
                                </span>
                            </div>
                        </li>
                        <li class="standing-info p-relative">
                            <img class="country" src="./public/img/country/circle/Sweden.svg" />
                            <!-- 랭킹 목록은 데이터를 받아와서 동적으로 생성되어야 함. -->
                            <div class="standing-info-profile">
                                #<span class="standing-num">1</span> &nbsp;<span class="nickname">세계평화와국제기구</span>
                                <span class="p-absolute" style="right: 20px">
                                    <span class="score">100</span>점
                                </span>
                            </div>
                        </li>
                        <li class="standing-info p-relative">
                            <img class="country" src="./public/img/country/circle/Sweden.svg" />
                            <!-- 랭킹 목록은 데이터를 받아와서 동적으로 생성되어야 함. -->
                            <div class="standing-info-profile">
                                #<span class="standing-num">1</span> &nbsp;<span class="nickname">세계평화와국제기구</span>
                                <span class="p-absolute" style="right: 20px">
                                    <span class="score">100</span>점
                                </span>
                            </div>
                        </li>
                        <li class="standing-info p-relative">
                            <img class="country" src="./public/img/country/circle/Sweden.svg" />
                            <!-- 랭킹 목록은 데이터를 받아와서 동적으로 생성되어야 함. -->
                            <div class="standing-info-profile">
                                #<span class="standing-num">1</span> &nbsp;<span class="nickname">세계평화와국제기구</span>
                                <span class="p-absolute" style="right: 20px">
                                    <span class="score">100</span>점
                                </span>
                            </div>
                        </li>
                        <!-- <p class="text-grey mb0 text-right view-more">
                                <i class="fa-solid fa-ranking-star"></i>&nbsp;&nbsp;랭킹 더 보기
                            </p> -->
                        <span id="standing" class="text-grey mb0 text-right view-more">
                            <i class="fa-solid fa-ranking-star fontasm-i"></i>&nbsp;&nbsp;랭킹 더 보기
                        </span>
                    </ul>
                </div>
            </div>
            <div class="page-info-myinfo">
                <h3>나의 정보</h3>
                <div class="white-div vw30 vh40 p30">
                    <div class="myinfo">
                        <h4 class="m0 mb10">
                            <!-- # 옆에는 유저의 랭킹 표기하기! -->
                            #<span class="myinfo-standing">1</span> &nbsp;<span class="nickname">세계평화와국제기구</span>
                        </h4>
                        <div class="myinfo-profile flex mb15">
                            <p class="myinfo-country">US&nbsp;-&nbsp;</p>
                            <img class="country" src="./public/img/country/circle/America.svg" />
                        </div>

                        <div class="myinfo-score">
                            <p>
                                <span>현재 점수:&nbsp;</span><span class="score">100</span>점
                            </p>

                        </div>

                        <h4 class="m10">나의 한 마디</h4>
                        <div class="myinfo-determination">
                            인생 한 방이다!
                        </div>

                        <span id="info" class="text-grey mb0 text-right view-more">
                            <i class="fa-solid fa-info fontasm-i"></i>&nbsp;&nbsp;정보 더 보기
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

    // standing-info의 background-color를 #808080으로 번갈아가며 적용
    $('.standing-info').each((index, element) => {
        if (index % 2 === 0) {
            $(element).css('background-color', '#dbdcdc');
        }
    });
    </script>
</body>

</html>