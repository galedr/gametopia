<?php

require_once('connectSQL.php');


$orderQuery = "SELECT * FROM order_list_overall ORDER BY orderId DESC";
$orderRec = $pdo->query($orderQuery);

$pageRow_records = 15;
$num_pages = 1;

if(isset($_POST['pages']) && ($_POST['pages']) != ''){
	$num_pages = $_POST['pages'];
}
$startRow_records = ($num_pages - 1)*$pageRow_records;
$queryLimit = $orderQuery." LIMIT ".$startRow_records." , ".$pageRow_records;
$result = $pdo->query($queryLimit);
$count = $orderRec->rowCount();
$totalPages = ceil($count/$pageRow_records);

$returnHTML = array();
$retuenPages = array();

$returnHTML[] = '
					<tr style="height: 50px;">
						<td>訂單編號</td>
						<td>訂購人</td>
						<td>收貨人</td>
						<td>收貨人電話</td>
						<td>收貨人地址</td>
						<td>訂單總金額</td>
						<td>訂單狀態</td>
						<td>訂單內容</td>
						<td>通知出貨</td>
					</tr>
				';

while($orderRow = $result->fetch(PDO::FETCH_ASSOC)){

	$returnHTML[] = '
						<tr>
							<td>'.$orderRow["orderId"].'</td>
							<td>'.$orderRow["orderAccount"].'</td>
							<td>'.$orderRow["orderContecter"].'</td>
							<td>'.$orderRow["contecterPhone"].'</td>
							<td>'.$orderRow["contecterAddress"].'</td>
							<td>'.$orderRow["totalPrice"].'</td>
							<td>'.$orderRow["status"].'</td>
							<td>
								<button class="btn btn-default" onclick="orderDetail(`'.$orderRow["orderId"].'`);"  data-toggle="modal" href="#orderDetail">查看內容</button>
							</td>
							<td>
								<button class="btn btn-default" onclick="orderShipOut(`'.$orderRow["orderId"].'`);">出貨</button>
							</td>
						</tr>
					';

}

if($num_pages > 1){

	$returnPages[] = '
						<li><a onclick="orderPageReload(1);">&laquo;</a></li>
					 ';
}

$range = 3;

for($i = (($num_pages - $range) -1); $i < (($num_pages + $range) + 1); $i++){

	if(($i > 0) && ($i <= $totalPages)){

		if($i == $num_pages){

				$returnPages[] = '
									<li class="active"><a>'.$i.'</a></li>
								 ';


		}else{

				$returnPages[] = '
									<li><a onclick="orderPageReload('.$i.');">'.$i.'</a></li>
								 ';

		}
	}
}

if($num_pages < $totalPages){

	$returnPages[] = '
						<li><a onclick="orderPageReload('.$totalPages.');">&raquo;</a></li>	
					 ';

}

$pages = implode($returnPages);

$data = implode($returnHTML);

echo json_encode(array('status'=>'success','data'=>$data,'pages'=>$pages));

?>