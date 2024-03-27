// 반복문으로 함수 단순화 ㄱㄱ

document.addEventListener('DOMContentLoaded', function () {
    document.getElementById('a').addEventListener('click', function (event) {
        event.preventDefault();

        fetch('account.html')
            .then((response) => response.text())
            .then((html) => {
                document.querySelector('main').innerHTML = html;
            })
            .catch((error) => console.error('Error', error));
    });
});

document.addEventListener('DOMContentLoaded', function () {
    document.getElementById('b').addEventListener('click', function (event) {
        event.preventDefault();

        fetch('status.html')
            .then((response) => response.text())
            .then((html) => {
                document.querySelector('main').innerHTML = html;
            })
            .catch((error) => console.error('Error', error));
    });
});

document.addEventListener('DOMContentLoaded', function () {
    document.getElementById('c').addEventListener('click', function (event) {
        event.preventDefault();

        fetch('settings.html')
            .then((response) => response.text())
            .then((html) => {
                document.querySelector('main').innerHTML = html;
            })
            .catch((error) => console.error('Error', error));
    });
});
