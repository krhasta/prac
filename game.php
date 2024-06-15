<?php
include_once ('constants.php');
include_once (DBCONN);
include_once ('./phputils/checkLogin.php');
session_start();

$email_from_session = $_SESSION['uname'];
$sql = "SELECT * FROM user WHERE uname = '$email_from_session'";
$result = $conn->query($sql);
if ($result->num_rows > 0)
    $row = $result->fetch_assoc();

$account_balance = $row['balance'];
?>

<html lang="ko">
<?php include_once ('head_common.php') ?>

<body>
    <?php include_once ('nav.php') ?>
    <div id="index" class="page-main vw80">
        <!-- <div id="gameResult" class="vw25 p30 white-div p-abs">
            <h3 class="m0 mb30"><?php echo "$uname" ?>님의 손익 평가</h3>
            <h3 id="initialBalance" class="m0 mb20">초기 잔고: </h3>
            <h3 id="currentBalance" class="m0 mb20">현재 잔고: </h3>
            <h3 id="profit" class="m0">손익: </h3>
        </div> -->
        <p id="user_balance" hidden><?php echo $account_balance ?></p>
        <div id="order-fail" class="notice p-abs vw20 centering opa-0 no-select">올바른 수량을
            입력해주세요.</span></div>

        <div id="order-cplt" class="notice p-abs vw20 centering opa-0 no-select">*** 주문체결
            ***<br>주문수량:&nbsp;<span class="notice-quantity"></span>주<br><span class="notice-price"></span>KRW&nbsp;<span
                class="order">&nbsp;매수</span><br>감사합니다
            </span></div>

        <div id="order-sell" class="notice p-abs vw20 centering opa-0 no-select">
            *** 주문체결
            ***<br>매도수량:&nbsp;<span class="notice-quantity"></span>주<br><span class="notice-price"></span>KRW&nbsp;<span
                class="order">&nbsp;매도</span><br>감사합니다
        </div>

        <h2 id="timer" class="mb25">03:00</h2>
        <div id="chart-interFace" class="white-div flex s-bet p-rel">
            <div id="chart" class="flex flex-c" style="width: 900px; height: 500px"></div>
            <div class="flex">
                <!-- <div id="stock-order" class="flex-colm" style="align-items: flex-start;"> -->
                <div id="stock-order">
                    <h3 class="m0 mb20">잔고: KRW
                        <span id="balance"></span> <span id="balanceProfit"></span>
                    </h3>
                    <div id="sp-sq" class="flex flex-colm vw15">
                        <div class="gray-box mb20 w100">
                            <p class="m0">주가 - Stock Price</p>
                            <p class="game mt20 mb0">KRW&nbsp;<span id="price-stock"></span></p>
                            <p id="price_kr" class="mt20 mb0"></p>
                        </div>

                        <div class="gray-box w100">
                            <p class="m0">주문수량 - Stock Quantity</p>
                            <div class="flex mt20 mb20"> <input id="quantity" type="number" class="game mb0"
                                    placeholder="수량 입력">
                                <h3 class="m0" style="margin-left:5px;">주</h3>
                            </div>
                            <h4 class="m0">주문금액:&nbsp;KRW&nbsp;<span id="price"></span></h4>
                        </div>
                    </div>
                    <button class="white-div w100 btn-buy black mt20">매수</button>
                </div>
                <div id="order-list">
                    <!-- <div id="order-list" style="align-items: flex-start;"> -->
                    <h3 class="m0 mb20">주문 목록</h3>
                    <div id="ol" class="w100" style="overflow-y:hidden;">
                        <ul class="vw15 m0">
                        </ul>
                    </div>
                    <button class="white-div w100 btn-sell white mt20">매도</button>
                </div>
            </div>
        </div>
    </div>
    <audio src="./sounds/buy.wav" id="sfx_buy"></audio>
    <audio src="./sounds/sell.wav" id="sfx_sell"></audio>
    <script src="./js/candleStick.js" type="text/javascript">
    </script>
    <script src="./js/f-login.js"></script>
    <script src="./js/order.js"></script>
    <script>
    $('#ol ul').height($('#sp-sq').height());
    </script>
</body>

</html>