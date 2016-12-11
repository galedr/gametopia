<?php 

require_once('connectSQL.php');


$newsQuery = "SELECT * FROM news ORDER BY newsId DESC";
$newsRec = $pdo->query($newsQuery);

$pageRow_records = 15;
$num_pages = 1;

if(isset($_POST['pages']) && ($_POST['pages']) != ''){
	$num_pages = $_POST['pages'];
}
$startRow_records = ($num_pages - 1)*$pageRow_records;
$queryLimit = $newsQuery." LIMIT ".$startRow_records." , ".$pageRow_records;
$result = $pdo->query($queryLimit);
$count = $newsRec->rowCount();
$totalPages = ceil($count/$pageRow_records);

$returnHTML = array();
$retuenPages = array();

$returnHTML[] = '
					<tr>
						<td>新聞編號</td>
						<td>新聞標題</td>
						<td>發布日期</td>
						<td>新聞內容</td>
						<td>修改</td>
						<td>刪除</td>
					</tr>
				';


while($newsRow = $result->fetch(PDO::FETCH_ASSOC)){

	$returnHTML[] = '
						<tr>
							<td>'.$newsRow["newsId"].'</td>
							<td>'.$newsRow["newsTitle"].'</td>
							<td>'.$newsRow["newsDate"].'</td>
							<td>
								<button class="btn btn-default" onclick="location.href=`newsInfo.php?id='.$newsRow["newsId"].'`">新聞連結</button>
							</td>
							<td>
								<button class="btn btn-default" onclick="newsUpdate(`'.$newsRow["newsId"].'`)" data-toggle="modal" href="#newsUpdate">修改</button>
							</td>
							<td>
								<button class="btn btn-default" onclick="newsDelete(`'.$newsRow["newsId"].'`)">刪除</button>
							</td>
						</tr>
					';


}


if($num_pages > 1){

	$returnPages[] = '
						<li><a onclick="newsPageReload(1);">&laquo;</a></li>
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
									<li><a onclick="newsPageReload('.$i.');">'.$i.'</a></li>
								 ';

		}
	}
}

if($num_pages < $totalPages){

	$returnPages[] = '
						<li><a onclick="newsPageReload('.$totalPages.');">&raquo;</a></li>	
					 ';

}


$pages = implode($returnPages);

$data = implode($returnHTML);

echo json_encode(array('status'=>'success','data'=>$data,'pages'=>$pages));




 ?>