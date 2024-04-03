$('form').on('submit', function (e) {
    e.preventDefault();
    const email = $('#email-login').val();
    const pass = $('#password-login').val();
    console.log(email, pass);

    fetch('http://scalper.0xff.kr/interface/auth.php?action=signin', {
        method: 'POST',
        headers: {
            'Content-type': 'application/json',
        },
        body: JSON.stringify({
            username: email,
            password: pass,
        }),
        mode: 'no-cors',
    })
        .then((response) => response.json())
        .then((res) => console.log(res))
        .catch((err) => console.log('Error!', err));
});

// function showXMark(input_val, check, str) {
//     let f_inp = '#f-' + input_val;
//     let showEye = '#f-show-' + input_val;
//     $(showEye).addClass('show-o');
//     $(f_inp).addClass('show-o');

//     switch (str) {
//         case 'login':
//             check ? $(f_inp).removeClass('fa-xmark') : $(f_inp).addClass('fa-xmark');
//             break;

//         default:
//             if (check) {
//                 $(f_inp).removeClass('fa-xmark red');
//                 $(f_inp).addClass('fa-check green');
//             } else {
//                 $(f_inp).removeClass('fa-check green');
//                 $(f_inp).addClass('fa-xmark red');
//             }
//             break;
//     }
// }

// signup page에서 로그인 모달을 띄울 때 문제가 생겨서
// showXMark 실행할 switch 문으로 통합
// $('input[class="input-info"]').on('input', function () {
//     switch (this.id) {
//         // this.id로 가져온 문자열을 '-'로 구분하여 마지막 문자열을 가져옴
//         // 이를 이용하여 input의 종류를 구분함

// font-awesome을 동적으로 생성
$('input[class="input-info"]').on('input', function (e) {
    switch (this.id) {
        case 'email-login':
            if (this.value !== '') {
                $('#f-' + this.id).addClass('show-o');
            } else $('#f-' + this.id).removeClass('show-o');
        case 'password-login':
            if (this.value !== '') {
                $('#f-' + this.id).addClass('show-o');
                $('#f-show-' + this.id).addClass('show-o');
            } else {
                $('#f-' + this.id).removeClass('show-o');
                $('#f-show-' + this.id).removeClass('show-o');
            }
        // if(e.target)
    }
});

// 동적으로 생성된 .fa-xmark를 이벤트 버블링으로 처리함
$('.form-info').on('click', '.fa-xmark', function (e) {
    let clearNum = e.target.dataset.clear;
    $('.input-info').eq(clearNum).val('');
    $('#' + this.id).removeClass('show-o');
    let insertId = this.id.split('');
    insertId.splice(2, 0, 's', 'h', 'o', 'w', '-');
    $('#' + insertId.join()).removeClass('show-o');
});

$('.form-info').on('click', '.fontasm-v', function (e) {
    let showId = '#' + e.target.dataset.id;
    let toChange = $(showId).attr('type') === 'password' ? 'text' : 'password';
    $(showId).attr('type', toChange);
});
