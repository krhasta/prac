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

const price_indicator = document.getElementById('price-stock');
const news_content = document.getElementById('news');

const server = '/wdwp-final/phputils/realtime.php';
let leftTime = 150;

let browserWidth = $(window).width();
let candlesPerScr = 0;
candlesPerScr = browserWidth <= 700 ? 10 : 30;

const priceDataTemplate = () => ({
    createdAt: null,
    updateCount: 0,
    data: {
        high: 0,
        low: 0,
        open: 0,
        close: 0,
    },
});
let priceAcc = Array.from({ length: candlesPerScr }, priceDataTemplate);
let beforePrice = 23500;

const randStockName = () => {
    const [A, B] = [
        ['제일','일신','남광','하나로','경남','가람','우진','한마음','청호','안산','혜성','우리','새한','미래','한국','하나','푸른','현대','서울','한성','수성','한일','중앙','동양','금강','동서','남부','세종','유원','씨티','신명','수성','태극','동일','아남','한백','우성','신일','명진','삼영','영풍','성일','신우','반석','신신','성수','동보','태경','범진','대영','신보','목원','삼성','승일','현승','신성','한미','미금','신진','범한','신한','호국','우남','남동','극서','대진','혜강','대우','일우','진성','극동','21세기','신광','보광','한세','늘푸른','삼우','우신','금촌',],
        ['산전','전자','텔레콤','통상','조선','전기','통신','정유','모터스','자동차','홀딩스','산업','금융','통운','물류','식품','방송','시스템','솔루션','의료재단','리서치','엔터테인먼트','가스','무역','화학','정밀','수산','농수산','제약','축산','일렉','반도체','교육','게임즈','오일','제지','디지털','유리','마이크론','사이언스','증권','하이텍','농수산','에듀','생명','모빌리티','바이오','에너지','발전','신용평가','제네틱스','테크놀로지','종합엔지니어링','방송통신','통신','정보시스템즈','테크노글라스','해운','훼리','여객','도시가스','관광','환경','토건','건설','법률사무소','건축사무소','머티리얼즈','소재','계기','기공','컴퓨터','소프트웨어',],
    ];

    const IDX_A = parseInt(A.length * Math.random());
    const IDX_B = parseInt(B.length * Math.random());
    const stck_id = String(parseInt(Math.random() * 999999)).padStart(6, '0');

    return `(주) ${A[IDX_A]}${B[IDX_B]} (${stck_id})`;
};
const title = randStockName();

/* ================================ */
const updateRate = 750;
const maxUpdatesPerCandle = 10;

$(document).ready(() => {
    const timer = $('#timer');
    $('.ticker').text(title);
    $('.ticker-slice').html(title.slice(4, -9) + '&nbsp;<i class="fas fa-arrow-trend-up"></i>');
    let minutes, seconds;

    const interval = setInterval(() => {
        minutes = `${parseInt(leftTime / 60, 10)}`;
        seconds = `${parseInt(leftTime % 60, 10)}`;

        minutes = minutes.padStart(2, '0');
        seconds = seconds.padStart(2, '0');

        timer.html(`<i class="fas fa-stopwatch"></i>&nbsp;${minutes}:${seconds}`);

        if (leftTime - 1 < 0) {
            clearInterval(interval);
            timer.text('시간초과');
        }
        leftTime--;
    }, 1000);
});

var options = {
    series: [
        {
            data: priceAcc.map((item) => {
                return {
                    x: item.createdAt,
                    y: [item.data.open, item.data.high, item.data.low, item.data.close],
                };
            }),
        },
    ],
    chart: {
        type: 'candlestick',
        height: 350,
        toolbar: {
            show: false,
        },
    },
    title: {
        text: ' ',
        align: 'left',
    },
    xaxis: { type: 'datetime' },
    yaxis: { tooltip: { enabled: true } },

    plotOptions: {
        candlestick: {
            colors: {
                upward: '#2ecc71',
                downward: '#ff4d4d',
            },
            wick: {
                useFillColor: true,
            },
        },
    },
};

function updateAccData(newPrice) {
    const idx = priceAcc.length - 1;
    let currentCandle = priceAcc[idx];

    // 카운트 처리
    if (currentCandle.updateCount >= maxUpdatesPerCandle) {
        // console.log(`현재 카운트: ${currentCandle.updateCount}, 새 템플릿 추가`);
        priceAcc.shift();
        priceAcc.push(priceDataTemplate());
        currentCandle = priceAcc[idx];
    }

    // 시가 또는 종가인 경우
    if (currentCandle.updateCount === 0) {
        // 시가
        currentCandle.data.open = newPrice;
        currentCandle.data.high = newPrice;
        currentCandle.data.low = newPrice;
        // console.log('0 / 시가 저장');
        currentCandle.createdAt = new Date().getTime(); // 생성일시 추가
    } else {
        if (newPrice > currentCandle.data.high) {
            currentCandle.data.high = newPrice;
        }
        if (newPrice < currentCandle.data.low) {
            currentCandle.data.low = newPrice;
        }
    }

    currentCandle.data.close = newPrice; // 항상 종가로 최신 가격 업데이트
    currentCandle.updateCount++;
    // console.log(`현재 캔들 업데이트 횟수: ${currentCandle.updateCount}`);
}

let count = 0;
let initialPrice = 0;

setInterval(async () => {
    if (leftTime < 0) return;

    // 서버에서 데이터 받기
    await fetch(server + `?before=${beforePrice}`)
        .then((r) => r.json())
        .then((data) => {
            updateAccData(data.now);
            beforePrice = data.now;
            price_indicator.innerText = new String(data.now).replace(/\B(?=(\d{3})+(?!\d))/g, ',');
            if (count++ === 0) initialPrice = data.now;

            if (data.news != null) {
                console.log('[뉴스] ' + data.news);
                // news_content.innerText = '[뉴스] ' + data.news;
                // setTimeoutNews();
            }
        });

    // 받은 데이터 복사하고..
    options.series[0].data = priceAcc
        .map((item) => {
            if (
                item.createdAt &&
                item.data.open !== 0 &&
                item.data.high !== 0 &&
                item.data.low !== 0 &&
                item.data.close !== 0
            ) {
                return {
                    x: item.createdAt,
                    y: [item.data.open, item.data.high, item.data.low, item.data.close],
                };
            }
        })
        .filter((item) => item !== undefined); // Filter out undefined items

    // 차트 라이브러리 호출하여 화면 갱신
    window.chart.updateSeries([
        {
            data: options.series[0].data,
        },
    ]);
}, updateRate);

const chart = new ApexCharts(document.querySelector('#chart'), options);
chart.render();
window.chart = chart;

// define callback function
const showMutationPrice = function (mutationsList, obs) {
    const currPrice = parseInt($('#price-stock').text().replace(/,/g, ''));
    const initPrice = initialPrice;
    // console.log(initPrice, currPrice);
    const diff = currPrice - initPrice;
    // const diffP = ((diff / initPrice) * 100).toFixed(2);
    const diffP = Math.abs(((diff / initPrice) * 100).toFixed(2));
    const diffText = diff.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ',');

    if (diff > 0) {
        $('#percent').css('color', '#2ecc71');
        $('#percent').text('+' + diffText + ' (' + diffP + '%)');
    }

    if (diff < 0) {
        // 음수일 경우 diffP의 '-'기호 제거
        $('#percent').css('color', '#ff4d4d');
        $('#percent').text(diffText + ' (' + diffP + '%)');
    }
};

// create MutationObserver Instance
const priceObs = new MutationObserver(showMutationPrice);

const obsTarget = document.getElementById('price-stock');
const config = { attributes: true, childList: true, subtree: true };

priceObs.observe(obsTarget, config);
