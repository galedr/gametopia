<?php
// error_reporting(E_ALL || ~E_NOTICE);
require_once('connectSQL.php');

if(isset($_POST["orderId"]) && ($_POST["orderId"]) != ""){
	$orderId = $_POST["orderId"];
}

$detailQuery = "SELECT * FROM order_list_detail WHERE orderId = '$orderId'";
$detailRec = $pdo->query($detailQuery);

$returnHTML = array();

$returnHTML[] = '
					<tr>
						<td>訂單編號</td>
						<td>商品圖</td>
						<td>商品名稱</td>
						<td>訂購數量</td>
						<td>商品單價</td>
						<td>小計</td>
					</tr>
				';

while($detailRow = $detailRec->fetch(PDO::FETCH_ASSOC)){
	
	$proId = $detailRow['proId'];
	$proQuery = "SELECT * FROM products WHERE proId = '$proId'";
	$proRec = $pdo->query($proQuery);

	while($proRow = $proRec->fetch(PDO::FETCH_ASSOC)){

		$semiTotal = $proRow['proPrice']*$detailRow['quantity'];

		$returnHTML[] = '
							<tr>
								<td>'.$detailRow["orderId"].'</td>
								<td>
									<img src="'.$proRow["proImg"].'" class="img-responsive detailImg">
								</td>
								<td>'.$proRow["proName"].'</td>
								<td>'.$detailRow["quantity"].'</td>
								<td>'.$proRow["proPrice"].'</td>
								<td>'.$semiTotal.'</td>
							</tr>
						';
	}					
}

$data = implode($returnHTML);

echo json_encode(array('status'=>'success','data'=>$returnHTML));

?>