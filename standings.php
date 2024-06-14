<!DOCTYPE html>
<html lang="ko">
<?php include_once ('head_common.php') ?>

<body>
    <?php
    include_once ('nav.php');
    include_once ('./phputils/getRanks.php');
    ?>
    <div id="standings" class="page-main w65">
        <h2 class="mb25">Trading Standings</h2>
        <div class="page-info-standings flex-c">
            <div class="white-div w100 vh70 p30">
                <ul class="info-standings">
                    <h4 class="m0 pb10">Players - Top 10</h4>
                    <?php
                    # 잔고 상위 10명만 추려서 표시
                    $max_ranks = 10;
                    $current_rank = 1;
                    foreach ($now_ranks as $uname => $balance_ctry_pair) {
                        if ($current_rank == $max_ranks + 1)
                            break;
                        if ($current_rank <= 3) {
                            print ('
                                <li class="standing-info p-rel">
                                    <img class="country" src="./public/img/country/circle/' . $balance_ctry_pair[1] . '.svg" />
                                    <div class="standing-info-profile">
                                        <span class="standing-num ranker">#' . $current_rank . '</span> &nbsp;<span class="nickname ranker" 
                                        style="font-weight: 600">' . $uname . '님' . '</span><br>
                                        <span class="asset">' . number_format($balance_ctry_pair[0]) . '</span>원
                                    </div>
                                </li>
                            ');

                        } else {
                            print ('
                                <li class="standing-info p-rel">
                                    <img class="country" src="./public/img/country/circle/' . $balance_ctry_pair[1] . '.svg" />
                                    <div class="standing-info-profile">
                                        #<span class="standing-num">' . $current_rank . '</span> &nbsp;<span class="nickname">' . $uname . '님' . '</span><br>
                                        <span class="asset">' . number_format($balance_ctry_pair[0]) . '</span>원
                                    </div>
                                </li>
                            ');
                        }
                        $current_rank++;
                    }
                    ?>
                </ul>
            </div>
        </div>
    </div>
    <script>
    $('#gotoLogin').click(() => {
        location.href = 'login.php';
    });
    </script>
</body>

</html>