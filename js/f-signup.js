const email_regex = /^[A-Za-z0-9_\.\-]+@[A-Za-z0-9\-]+\.[A-Za-z0-9\-]+/;
const pass_regex = /^(?=.*[a-z])(?=.*[0-9])(?=.*[A-Z])(?=.*[!@#$%^&*()]).{8,16}$/;
const phone_regex = /^010\d{8}$/;
const test_korean = /^([가-힣]){3,12}$/;
//  \s는 공백 포함

// input 정규식 체크 결과에 따라 font-awesome 폰트 변경
function showXMark(input_val, check, str) {
    let f_inp = '#f-' + input_val;
    let showEye = '#f-show-' + input_val;
    $(showEye).addClass('show-o');
    $(f_inp).addClass('show-o');
    switch (str) {
        case 'login':
            check ? $(f_inp).removeClass('fa-xmark') : $(f_inp).addClass('fa-xmark');
            break;

        default:
            if (check) {
                $(f_inp).removeClass('fa-xmark red');
                $(f_inp).addClass('fa-check green');
            } else {
                $(f_inp).removeClass('fa-check green');
                $(f_inp).addClass('fa-xmark red');
            }
            break;
    }
}

$('input[class="input-info"]').on('input', function () {
    console.log($('.fa-xmark').length);
    switch (this.id) {
        case 'email':
            let checkEmail = email_regex.test($(this).val());
            showXMark(this.id, checkEmail, null);
            break;

        case 'password':
            $('#f-show-' + this.id).addClass('show');
            let checkPassword = pass_regex.test($(this).val());
            showXMark(this.id, checkPassword, null);

            let checkDup = $('#password').val() === $('#confirm-password').val();
            // 비번확인칸이 안 비었을 경우에만 xMark를 띄워주세용~
            if ($('#confirm-password').val() !== '') {
                showXMark('confirm-password', checkDup, null);
            }

            // #password == #check-password여도
            // #password의 값이 변하면 #check-password에 xMark 부여
            break;

        case 'confirm-password':
            // 왜 '#' 안붙음??
            // $('f-show-confirm-' + this.id).addClass('show');
            $('#f-show-confirm-' + this.id).addClass('show');
            let password = $('#password').val();
            let confirmPassword = $(this).val();
            let checkConfirmPassword = password === confirmPassword; // 비번 확인 여부
            showXMark(this.id, checkConfirmPassword, null);
            break;

        case 'username':
            let username = $(this).val();
            let checkUsername = test_korean.test(username);
            showXMark(this.id, checkUsername, null);
            break;

        case 'phone':
            let checkPhone = phone_regex.test($(this).val());
            showXMark(this.id, checkPhone, null);
            break;
    }

    // fa-xmark 클래스를 가진 요소가 없는지 확인
    if ($('.fa-check').length === 5) {
        $('#goSignup').removeClass('disable');
    } else {
        $('#goSignup').addClass('disable');
    }
});

// 랜덤 닉네임 생성
$('#create-username').on('click', function (e) {
    $('#username').val(koAliasGen());
    let check = test_korean.test($('#username').val());
    console.log('------------------------------------');
    console.log(check);
    console.log('------------------------------------');
    showXMark('username', check, null);
});

// 닉네임 중복검사
$('#validate-username').on('click', function (e) {
    fetch('/wdwp-final/phputils/validateUsername.php?arg=' + $('#username').val())
        .then((response) => response.text())
        .then((data) => {
            if (data == '_TRUE') {
                alert('사용 가능한 닉네임입니다.');
            } else if (data == '_FALSE') {
                alert('이미 사용중인 닉네임입니다.');
            } else {
                alert('서버 오류가 발생했습니다.');
            }
        });
});

// 이메일 중복검사
$('#validate-email').on('click', function (e) {
    fetch('/wdwp-final/phputils/validateEmail.php?arg=' + $('#email').val())
        .then((response) => response.text())
        .then((data) => {
            if (data == '_TRUE') {
                alert('사용 가능한 이메일입니다.');
            } else if (data == '_FALSE') {
                window.confirm(
                    '이미 사용중인 이메일입니다.\n비밀번호를 잊으신 경우 "확인"을 클릭하여 비밀번호 찾기 페이지로 이동할 수 있습니다.'
                )
                    ? (location.href = `/wdwp-final/findAccount.php?email=${$('#email').val()}`)
                    : null;
            } else {
                alert('서버 오류가 발생했습니다.');
            }
        });
});

$('.disable').click((e) => {
    e.preventDefault();
});
