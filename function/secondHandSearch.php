<?php
require_once("connectSQL.php");
error_reporting(E_ALL || ~E_NOTICE);

if(isset($_POST["gameConsole"]) && ($_POST["gameConsole"]) != ""){
	$gameConsole = $_POST["gameConsole"];
	if($gameConsole == 1){
		$sqlStr1 = "";
	}else{
		$sqlStr1 = " AND proSeries LIKE '%$gameConsole%'";
	}
}
if(isset($_POST["gameType"]) && ($_POST["gameType"]) != ""){
	$gameType = $_POST["gameType"];
	if($gameType == 1){
		$sqlStr2 = "";
	}else{
		$sqlStr2 = " AND proClass LIKE '%$gameType%'";
	}
}
if(isset($_POST["searchInfo"]) && ($_POST["searchInfo"]) != ""){
	$searchInfo = $_POST["searchInfo"];
	if($searchInfo == 1){
		$sqlStr3 = "";
	}else{
		$sqlStr3 = " AND proName LIKE '%$searchInfo%'";
	}
}

$sqlStr0 = "SELECT * FROM products WHERE proType = '二手'";
$searchQuery = $sqlStr0.$sqlStr1.$sqlStr2.$sqlStr3;
$searchRec = $pdo->query($searchQuery);

//計算搜尋結果
$searchCount = $searchRec->rowCount();
$dataHTML = array();

if($searchCount == 0){

		$dataHTML[] = '
						<div class="SH_productbox">
							<div class="productInfoarea">
								<h2>
									很抱歉，您的搜尋條件找不到結果，請重新搜尋
								</h2>
							</div>
						</div>

					  ';

	}else{
		while($searchRow = $searchRec->fetch(PDO::FETCH_ASSOC)){




			//判定遊戲主機
			if($searchRow["proSeries"] == 'PS'){
				$seriesId = "gameMomPS";
			}elseif($searchRow["proSeries"] == 'XBOX'){
				$seriesId = "gameMomXBOX";
			}elseif($searchRow["proSeries"] == '掌機'){
				$seriesId = "gameMom3DS";
			}elseif($searchRow["proSeries"] == 'PC'){
				$seriesId = "gameMomPC";
			}

			$dataHTML[] = '
						<div class="SH_productbox">
							<div class="SH_productImg"><img src="'.$searchRow["proImg"].'" alt="" onclick="location.href=`SH_productEx.php?proId='.$searchRow["proId"].'`"></div>
							<div class="productInfoarea">
								<div class="SH_productContent">
									<h2 id="SH_productName">'.$searchRow["proName"].'</h2>
									<div class="tags">
						                <span class="gameMom" id="'.$seriesId.'">'.$searchRow["proSeries"].'</span>
									</div>
									<div class="pricebox"><span id="price">'.$searchRow["proPrice"].'</span>元</div>
									<div class="memobox">
										<p id="memo">'.$searchRow["proInfo"].'</p>
									</div>
								</div>
								<div class="paybar">
									<div class="paybox">
										<span id="addCart_'.$searchRow["proId"].'" class="add_Cart" onclick="searchAndAddCart(`'.$searchRow["proId"].'`)">加入購物車</span>
										<input type="hidden" name="proId" value="'.$searchRow["proId"].'">
									</div>
									<div class="clearBoth"></div>
								</div>
							</div>
						</div>
						';

		}

	}


$result = implode("", $dataHTML);

echo json_encode($result);


?>