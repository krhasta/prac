// fetch를 사용해서 navbar를 동적으로 불러옴
document.addEventListener('DOMContentLoaded', function () {
    fetch('/modules/navbar.html')
        .then((response) => response.text())
        .then((navbar) => (document.querySelector('nav').innerHTML = navbar))
        .catch((error) => console.error('navbar를 불러오지 못했습니다.', error));
});

// navbar에 있는 "로그인하세요"버튼 누르면 모달창 열림
// 동적으로 불러온 navbar에 상위요소인 document를 이용해서 이벤트를 위임함
$(document).on('click', '#open-modal', function () {
    $('.modal').toggleClass('hide');
});

// 모달창 바깥 클릭하면 모달창 닫힘
$('.modal').click(function (e) {
    if (e.target == $('.modal').get(0)) {
        $('.modal').toggleClass('hide');
    }
});

// 천하제일 단타대회 메인 타이틀 누르면 홈으로
$(document).on('click', '.nav-title', function () {
    window.location = '/index.html';
});
