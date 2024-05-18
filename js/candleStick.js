google.charts.load('current', {'packages': ['corechart']});
google.charts.setOnLoadCallback(drawChart);

function drawChart() {
    var data = google.visualization.arrayToDataTable([
        ['Mon', 101, 101, 232, 232],
        ['Tue', 232, 232, 353, 353],
        ['Wed', 353, 353, 77, 77],
        ['Thu', 77, 77, 66, 66],
        ['Fri', 66, 66, 22, 22],
        ['Aaa', 66, 66, 535, 535],
        ['Bbb', 535, 535, 264, 264],
        ['Mon', 101, 101, 232, 232],
        ['Tue', 232, 232, 353, 353],
        ['Wed', 353, 353, 77, 77],
        ['Thu', 77, 77, 66, 66],
        ['Fri', 66, 66, 22, 22],
        ['Aaa', 66, 66, 535, 535],
        ['Bbb', 535, 535, 264, 264],
    ], true);

    var options = {
        legend: 'none',
        bar: {groupWidth: '50%'}, // Remove space between bars.
        candlestick: {
            fallingColor: {strokeWidth: 0, fill: '#F28B82'}, // red
            risingColor: {strokeWidth: 0, fill: '#81C995'}   // green
        },
        chartArea: {width: '85%'},
        title:"xxx",
        titleTextStyle:{fontSize: 24},
    };
    var chart = new google.visualization.CandlestickChart(document.getElementById('chart_div'));
    chart.draw(data, options);
}