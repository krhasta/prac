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
    <div id="game" class="page-main flex-c">

        <div id="gameResult" class="vw25 p30 white-box p-abs opa-0">
            <div class="w100 h100 p-rel">
                <h3 class="m0 mb30"><?php echo "$uname" ?>님의 손익 평가<br><span class="ticker"></span></h3>
                <h3 class="m0 mb15">초기 잔고: KRW&nbsp;<span id="initialBalance"></span></h3>
                <h3 class="m0 mb15">현재 잔고: KRW&nbsp;<span id="currentBalance"></span></h3>
                <h3 class="m0">손익비율: &nbsp;<span id="finalProfit"></span></h3>
                <i class="fas fa-xmark p-abs close"></i>
            </div>
        </div>
        <p id="user_balance" hidden><?php echo $account_balance ?></p>
        <div class="notice white-box p-abs vw20 centering no-select opa-0"></div>
        <div id="news" class="gray-box flex-c flex-colm no-select p-abs vw35 opa-0" style="height: 128px"><span
                class="w100 news-title">株主日報</span><br><span class="w100 news-content"></span>
        </div>

        <div id="chart-interFace" class="white-box flex-c p-rel">
            <div class="flex s-bet h100">
                <div class="flex flex-colm h100">
                    <h3 class="ticker-cont m0 w100" style="justify-content:left"><span class="ticker"></span><br><span
                            id="timer" class="font16"></span>
                    </h3>
                    <div id="chart" class="flex flex-colm" style="width: 700px; justify-content:center">
                    </div>
                </div>

                <div class="order flex s-eve">
                    <div id="stock-order">
                        <h3 class="m0 mb20"><span class="hide">잔고:</span> KRW
                            <span id="balance"></span>
                            <br>
                            <span id="balanceProfit" class="font16">&nbsp;</span>
                        </h3>
                        <div id="sp-sq" class="flex flex-colm vw15">
                            <div class="gray-box mb20 w100">
                                <p class="m0 stock">주가 - Stock Price</p>
                                <p class="game mt20 mb0">KRW&nbsp;<span id="price-stock"></span><br><span id="percent"
                                        class="font16"></span>
                                </p>
                                <p id="price_kr" class="mt20 mb0"></p>
                            </div>

                            <div class="gray-box w100">
                                <p class="m0 stock">주문수량 - Stock Quantity</p>
                                <div class="flex mt20 mb20"> <input id="quantity" type="number" class="game mb0"
                                        placeholder="수량 입력">
                                    <h3 class="m0 stock" style="margin-left:5px;">주</h3>
                                </div>
                                <p id="order-price" class="m0">주문금액:&nbsp;KRW&nbsp;<span id="price"></span></p>
                            </div>
                        </div>
                        <button class="white-box w100 btn-buy white mt20">매수</button>
                    </div>
                    <div id="order-list">
                        <h3 class="m0 mb20">
                            주문 목록
                            <br><span class="ticker-slice font16"></span>
                        </h3>
                        <div id="ol" class="w100">
                            <ul class="vw15 m0">
                            </ul>
                        </div>
                        <button class="white-box w100 btn-sell white mt20">매도</button>
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
</body>

</html>