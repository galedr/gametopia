<?php
// error_reporting(E_ALL || ~E_NOTICE);
require_once('connectSQL.php');

if(isset($_POST["orderId"]) && ($_POST["orderId"]) != ""){
	$orderId = $_POST["orderId"];
}

$detailQuery = "SELECT * FROM order_list_detail WHERE orderId = '$orderId'";
$detailRec = $pdo->query($detailQuery);

$result = array();
while($detailRow = $detailRec->fetch(PDO::FETCH_ASSOC)){
	$orderId = $detailRow["orderId"];
	$proPrice = $detailRow["proPrice"];
	$quantity = $detailRow["quantity"];
	$result[] = "
				<tr>
				    <td>'.$orderId.'</td>
				    <td>'.$proPrice.'</td>
				    <td>'.$quantity.'</td>
			    </tr>
			  ";
}

$strArr = implode(" ", $result);

$returnHTML = "<tr>
		        <td>商品編號</td>
		        <td>商品單價</td>
		        <td>購買數量</td>
		      </tr>
     		  "."<br>".$strArr;

echo json_encode(array('status'=>'success','data'=>$returnHTML));

?>