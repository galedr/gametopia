<?php

require_once('connectSQL.php');

$url = $_SERVER['HTTP_REFERER'];


if(isset($_GET["orderId"]) && ($_GET["orderId"]) != ""){
	$orderId = $_GET["orderId"];
}

$overallQuery = "UPDATE order_list_overall SET status = '已出貨' WHERE orderId = '$orderId'";
$overallRec = $pdo->query($overallQuery);

$detailQuery = "UPDATE order_list_detail SET status = '已出貨' WHERE orderId = '$orderId'";
$detailRec = $pdo->query($detailQuery);

header("location: $url");

?>