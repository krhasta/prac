<html lang="en">
<?php include_once ('head_common.php') ?>

<body>
    <nav class="w100">
        <div class="nav-main">
            <a class="nav-title" href="index.php">천하제일 단타대회</a>
            <a href="login.php" style="cursor: pointer"><i
                    class="fa-solid fa-arrow-right-to-bracket"></i>&nbsp;&nbsp;로그인하세요</a>
        </div>
    </nav>
    <div id="index" class="page-main vw65">
        <h2 class="main-Title">환영합니다!</h2>
        <div id="chart-interFace" class="white-div flex s-bet p-relative">
            <div id="chart_div" class="chart-google" style="width: 700px; height: 500px"></div>
            <div class="vertical"></div>
            <div class="flex flex-colm">
                <div class="flex flex-colm chart-control" style="justify-content: center">
                    <input class="input-info" type="text" name="" id="" placeholder="xxxx" />
                    <input class="input-info" type="text" name="" id="" placeholder="xxxx" />
                    <div class="flex s-eve w100">
                        <button class="white-div w50 btn-green" style="z-index: 4">매수</button>
                        <button class="white-div w50 btn-red" style="z-index: 5">매도</button>
                    </div>
                </div>
            </div>
            <span class="p-absolute" style="bottom: 20px; right: 20px">score: 1점</span>
        </div>
    </div>
    <script src="./js/candleStick.js" type="text/javascript"></script>
    <script src="./js/login.js"></script>
    <script>

    </script>
</body>

</html>