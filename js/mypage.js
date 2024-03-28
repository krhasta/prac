// 함수 단순화 ㄱㄱ

document.addEventListener('DOMContentLoaded', function () {
    document.getElementById('a').addEventListener('click', function (event) {
        event.preventDefault();

        fetch('/modules/account.html')
            .then((response) => response.text())
            .then((html) => {
                document.querySelector('main').innerHTML = html;
            })
            .catch((error) => console.error('Error', error));
    });

    document.getElementById('b').addEventListener('click', function (event) {
        event.preventDefault();

        fetch('/modules/status.html')
            .then((response) => response.text())
            .then((html) => {
                document.querySelector('main').innerHTML = html;
            })
            .catch((error) => console.error('Error', error));
    });

    document.getElementById('c').addEventListener('click', function (event) {
        event.preventDefault();

        fetch('/modules/settings.html')
            .then((response) => response.text())
            .then((html) => {
                document.querySelector('main').innerHTML = html;
            })
            .catch((error) => console.error('Error', error));
    });
});
