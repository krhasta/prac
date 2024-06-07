<!DOCTYPE html>
<html lang="en">
<?php include_once ('head_common.php') ?>

<body>
    <nav class="w100" style="background-color: rgb(202, 204, 176); height: 60px">
        <div class="nav-main">
            <p class="nav-title">천하제일 단타대회</p>
            <p id="open-modal" class="white-div" style="cursor: pointer">로그인하세요</p>
        </div>
    </nav>

    <div class="page-main w70">
        <h2 class="main-Title">MyPage</h2>
        <div class="flex s-bet" style="align-items: flex-start">
            <!-- <aside class="white-div flex flex-colm w15 h500"> -->
            <aside class="white-div w15" style="text-align: center">
                <a id="account" href="#">Account</a>
                <hr class="w100" />
                <a id="status" href="#">Status</a>
                <hr class="w100" />
                <a id="settings" href="#">Settings</a>
            </aside>
            <!-- <main class="white-div w80 h500"> -->
            <main class="w80 h500" style="overflow: visible">
                <iframe src="/modules/account.php" style="border: none" width="100%" frameborder="0"></iframe>
            </main>
        </div>
    </div>

    <script src="/js/index.js"></script>
    <script src="/js/login.js"></script>
    <script src="/js/mypage.js"></script>
</body>

</html>