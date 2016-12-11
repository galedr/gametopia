<?php

require_once('connectSQL.php');

$comQuery = "SELECT * FROM comments WHERE status = '檢舉' ORDER BY comId DESC";
$comRec = $pdo->query($comQuery);

$pageRow_records = 5;
$num_pages = 1;

if(isset($_POST['pages']) && ($_POST['pages']) != ''){
	$num_pages = $_POST['pages'];
}
$startRow_records = ($num_pages - 1)*$pageRow_records;
$queryLimit = $comQuery." LIMIT ".$startRow_records." , ".$pageRow_records;
$result = $pdo->query($queryLimit);
$count = $comRec->rowCount();
$totalPages = ceil($count/$pageRow_records);

$returnHTML = array();
$retuenPages = array();


$returnHTML[] = '
					<caption>討論區</caption>
					<tr>
						<td>編號</td>
						<td>發文者</td>
						<td>文章位置</td>
						<td>文章標題</td>
						<td>文章內容</td>
						<td>發文日期</td>
						<td>狀態</td>
						<td>恢復</td>
						<td>刪除</td>
					</tr>
				';

while($comRow = $result->fetch(PDO::FETCH_ASSOC)){

	$returnHTML[] = '
						<tr>
							<td>'.$comRow["comId"].'</td>
							<td>'.$comRow["memAccount"].'</td>
							<td>'.$comRow["comPlatform"].'</td>
							<td>'.$comRow["comTitle"].'</td>
							<td>
								<button class="btn btn-default" data-toggle="modal" href="#reportInfo" onclick="comInfo(`'.$comRow["comId"].'`)">文章內容</button>
							</td>
							<td>'.$comRow["comDate"].'</td>
							<td>'.$comRow["status"].'</td>
							<td>
								<button class="btn btn-default" onclick="comRestore(`'.$comRow["comId"].'`)">恢復</button>
							</td>
							<td>
								<button class="btn btn-default" onclick="comDelete(`'.$comRow["comId"].'`)">刪除</button>
							</td>
						</tr>
					';

}

if($num_pages > 1){

	$returnPages[] = '
						<li><a onclick="comPageReload(1);">&laquo;</a></li>
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
									<li><a onclick="comPageReload('.$i.');">'.$i.'</a></li>
								 ';

		}
	}
}

if($num_pages < $totalPages){

	$returnPages[] = '
						<li><a onclick="comPageReload('.$totalPages.');">&raquo;</a></li>	
					 ';

}


$pages = implode($returnPages);

$data = implode($returnHTML);

echo json_encode(array('status'=>'success','data'=>$data,'pages'=>$pages));




?>