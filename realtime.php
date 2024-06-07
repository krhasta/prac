<?php
include_once ('./constants.php');
header('Content-type: application/json');

$before_price = $_GET['before'];

$step = mt_rand(500, 1000);
mt_rand(0, 1) == 1 ? ($step * -1) : ($step + 1);

$response = array(
    "now" => $before_price + $step,
    "delta" => $step
);

print (json_encode($response));
?>