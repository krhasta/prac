
const email_regex = /^[A-Za-z0-9_\.\-]+@[A-Za-z0-9\-]+\.[A-Za-z0-9\-]+/;
const pass_regex = /^(?=.*[a-z])(?=.*[0-9])(?=.*[A-Z])(?=.*[!@#$%^&*()]).{8,16}$/;
const phone_regex = /^010\d{8}$/;
const test_korean = /^([가-힣]){3,12}$/;

function showXMark(input_val, check) {
    let f_inp = '#f-' + input_val;
    let showEye = '#f-show-' + input_val;
    $(showEye).addClass('show-o');
    $(f_inp).addClass('show-o');
    if (check) {
        $(f_inp).removeClass('fa-xmark red');
        $(f_inp).addClass('fa-check green');
    } else {
        $(f_inp).removeClass('fa-check green');
        $(f_inp).addClass('fa-xmark red');
    }
}

$('input[class="input-info"]').on('input', function () {
    switch (this.id) {
        case 'email':
            showXMark(this.id, email_regex.test($(this).val()));
            break;
        case 'password':
            $('#f-show-' + this.id).addClass('show');
            let checkPassword = pass_regex.test($(this).val());
            showXMark(this.id, checkPassword);
            showXMark('confirm-password', $('#password').val() === $('#confirm-password').val());
            break;
        case 'confirm-password':
            $('#f-show-confirm-' + this.id).addClass('show');
            showXMark(this.id, $('#password').val() === $(this).val());
            break;
        case 'username':
            showXMark(this.id, test_korean.test($(this).val()));
            break;
        case 'phone':
            showXMark(this.id, phone_regex.test($(this).val()));
            break;
    }

    if ($('.fa-check').length === 5) {
        $('#goSignup').removeClass('disable');
    } else {
        $('#goSignup').addClass('disable');
    }
});

$('#create-username').on('click', function (e) {
    $('#username').val(koAliasGen());
    showXMark('username', test_korean.test($('#username').val()));
});

$('.disable').click((e) => {
    e.preventDefault();
});
