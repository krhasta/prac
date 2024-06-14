// font-awesome을 동적으로 생성
$('input[class="input-info"]').on('input', function (e) {
    switch (this.id) {
        case 'email':
            if (this.value !== '') {
                $('#f-' + this.id).addClass('show-o');
            } else $('#f-' + this.id).removeClass('show-o');
            break;
        case 'password':
            if (this.value !== '') {
                $('#f-' + this.id).addClass('show-o');
                $('#f-show-' + this.id).addClass('show-o');
            } else {
                $('#f-' + this.id).removeClass('show-o');
                $('#f-show-' + this.id).removeClass('show-o');
            }
    }
});
