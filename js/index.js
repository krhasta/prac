// navbar에 있는 "로그인하세요"버튼 누르면 모달창 열림
$('#open-modal, #open-modal-signup').click(function () {
    $('.modal').toggleClass('hide');
});

// 모달창 바깥 클릭하면 모달창 닫힘
$('.modal').click(function (e) {
    if (e.target == $('.modal').get(0)) {
        $('.modal').toggleClass('hide');
    }
});

// 천하제일 단타대회 메인 타이틀 누르면 홈으로
// $('.nav-title').click(function (e) {
//     window.location = 'index.html';
// });
