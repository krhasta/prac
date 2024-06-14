<?php
include_once ('../constants.php');
header('Content-type: application/json');

$before_price = $_GET['before'];

if ($before_price === NULL) {
    http_response_code(400);
    $response = array("message" => "파라미터가 없습니다.");
    echo json_encode($response, JSON_UNESCAPED_UNICODE);
    die();
}

$news_arr = [
    "한국은행: 대선을 앞두고 은행업종 주가가 강세를 유지할 것으로 예상",
    "국가간 AI 경쟁 본격 시작...우리세미콘 더 오를 수 밖에",
    "모건 스탠리의 추천 주식 종목에 포함된 서울반도체",
    "골드만 삭스, 주식 분할은 종종 직후 주가에 도움이 된다",
    "분기 적자 이후 흑자로 돌아선 현대전자 베트남 공장",
    "공매도 재개 기반 전산시스템 내년 3월 구축...제도개선 최종안 곧 발표",
    "우리생명, 중장기 주주환원 정책 기대",
    "1주에 15만원...하나전자 주가 어디까지 오를까",
    "주택 종부세 중과 대상자, 99%급감",
    "서울 급발진 의심 사고...신일모터스, \"객관성 없어, 법원서 밝혀질 것\"",
    "자녀회사에 인력 부당지원...제일조선 공정위 제재",
    "정일성 우리모터스 지분, 페이퍼컴퍼니에 넘겨...공정위",
    "동일금융그룹, 한일은행 이어 제4인뱅 검토",
    "한국은행, 3분기 GDP 0.8% 성장...전망치 상회",
    "여름철 더위 속 미국 천연가스 가격 상승, 수출 프로젝트는 지연 중",
    "미금제네틱스 주식 더 오를 수 있는 이유는?",
    "우리약품 주식 거래 중단, 성명 발표 대기 중"
];

// 가격 변동폭 결정
$step = mt_rand((int)(-1 * 0.02 * $before_price), (int)(0.02 * $before_price));
mt_rand(0, 1000) > 200 ? $step *= 2 : $step *= 1;

$response = array(
    "now"    => $before_price + $step,
    "delta"  => $step,
    "before" => $before_price,
    "news"   => $news_arr[mt_rand(0, (count($news_arr) * 70) - 1)]
);

echo json_encode($response, JSON_UNESCAPED_UNICODE);
?>