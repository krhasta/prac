$('form').on('submit', function (e) {
    e.preventDefault();

    fetch('http://scalper.0xff.kr/interface/auth.php?action=signin', {
        method: 'POST',
        headers: {
            'Content-type': 'application/json',
        },
        body: JSON.stringify({
            username: 'john@daejin.ac.kr',
            password: 'asdf1234!@#$',
        }),
    })
        .then((response) => response.json())
        .then((res) => console.log(res))
        .catch((err) => console.log('Error!', err));
});

// document.querySelector('button').addEventListener('click', function (event) {
//     event.preventDefault();
//     fetch('http://scalper.0xff.kr/interface/auth.php?action=signin', {
//         method: 'POST',
//         headers: {
//             'Content-type': 'application/json',
//         },
//         body: JSON.stringify({
//             username: 'john@daejin.ac.kr',
//             password: 'asdf1234!@#$',
//         }),
//     })
//         .then((response) => response.json())
//         .then((res) => console.log(res))
//         .catch((err) => console.log('Error ㅠㅠ', err));
// });
