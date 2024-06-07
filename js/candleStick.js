google.charts.load('current', { 'packages': ['corechart'] });
google.charts.setOnLoadCallback(drawChart);

let priceData = [];

function drawChart(title='aaa', value) {
    var data = google.visualization.arrayToDataTable([
        // ['레이블', 저가, 시가, 종가, 고가]
        ['', 10, 30, 0, value],
        ['', 10, 30, 0, 250],
        ['', 53, 30, value, 3],
        ['', 10, value, 0, 39],
        ['', 55, 30, value, 353],
        ['', 10, 30, 0, value],
        ['', 10, 30, 0, 250],
        ['', 53, 30, value, 3],
        ['', 10, value, 0, 39],
        ['', 55, 30, value, 353],
        ['', 10, 30, 0, value],
        ['', 10, 30, 0, 250],
        ['', 53, 30, value, 3],
        ['', 10, value, 0, 39],
        ['', 55, 30, value, 353],
    ], true);

    var options = {
        legend: 'none',
        bar: { groupWidth: '60%' }, // Remove space between bars.
        candlestick: {
            fallingColor: { strokeWidth: 0, fill: '#3182F6' }, // red
            risingColor: { strokeWidth: 0, fill: '#F04452' }   // green
        },
        chartArea: { width: '85%' },
        title,
        titleTextStyle: { fontSize: 24 },
    };
    var chart = new google.visualization.CandlestickChart(document.getElementById('chart_div'));
    chart.draw(data, options);
}

setInterval(async () => {
    drawChart('BTC', Math.floor(Math.random() * 100));
}, 500);