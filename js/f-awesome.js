// 동적으로 생성된 .fa-xmark를 이벤트 위임으로 처리함
// 이벤트 위임 아님?
$('.form-info').on('click', '.fa-xmark', function (e) {
    let clearNum = e.target.dataset.clear;
    console.log('------------------------------------');
    console.log(clearNum);
    console.log('------------------------------------');
    // $('.input-info').eq(clearNum).val('');
    // e.target.dataset.clear번째의 값 비우기
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
