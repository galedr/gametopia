<?php

require_once('connectSQL.php');

$proQuery = "SELECT * FROM products ORDER BY id DESC";
$proRec = $pdo->query($proQuery);

$pageRow_records = 15;
$num_pages = 1;

if(isset($_POST['pages']) && ($_POST['pages']) != ''){
	$num_pages = $_POST['pages'];
}
$startRow_records = ($num_pages - 1)*$pageRow_records;
$queryLimit = $proQuery." LIMIT ".$startRow_records." , ".$pageRow_records;
$result = $pdo->query($queryLimit);
$count = $proRec->rowCount();
$totalPages = ceil($count/$pageRow_records);


$returnHTML = array();
$returnPages = array();

$returnHTML[] = '
					<tr style="height:50px;">
						<td>商品編號</td>
						<td>商品類別</td>
						<td>主機別</td>
						<td>遊戲類別</td>
						<td>商品名</td>
						<td>商品圖</td>
						<td>價格</td>
						<td>狀態</td>
						<td>修改</td>
						<td>刪除</td>
					</tr>
				';

while($proRow = $result->fetch(PDO::FETCH_ASSOC)){

	$returnHTML[] = '
						<tr>
							<td>'.$proRow["proId"].'</td>
							<td>'.$proRow["proType"].'</td>
							<td>'.$proRow["proSeries"].'</td>
							<td>'.$proRow["proClass"].'</td>
							<td>'.$proRow["proName"].'</td>
							<td>
								<img src="'.$proRow["proImg"].'" class="img-responsive proImg">
								<img src="'.$proRow["proPic01"].'" class="img-responsive proImg">
								<img src="'.$proRow["proPic02"].'" class="img-responsive proImg">
								<img src="'.$proRow["proPic03"].'" class="img-responsive proImg">
								
							</td>
							<td>'.$proRow["proPrice"].'</td>
							<td>'.$proRow["display"].'</td>
							<td>
								<button class="btn btn-default" onclick="proUpdate(`'.$proRow["proId"].'`);" data-toggle="modal" href="#updateProduct">修改</button>
							</td>
							<td>
								<button class="btn btn-default" onclick="proDelete(`'.$proRow["proId"].'`);">刪除</button>
							</td>
						</tr>
					';

} 

if($num_pages > 1){

	$returnPages[] = '
						<li><a onclick="proPageReload(1);">&laquo;</a></li>
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
									<li><a onclick="proPageReload('.$i.');">'.$i.'</a></li>
								 ';

		}
	}
}

if($num_pages < $totalPages){

	$returnPages[] = '
						<li><a onclick="proPageReload('.$totalPages.');">&raquo;</a></li>	
					 ';

}

$pages = implode($returnPages);

$data = implode($returnHTML);

echo json_encode(array('status'=>'success','data'=>$data,'pages'=>$pages));

?>