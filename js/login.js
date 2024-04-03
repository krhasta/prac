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

// font-awesome을 동적으로 생성
$('input[class="input-info"]').on('input', function (e) {
    switch (this.id) {
        case 'email-login':
            if (this.value !== '') {
                $('#f-' + this.id).addClass('show-o');
            } else $('#f-' + this.id).removeClass('show-o');
            break;
        case 'password-login':
            if (this.value !== '') {
                $('#f-' + this.id).addClass('show-o');
                $('#f-show-' + this.id).addClass('show-o');
            } else {
                $('#f-' + this.id).removeClass('show-o');
                $('#f-show-' + this.id).removeClass('show-o');
            }
    }
});

// 동적으로 생성된 .fa-xmark를 이벤트 버블링으로 처리함
$('.form-info').on('click', '.fa-xmark', function (e) {
    let clearNum = e.target.dataset.clear;
    $('.input-info').eq(clearNum).val('');
    $('#' + this.id).removeClass('show-o');

    // 비번칸의 x-mark를 클릭하면 fa-eye도 동시에 사라짐
    let tempInsertId = this.id.split('');
    tempInsertId.splice(2, 0, 's', 'h', 'o', 'w', '-');
    let insertId = tempInsertId.join('');
    $('#' + insertId).toggleClass('show-o');
});

$('.form-info').on('click', '.fontasm-v', function (e) {
    let showId = '#' + e.target.dataset.id;
    let toChange = $(showId).attr('type') === 'password' ? 'text' : 'password';
    $(showId).attr('type', toChange);

    // .fontasm-v 순서를 담은 dataset vnum
    let vNum = this.dataset.vnum;
    if ($('.fontasm-v').eq(vNum).hasClass('fa-eye')) {
        $('.fontasm-v').eq(vNum).addClass('fa-eye-slash');
        $('.fontasm-v').eq(vNum).removeClass('fa-eye');
    } else {
        $('.fontasm-v').eq(vNum).addClass('fa-eye');
        $('.fontasm-v').eq(vNum).removeClass('fa-eye-slash');
    }
});
