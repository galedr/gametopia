<?php

require_once('connectSQL.php');

$replyQuery = "SELECT * FROM com_reply WHERE status = '檢舉' ORDER BY replyId DESC";
$replyRec = $pdo->query($replyQuery);

$pageRow_records = 5;
$num_pages = 1;

if(isset($_POST['pages']) && ($_POST['pages']) != ''){
	$num_pages = $_POST['pages'];
}
$startRow_records = ($num_pages - 1)*$pageRow_records;
$queryLimit = $replyQuery." LIMIT ".$startRow_records." , ".$pageRow_records;
$result = $pdo->query($queryLimit);
$count = $replyRec->rowCount();
$totalPages = ceil($count/$pageRow_records);

$returnHTML = array();
$retuenPages = array();


$returnHTML[] = '
					<caption>討論內文</caption>
					<tr>
						<td>編號</td>
						<td>發文者</td>
						<td>文章內容</td>
						<td>發布日期</td>
						<td>狀態</td>
						<td>恢復</td>
						<td>刪除</td>
					</tr>
				';

while($replyRow = $result->fetch(PDO::FETCH_ASSOC)){

	$returnHTML[] = '
						<tr>
							<td>'.$replyRow["replyId"].'</td>
							<td>'.$replyRow["memAcc"].'</td>
							<td>
								<button class="btn btn-default" data-toggle="modal" href="#reportInfo" onclick="replyInfo(`'.$replyRow["replyId"].'`)">文章內容</button>
							</td>
							<td>'.$replyRow["replyDate"].'</td>
							<td>'.$replyRow["status"].'</td>
							<td>
								<button class="btn btn-default" onclick="replyRestore(`'.$replyRow["replyId"].'`)">恢復</button>
							</td>
							<td>
								<button class="btn btn-default" onclick="replyDelete(`'.$replyRow["replyId"].'`)">刪除</button>
							</td>
						</tr>
					';

}

if($num_pages > 1){

	$returnPages[] = '
						<li><a onclick="replyPageReload(1);">&laquo;</a></li>
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
									<li><a onclick="replyPageReload('.$i.');">'.$i.'</a></li>
								 ';

		}
	}
}

if($num_pages < $totalPages){

	$returnPages[] = '
						<li><a onclick="replyPageReload('.$totalPages.');">&raquo;</a></li>	
					 ';

}


$pages = implode($returnPages);

$data = implode($returnHTML);

echo json_encode(array('status'=>'success','data'=>$data,'pages'=>$pages));




?>