<?php

require_once('connectSQL.php');
error_reporting(E_ALL || ~E_NOTICE);

$url = $_SERVER['HTTP_REFERER'];


if(isset($_POST["orderId"]) && ($_POST["orderId"]) != ""){
	$orderId = $_POST["orderId"];
}

$overallQuery = "UPDATE order_list_overall SET status = '已出貨' WHERE orderId = '$orderId'";
$overallRec = $pdo->query($overallQuery);

$detailQuery = "UPDATE order_list_detail SET status = '已出貨' WHERE orderId = '$orderId'";
$detailRec = $pdo->query($detailQuery);

echo json_encode(array('status'=>'success'));

?>