$(document).ready(() => {
    const timer = document.getElementById('timer');
    let time = 180;
    let minutes;
    let seconds;
    const interval = setInterval(function () {
        minutes = parseInt(time / 60, 10);
        seconds = parseInt(time % 60, 10);

        minutes = minutes < 10 ? '0' + minutes : minutes;
        seconds = seconds < 10 ? '0' + seconds : seconds;

        timer.innerHTML = minutes + ':' + seconds;

        if (--time < 0) {
            clearInterval(interval);
            timer.innerHTML = '시간초과';
        }
    }, 1000);

    const korNum = (value) => {
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

    // input.game에 숫자를 입력할 때 마다 #price-stock의 값과 input의 값을 곱한 결과를 #price에 표기를 jQuery로 작성
    $('#quantity').on('input', function () {
        var price = $('#price-stock').text();
        // #price-stock의 ',' 제거
        price = price.replace(/,/g, '');
        var quantity = $('#quantity').val();
        var price = price * quantity;
        $('#price').text(addComma(price.toString()));
        // $('#price').text(price.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ','));
    });

    // #balance에 세 자리 수 마다 ',' 표기를 jQuery로 작성
    $('#balance').text(
        addComma($('#balance').text())
        // $('#balance').text().replace(/\B(?=(\d{3})+(?!\d))/g, ',')
    );

    function showNotice(pass = '#order-sell') {
        return new Promise((resolve) => {
            $(pass + '.notice').css('opacity', '1');
            setTimeout(() => {
                $(pass + '.notice').css('opacity', '0');
                resolve(); // setTimeout이 완료되면 Promise를 resolve합니다.
            }, 1500);
        });
    }

    function addNewOrderBox(quantity, orderPrice, totalPrice) {
        const orderList = $('#order-list ul li');
        console.log('------------------------------------');
        console.log(orderList.length);
        console.log('------------------------------------');
        // 현재 ul 태그 안에 있는 li 태그의 개수를 가져와서 data-order-list 속성을 설정
        const orderListLength = orderList.length;
        // const orderListLength = $('#order-list ul li').length;
        // 새로운 li 요소 생성
        const newLi = $(`<li id="order-box" class="gray-box w100 mb20" data-order-list="${orderListLength}"></li>`);
        // 내용 추가
        newLi.html(
            `<span>#${
                orderListLength + 1
            }</span><br><span class="quantity">${quantity}</span>주<br>체결단가: <span>${orderPrice}</span>&nbsp;KRW<br>총 금액: <span id="totalPrice">${totalPrice}</span>&nbsp;KRW<br>현재가: <span class="currentPrice">${addComma(
                quantity * rmComma(orderPrice)
            )}</span>&nbsp;KRW&nbsp;&nbsp;&nbsp;<span id="profit" style="float:right"></span>`
        );
        // 새로운 li 요소를 ul 태그의 자식으로 추가
        // order.append(newLi);
        $('#order-list ul').append(newLi);
    }

    async function orderProcess() {
        // 매수주문 효과음 재생
        const sfx = document.querySelector('#sfx_buy');
        sfx.currentTime = 0.05;
        sfx.play();

        const quantity = $('#quantity').val(); // input#quantity의 값을 가져옵니다.
        const order = quantity > 0;
        const balance = rmComma($('#balance').text());
        const price = $('#price-stock').text();
        const totalPrice = rmComma($('#price').text());
        const totalPriceText = addComma($('#price').text());

        const validQuantity = balance - totalPrice > 0;
        const pass = order && validQuantity ? '#order-cplt' : '#order-fail';
        const color = order && validQuantity ? '#32ff7e' : '#ff4d4d';
        const textColor = order && validQuantity ? "'color', '#000000'" : "'color', '#FFFFFF'";

        $('.notice-quantity').text($('#quantity').val());
        $('.notice-price').text(totalPriceText);
        $('.notice').css('background-color', color);
        $('.notice').css(textColor);
        if (order && validQuantity) {
            addNewOrderBox(quantity, price, totalPriceText);
            // #balance의 값을 #price만큼 뺀 값으로 변경
            $('#balance').text(addComma((balance - totalPrice).toString()));
        }

        $('input#quantity').val('');
        $('#price').text('0');
        await showNotice(pass); // showNotice 함수 실행
    }

    // 매수버튼 클릭 또는 엔터키 입력시 주문 실행
    $('.btn-buy').click(orderProcess);
    $('input#quantity').on('keyup', function (key) {
        if (key.keyCode == 13) {
            orderProcess();
        }
    });

    $('.btn-sell').click(function () {
        // 매도주문 효과음 재생
        const sfx = document.querySelector('#sfx_sell');
        sfx.currentTime = 0.05;
        sfx.play();

        // selected가 없을 때 매도할 경우 다른 알림 띄우기
        if ($('li.selected').length == 0) {
            $('.notice').css('background-color', '#ff4d4d');
            $('.notice').css('color', '#FFFFFF');
            $('.notice').text('매도할 주문을 선택해주세요');
            showNotice();
            return;
        }
        // 주문수량 가져오기
        const quantity = $('li.selected quantity').text();
        // 총 금액 가져오기
        const totalPriceText = $('li.selected').text().split('총 금액: ')[1];
        const currentPrice = rmComma($('li.selected .currentPrice').text());
        console.log('------------------------------------');
        console.log(parseInt(rmComma($('#balance').text())), parseInt(currentPrice));
        console.log('------------------------------------');
        // select 클래스가 붙은 li 태그의 totalPrice를 balance에 더하기
        $('li.selected').each(function () {
            $('#balance').text(addComma(parseInt(rmComma($('#balance').text())) + parseInt(currentPrice)));
        });

        // selected 클래스에 있던 li 태그의 정보들을 showNotice에 출력
        $('#order-sell').html(`*** 주문체결
            ***<br>매도수량:&nbsp;${quantity}주<br>${totalPriceText}<span
                class="order">&nbsp;매도</span><br>감사합니다`);
        showNotice();

        // select 클래스가 붙은 li 태그 삭제
        $('li.selected').remove();

        // data-order-list 재정렬
        $('#order-list ul li').each(function (index) {
            $(this).attr('data-order-list', index);
            $(this)
                .find('span')
                .eq(0)
                .text(`#${index + 1}`);
        });

        const balance = parseInt(rmComma($('#balance').text()));
        const balanceProfit = (((balance - initialBalance) / initialBalance) * 100).toFixed(2);

        console.log(balance, balanceProfit);

        $('#balanceProfit').text(balanceProfit + ' %');
        if (balanceProfit > 0) {
            $('#balanceProfit').css('color', '#32ff7e');
            $('#balanceProfit').text('+' + $('#balanceProfit').text());
        } else {
            $('#balanceProfit').css('color', '#ff4d4d');
        }
    });

    $('#order-list').on('click', 'li#order-box', function () {
        // 클릭된 li#order-box에만 selected 클래스를 토글합니다.
        $('li#order-box.selected').removeClass('selected');
        $(this).toggleClass('selected');
    });

    let priceStock = document.getElementById('price-stock'); // 감시 대상 노드 설정
    var config = {
        characterData: true,
        childList: true,
        subtree: true,
    }; // 감시할 변화 유형 설정

    // 변화 감지 시 실행할 콜백 함수
    var alterPriceStock = function (mutationsList, observer) {
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

                console.log('------------------------------------');
                console.log(parseFloat(priceStock));
                console.log('------------------------------------');

                $('#order-list ul li').each(function () {
                    const quantity = parseInt($(this).find('span').eq(1).text());
                    let currentPrice = quantity * priceStock;
                    $(this).find('.currentPrice').text(addComma(currentPrice));
                    currentPrice = parseInt(rmComma($(this).find('.currentPrice').text()));
                    const totalPrice = parseInt(rmComma($(this).find('#totalPrice').text()));
                    const profit = ((currentPrice - totalPrice) / totalPrice) * 100;
                    $(this)
                        .find('#profit')
                        .text(profit.toFixed(2) + '%');
                    if (profit > 0) {
                        $(this).find('#profit').css('color', '#32ff7e');
                    } else {
                        $(this).find('#profit').css('color', '#ff4d4d');
                    }
                });
            }
        }
    };

    // MutationObserver 인스턴스 생성 및 설정
    var observer = new MutationObserver(alterPriceStock);
    observer.observe(priceStock, config);
});
