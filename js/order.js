$(document).ready(function () {
    const korNum = function (value) {
        const resultValue = [];
        const unit1 = ['', '만', '억', '조'];
        const unit2 = ['', '십', '백', '천', '만'];
        const numData = ['영', '일', '이', '삼', '사', '오', '육', '칠', '팔', '구'];

        const valueStr = value + '';
        const unit1Size = Math.ceil(valueStr.length / 4);

        const splitReverse = valueStr.split('').reverse();

        for (let i = 0; i < unit1Size; i++) {
            const number = splitReverse.splice(0, 4);
            let result = number
                .map((num, idx) => (num != 0 ? numData[num] + unit2[idx] : ''))
                .reverse()
                .join('');
            if (result) result += unit1[i];
            resultValue.unshift(result);
        }
        return resultValue.join('');
    };

    $('#balance').text(parseInt($('#user_balance').text()));
    let initialBalance = $('#balance').text().replace(/\D/g, '');

    function rmComma(query) {
        return query.replace(/,/g, '');
    }

    function addComma(query) {
        return query.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ',');
    }

    function timeOver() {
        const timeText = $('#timer').text();
        if (timeText === '시간초과') {
            showNotice('시간이 초과됐습니다.');
            return true;
        }
    }

    // input.game에 숫자를 입력할 때 마다 #price-stock의 값과 input의 값을 곱한 결과를 #price에 표기를 jQuery로 작성
    $('#quantity').on('input', function () {
        var price = $('#price-stock').text();
        // #price-stock의 ',' 제거
        price = price.replace(/,/g, '');
        var quantity = $('#quantity').val();
        var price = price * quantity;
        $('#price').text(addComma(price.toString()));
    });

    // #balance에 세 자리 수 마다 ',' 표기를 jQuery로 작성
    $('#balance').text(addComma($('#balance').text()));

    function showNotice(notice = '주문이 체결되었습니다.') {
        $('.notice').css('z-index', '100');
        $('.notice').css('opacity', '1');
        setTimeout(function () {
            setTimeout(function () {
                $('.notice.centering').css('z-index', '1');
                resolve();
            }, 300);
            $('.notice').css('opacity', '0');
        }, 1500);
        $('.notice').text(notice);
    }

    function addNewOrderBox(quantity, orderPrice, totalPrice) {
        const orderList = $('#order-list ul li');
        let time = $('#timer').text();
        // 현재 ul 태그 안에 있는 li 태그의 개수를 가져와서 data-order-list 속성을 설정
        const orderListLength = orderList.length;
        // 새로운 li 요소 생성
        const newLi = $(`<li class="order-box gray-box w100 mb20" data-order-list="${orderListLength}"></li>`);
        // 내용 추가
        newLi.html(
            `KRW&nbsp;&nbsp;<span>#${
                orderListLength + 1
            }</span>&nbsp;&nbsp;<span class="quantity">${quantity}</span>주&nbsp;-&nbsp;<i class="fas fa-stopwatch"></i>&nbsp;${time}<br>체결단가: <span>${orderPrice}</span><br>
            총 금액: <span id="totalPrice">${totalPrice}</span><br>
            현재가: <span class="currentPrice">${addComma(quantity * rmComma(orderPrice))}</span><br>
            변동: <span id="profit"></span>`
        );
        // 새로운 li 요소를 ul 태그의 자식으로 추가
        $('#order-list ul').append(newLi);
        // 렌더링 될 때의 시간이 걸리는 관계로 .order-box가 렌더링 된 후에 opacity를 1로 지정
        $('.order-box').ready(function () {
            $('.order-box').css('opacity', '1');
        });
    }

    async function orderProcess() {
        if (timeOver()) {
            return;
        }

        const quantity = $('#quantity').val(); // input#quantity의 값을 가져옵니다.
        const order = quantity > 0;
        const balance = rmComma($('#balance').text());
        const price = $('#price-stock').text();
        const totalPrice = rmComma($('#price').text());
        const totalPriceText = addComma($('#price').text());
        const validQuantity = balance - totalPrice > 0;
        const check = order && validQuantity ? 'succ' : 'fail';
        const sfx = document.querySelector('#sfx_buy');
        sfx.currentTime = 0.05;

        if (check == 'succ') sfx.play(); // 매수주문 효과음 재생
        $('.notice-quantity').text($('#quantity').val());
        $('.notice-price').text(totalPriceText);
        if (order && validQuantity) {
            addNewOrderBox(quantity, price, totalPriceText);
            // #balance의 값을 #price만큼 뺀 값으로 변경
            $('#balance').text(addComma((balance - totalPrice).toString()));
        } else {
            await showNotice('올바른 수량을 입력해주세요');
            return;
        }

        $('input#quantity').val('');
        $('#price').text('0');
        await showNotice('주문이 체결되었습니다.');
    }

    // 매수버튼 클릭 또는 엔터키 입력시 주문 실행
    $('.btn-buy').click(orderProcess);
    $('input#quantity').on('keyup', function (key) {
        if (key.keyCode == 13) {
            orderProcess();
        }
    });

    $('.btn-sell').click(function () {
        if (timeOver()) {
            return;
        }

        if ($('li.selected').length == 0) {
            showNotice('매도할 주문을 선택해주세요!');
            return;
        }

        const sfx = document.querySelector('#sfx_sell');
        sfx.currentTime = 0.05;

        let totalQuantity = 0;
        let balance = parseInt(rmComma($('#balance').text()));

        $('li.selected').each(function () {
            const quantity = parseInt($(this).find('.quantity').text());
            const currentPrice = parseInt(rmComma($(this).find('.currentPrice').text()));
            totalQuantity += quantity;
            balance += currentPrice;
        });

        $('#balance').text(addComma(balance));
        showNotice();
        sfx.play();

        setTimeout(function () {
            $('li.selected').remove();
        }, 300);
        $('li.selected').css('opacity', '0');

        $('#order-list ul li').each(function (index) {
            $(this).attr('data-order-list', index);
            $(this)
                .find('span')
                .eq(0)
                .text(`#${index + 1}`);
        });

        const balanceProfit = (((balance - initialBalance) / initialBalance) * 100).toFixed(2);

        $('#balanceProfit').text(balanceProfit + ' %');
        if (balanceProfit > 0) {
            $('#balanceProfit').css('color', '#2ecc71');
            $('#balanceProfit').text('+' + $('#balanceProfit').text());
        } else {
            $('#balanceProfit').css('color', '#ff4d4d');
        }
    });

    $('#order-list').on('click', 'li.order-box', function () {
        $(this).toggleClass('selected');
    });

    $('.close').click(function () {
        $('#gameResult').css('opacity', '0');
    });

    let priceStock = document.getElementById('price-stock'); // 감시 대상 노드 설정
    const config = {
        characterData: true,
        childList: true,
        subtree: true,
    }; // 감시할 변화 유형 설정

    // 변화 감지 시 실행할 콜백 함수
    const alterPriceStock = function (mutationsList, observer) {
        for (var mutation of mutationsList) {
            if (mutation.type === 'childList' || mutation.type === 'characterData') {
                const price = $('#price');
                const priceStockText = $('#price-stock').text();
                const priceStock = parseFloat(rmComma(priceStockText));
                const quantity = parseInt($('#quantity').val());
                const totalPrice = priceStock * quantity;
                price.text(isNaN(totalPrice) ? 0 : totalPrice); // #price 업데이트
                price.text(addComma(price.text())); // #price의 값을 세 자리 단위로 ',' 구분
                $('#price_kr').text(korNum(priceStock) + ' 원');
                $('#order-list ul li').each(function () {
                    const quantity = parseInt($(this).find('span').eq(1).text());
                    let currentPrice = quantity * priceStock;
                    $(this).find('.currentPrice').text(addComma(currentPrice));
                    currentPrice = parseInt(rmComma($(this).find('.currentPrice').text()));
                    const totalPrice = parseInt(rmComma($(this).find('#totalPrice').text()));
                    const diff = currentPrice - totalPrice;
                    const profit = Math.abs(diff / totalPrice) * 100;
                    if (diff > 0) {
                        $(this)
                            .find('#profit')
                            .text('+' + addComma(diff) + ' ' + '(' + profit.toFixed(2) + ')%');
                        $(this).find('#profit').css('color', '#2ecc71');
                    } else {
                        $(this)
                            .find('#profit')
                            .text(addComma(diff) + ' ' + '(' + profit.toFixed(2) + ')%');
                        $(this).find('#profit').css('color', '#ff4d4d');
                    }
                });
            }
        }
    };

    const observer = new MutationObserver(alterPriceStock);
    observer.observe(priceStock, config);

    // MutationObserver를 사용하여 #ol>ul과 #sp-sq의 높이 차이 감지 및 동기화
    // 1. 감지할 대상 요소 선택
    // 2. Observer의 콜백 함수 정의
    // 3. MutationObserver 인스턴스 생성 및 설정
    // 4. Observer 설정: attributes 변화 감지, 자식 요소의 변화 또는 추가 감지
    // 5. Observer 실행: #sp-sq 요소에 대해 감지 시작

    const targetElement = document.querySelector('#sp-sq');
    const adjustHeight = function (mutationsList, obs) {
        // #sp-sq의 높이 가져오기
        const targetHeight = $('#sp-sq').height();
        // #ol>ul의 현재 높이와 #sp-sq의 높이 비교 후 다를 경우 업데이트
        if ($('#ol ul').height() !== targetHeight) {
            $('#ol ul').height(targetHeight);
        }
    };
    const obs = new MutationObserver(adjustHeight);
    obs.observe(targetElement, config);

    // MutationObserver를 사용하여 $('#timer').text() === "시간초과" 감지 후 알림창 띄우기
    // 1. 감지할 대상 요소 선택
    // 2. Observer의 콜백 함수 정의
    // 3. MutationObserver 인스턴스 생성 및 설정
    // 4. Observer 설정: attributes 변화 감지, 자식 요소의 변화 또는 추가 감지
    // 5. Observer 실행: #sp-sq 요소에 대해 감지 시작

    // 1. 감지 대상 요소 선택
    const time = document.querySelector('#timer');

    // 2. Observer의 콜백 함수 정의
    const showResult = function () {
        if (time.innerText === '시간초과') {
            // 모든 #order-list 판매
            let userBalance = $('#user_balance').text();
            $('#order-list ul li').each(function () {
                const quantity = parseInt($(this).find('.quantity').text());
                const currentPrice = parseInt(rmComma($(this).find('.currentPrice').text()));
                const initBalance = parseInt(userBalance);
                console.log(initBalance);
                const currBalance = parseInt(rmComma($('#balance').text()));
                $('#balance').text(addComma(currBalance + currentPrice));
                setTimeout(function () {
                    $('li').remove();
                }, 300);
                $('li').css('opacity', '0');
            });
            $('#gameResult').css({ opacity: '1', 'z-index': '99' });
            $('#initialBalance').text(addComma(parseInt(userBalance)));
            $('#currentBalance').text($('#balance').text());

            // alterPriceStock의 diff와 비슷하게 #finalProfit에 가격 차이와 비율 표시
            const initialBalance = parseInt(rmComma($('#initialBalance').text()));
            const currentBalance = parseInt(rmComma($('#currentBalance').text()));
            const diff = currentBalance - initialBalance;
            const diffP = Math.abs((diff / initialBalance) * 100).toFixed(2);
            const diffText = diff.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ',');

            const resultProcRes = fetch('http://203.237.81.64/wdwp-final/phputils/gameResultProc.php?delta=' + diff)
                .then((response) => response.json())
                .then((data) => {
                    console.info('게임 결과가 반영되었습니다.');
                    data.status;
                })
                .catch((error) => console.error('Error:', error));

            if (diff > 0) {
                $('#finalProfit, #balanceProfit').css('color', '#2ecc71');
                $('#finalProfit, #balanceProfit').text('+' + diffText + ' (' + diffP + '%)');
            }
            if (diff < 0) {
                $('#finalProfit, #balanceProfit').css('color', '#ff4d4d');
                $('#finalProfit, #balanceProfit').text(diffText + ' (' + diffP + '%)');
            }
        }
    };

    // 3. MutationObserver 인스턴스 생성 및 설정
    const timeObs = new MutationObserver(showResult);
    timeObs.observe(time, config);
});
