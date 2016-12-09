<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<link rel="stylesheet" type="text/css" href="css/forum.css">
	<link rel="stylesheet" type="text/css" href="css/header.css">
	<link rel="stylesheet" type="text/css" href="css/footer.css">
	<link rel="stylesheet" type="text/css" href="css/nav.css">
	<link href="https://fonts.googleapis.com/css?family=Exo+2" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css?family=Titillium+Web" rel="stylesheet">
	<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<link rel="Shortcut Icon" type="image/x-icon" href="images/gametopia.ico"/>
	<script src="js/jquery-3.1.0.min.js"></script>
	<script src="js/forum.js"></script>
	<script src="js/tagName.js"></script>
	<script src="js/objAdjust.js"></script>
	<title>討論區/遊戲烏托邦-Gametopia</title>
	<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0"><!-- 補上meta方便看RWD成果 -->
</head>
<body class="fo">

	<?php
	error_reporting( E_ALL || ~E_NOTICE);
	include("function/header.php");
	include("function/memberBarSwitcher.php");
	$platform = $_REQUEST["platform"];
	$platString = '';
	?>
<div class="forumContainer">
	<div class="banner"> <!-- 中間斜切BANNER -->
		<h1 class="consoleTitle">
			<?php  
				switch ($_REQUEST["platform"]) {
				case 'PS4':
					$platString = "PLAYSTATION";
					echo $platString;
					break;
				case 'XBOX':
					$platString = "XBOX";
					echo $platString;
					break;
				case 'PC':
					$platString = "PERSONAL COMPUTER";
					echo $platString;
					break;
				case '3DS':
					$platString = "HANDHELD";
					echo $platString;
					break;
				case 'mobile':
					$platString = "MOBILE";
					echo $platString;
					break;
				case 'Wii':
					$platString = "WII";
					echo $platString;
					break;
				}
			?>
		</h1>
		<h1 class="pageTitle">討論區</h1>
		<img src="<?php 
			switch ($_REQUEST["platform"]) {//判斷平台並給予img來源路徑
				case 'PS4':
					echo "images/ps4.png";
					break;
				case 'XBOX':
					echo "images/xbox360v.png";
					break;
				case 'PC':
					echo "images/pc.png";
					break;
				case '掌機':
					echo "images/n3ds.png";
					break;
				case 'mobile':
					echo "images/iphonese.png";
					break;
				case 'Wii':
					echo "images/wii_console.png";
					break;
			}
		?>">
		
	</div>
	

	<div class="forumContentbox">
	
		<div class="uiBtns"> <!-- 中間麵包屑+搜尋+發文 -->
			<div class="breadcrumbs">
				<a href="index.php">HOME</a> &gt; <a href="forumIndex.php">討論區</a> &gt; <a href="forum.php?platform=<?php echo $platform;?>"><?php echo $platString;?></a>
			</div>
			<div class="post">
				<form action="forum-search.php" method="post">
					<input type="hidden" name="platform" value="<?php echo $platform;?>">
					<input type="search" name="search" id="search" placeholder="搜尋">
					<select name="category">
						<option value="default">分類</option>
						<option value="notice">公告</option>
						<option value="chat">閒聊</option>
						<option value="review">心得</option>
						<option value="guide">攻略</option>
					</select>
					<button class="btnSearch"><i class="fa fa-search"></i></button>
				</form>
				<a href="#" class="btnPost" id="btnPost">發文</a>	
			</div>
		</div>
		
		<div class="giantBox">
			<div class="postArticle" id="postArticle"> <!-- 發表新文章的光箱 -->
				<h2 class="title">發表新文章</h2>
			
				<form action="function/forumAddArticle.php" method="post" id="form_Post">
					<div class="platNcat">
						<select name="platform" id="platform">
							<option value="default" selected>平台</option>
							<option value="PS4">PS</option>
							<option value="XBOX">XBOX</option>
							<option value="PC">PC</option>
							<option value="Wii">Wii</option>
							<option value="3DS">3DS</option>
							<!-- <option value="mobile">手機</option> -->
						</select>
						<select name="category" id="postCategory">
							<option value="default">分類</option>
							<option value="notice">公告</option> <!-- 要偵測是否為管理員 -->
							<option value="chat">閒聊</option>
							<option value="review">心得</option>
							<option value="guide">攻略</option>
						</select>
					</div>
							
					<input type="text" name="artTitle" class="artTitle" placeholder="文章標題">
					<div class="artImg">
						<i id="btnUpload" class="fa fa-picture-o"></i>
						<input type="file" name="artImg" id="upImg" style="display: none;">
					</div>
					<textarea name="artContent" rows="20" cols="40"></textarea>
					<div class="botUi">
						<label>發文驗證碼:<span id="randomCode"></span><input type="text" name="examCode" id="examCode"></label>
						<button type="button" id="btnSend">發表</button>
						<!-- <button id="btnPreview">預覽</button> -->
					</div>
				</form>
				<a class="btnClose" id="btnClose">&times;</a>
			</div>
		</div>
			<?php
				try{
					require_once("function/connectSQL.php");
					
					if(isset($_POST['platform']) && ($_POST['platform']) != ''){
						$sqlPlatForm = $_POST['platform'];
					}	
					if(isset($_POST['category']) && ($_POST['category']) != ''){
						$sqlCategory = $_POST['category'];
						$sql01 = " AND comCategory = '$sqlCategory'";
					}
					if(isset($_POST['search']) && ($_POST['search']) != ''){
						$sqlSearch = $_POST['search'];
						$sql02 = " AND comTitle LIKE '%$sqlSearch%'";
					}
		
					$platform = $_REQUEST["platform"];
					$sql00 = "SELECT * FROM comments WHERE comPlatform = '$sqlPlatForm'";
					$sql99 = " ORDER BY comId DESC";
					$sql_loadArticles = $sql00.$sql01.$sql02.$sql99;
					

					$articles = $pdo->query( $sql_loadArticles );

					$pageRow_records = 15;
					$num_pages = 1;
					if(isset($_GET["page"])){
						$num_pages = $_GET["page"];
					}
					$startRow_records = ($num_pages - 1)*$pageRow_records;
					$queryLimit = $sql_loadArticles." LIMIT ".$startRow_records.",".$pageRow_records;
					$result = $pdo->query($queryLimit);
					$count = $articles->rowCount();
					$totalPages = ceil($count/$pageRow_records);

					$hotPostQuery = "SELECT * FROM comments WHERE comPlatform = '$platform' AND status = '正常' OR status = '檢舉' ORDER BY comHeat DESC LIMIT 0,4";
					$hotPostRec = $pdo->query($hotPostQuery);
			?>
		
			<div class="hotPost"> <!-- 右方熱門文章 -->
			<h3 class="title">熱門文章</h3>

			<?php
				while($hotPostRow = $hotPostRec->fetch(PDO::FETCH_ASSOC)){
					switch ($hotPostRow["comCategory"]) {
						case 'guide':
							$comCategory = "攻略";
							break;
						
						case 'notice':
							$comCategory = "公告";
							break;
							
						case 'review':
							$comCategory = "心得";	
							break;

						case 'chat':
							$comCategory = "閒聊";
							break;		
					}
			?>

			<div class="postItem">
				<p class="title">
					<span class="cat">【<?php echo $comCategory; ?>】</span>
					<span class="hotTitle"><a href="forum-article.php?comId=<?php echo $hotPostRow["comId"]; ?>"><?php echo $hotPostRow["comTitle"]; ?></a></span>
				</p>
			</div>

			<?php } ?>
<!-- 			<div class="postItem">
				<p class="title">
					<span class="cat">【心得】</span>
					<span class="hotTitle"><a href="#">內戰... 我準備好啦!</a></span>
				</p>
			</div>
		
			<div class="postItem">
				<p class="title">
					<span class="cat">【心得】</span>
					<span class="hotTitle"><a href="#">轉蛋機率與保底機制淺談</a></span>
				</p>
			</div>
		
			<div class="postItem">
				<p class="title">
					<span class="cat">【閒聊】</span>
					<span class="hotTitle"><a href="#">版上還有活人嗎?</a></span>
				</p>
			</div> -->
		</div>
		<div class="clearfix"></div>
		
		
		<div class="mainContent"> <!-- 主要內容區 -->
			<div class="headRow"> <!-- 上方標題列 -->
				<div class="category">發文類型</div>
				<div class="postTitle">文章標題</div>
				<div class="heat"><i class="fa fa-commenting"></i><span>回覆/人氣</span></div>
				<div class="postTime">發表時間</div>
				<div class="finalPost">最後發表</div>
			</div>
			<?php
				
					if( $count == 0){ //判斷PDO物件裡面有撈到幾筆資料
							echo "<p style='text-align:center; order:2;'>本討論區無相關討論串</p>";
						}
					while ($artRow = $result->fetch( PDO::FETCH_ASSOC) ) {
						
						//回復數
						$comId = $artRow["comId"];
						$repeatNumQuery = "SELECT * FROM com_reply WHERE comId = '$comId' AND status = '正常' OR status = '檢舉' ORDER BY replyId DESC";
						$repeatNumRec = $pdo->query($repeatNumQuery);
						$repeatNum = $repeatNumRec->rowCount();

						//最後發表
						if($repeatNum == 0){
							$lastReplyDate = $artRow["comDate"];
							$lastReplyMem = $artRow["memAccount"]; 
						}else{
							$replyRow = $repeatNumRec->fetch(PDO::FETCH_ASSOC);
							$lastReplyDate = $replyRow["replyDate"];
							$lastReplyMem = $replyRow["memAcc"];
						}

						if( $artRow["comCategory"] == 'notice' ){
							//公告ROW
						?>
						<div class="row noticeRow">
							<input type="hidden" name="comId"> <!-- 隱藏的文章ID，傳值給下頁用 -->
							<div class="category"><a href="#">【公告】</a></div>
							<div class="postTitle"><a href="forum-article.php?comId=<?php echo $artRow["comId"]; ?>"><?php echo $artRow["comTitle"]; ?></a></div>
							<div class="heat"><?php echo $artRow["comHeat"]; ?></div>
							<div class="postTime"><?php echo $artRow["comDate"]; ?></div>
							<div class="finalPost"><p><a href="#"><?php echo "member";?></a></p><p><?php echo $artRow["lastReply"]; ?></p></div>
						</div>
					<?php
						}else{
							//通用ROW
						?>
							<div class="row">
							<input type="hidden" name="comId"> <!-- 隱藏的文章ID，傳值給下頁用 -->
							<div class="category">
								<a href="#">
									<?php 
									switch ( $artRow["comCategory"] ){ /*判斷文章類型*/
										case 'review':
											echo "【心得】";
											break;
										case 'chat':
											echo "【閒聊】";
											break;
										case 'guide':
											echo "【攻略】";
											break;
										}
									?>
								</a>
							</div>
							<div class="postTitle"><a href="forum-article.php?comId=<?php echo $artRow["comId"]; ?>"><?php echo $artRow["comTitle"]; ?></a></div>
							<div class="heat"><?php echo $repeatNum; ?>/<?php echo $artRow["comHeat"]; ?></div>
							<div class="postTime"><?php echo $artRow["comDate"]; ?></div>
							<div class="finalPost"><p><a href="#"><?php echo $lastReplyMem;?></a></p><p><?php echo $lastReplyDate; ?></p></div>
						</div>
			<?php			
						}//else結尾	
					}//while結尾
				}catch(PDOExeption $e){
					echo "資料庫操作錯誤: ", $e.getMessage(), "<br>";
					echo "行號: ", $e.getLine(), "<br>";
				}
			?>
		</div> <!-- mainContent結尾 -->
		
		<div class="pagination"> <!-- 中間分頁 -->
			<!-- 跳到第一頁 && 前進一頁 -->
			<?php if($num_pages > 1){ ?>
			<a href="<?php echo "{$_SERVER["PHP_SELF"]}"; ?>?platform=<?php echo $platform; ?>&page=1"><<</a>
			<a href="<?php echo "{$_SERVER[PHP_SELF]}"; ?>?platform=<?php echo $platform; ?>&page=<?php echo $num_pages-1; ?>">&lt;</a>
			<?php } ?>
			<?php
				$range = 5; //前後取頁數

				for ($i= (($num_pages - $range) -1); $i < (($num_pages + $range) + 1); $i++) {

					if(($i > 0) && ($i <= $totalPages)){

						if($i == $num_pages){ ?>
							<a>><?php echo $i; ?><</a>
						<?php }else{ ?>
							<a href="<?php echo "{$_SERVER["PHP_SELF"]}"; ?>?platform=<?php echo $platform; ?>&page=<?php echo $i; ?>"><?php echo $i; ?></a>
						<?php }

					}
						
				}
					

			?>
			<!-- 跳到最後頁 && 退後一頁 -->
			<?php if($num_pages < $totalPages){ ?>
			<a href="<?php echo "{$_SERVER["PHP_SELF"]}"; ?>?platform=<?php echo $platform; ?>&page=<?php echo $num_pages+1; ?>">&gt;</a>
			<a href="<?php echo "{$_SERVER["PHP_SELF"]}"; ?>?platform=<?php echo $platform; ?>&page=<?php echo $totalPages; ?>">>></a>
			<?php } ?>
		</div>
		
		
		<div class="hotProducts"> <!-- 下方熱門商品 -->
			<h3 class="title">熱門商品</h3>
			<div class="itemBox">

				<?php
					$hotProQuery = "SELECT * FROM products WHERE proSeries = '$platform' AND display = '上架' ORDER BY clickNum DESC LIMIT 0,4";
					$hotProRec = $pdo->query($hotProQuery);
					while($hotProRow = $hotProRec->fetch(PDO::FETCH_ASSOC)){
				?>

				<div class="prodItem" onclick="location.href='productIntro.php?proId=<?php echo $hotProRow['proId']; ?>'">
					<img src="<?php echo $hotProRow["proImg"]; ?>">
					<p class="title">
						<h5 class="prodTitle"><?php echo $hotProRow["proName"]; ?></h5>
						<div class="tagName"><?php echo $hotProRow["proSeries"]; ?></div>
						<div class="tag cat"><?php echo $hotProRow["proClass"]; ?></div>
					</p>
					<p class="price">NTD$<?php echo $hotProRow["proPrice"]; ?></p>
				</div>

				<?php } ?>
				<!-- <div class="prodItem">
					<img src="images/Warframe.jpg">
					<p class="title">
						<h5 class="prodTitle">戰甲神兵</h5>
						<div class="tagName">PS4</div>
						<div class="tag cat">動作射擊</div>
					</p>
					<p class="price">NTD$1,259</p>
				</div>
				<div class="prodItem">
					<img src="images/witcher3.jpg">
					<p class="title">
						<h5 class="prodTitle">巫師3:狂獵</h5>
						<div class="tagName">PS4</div>
						<div class="tag cat">動作冒險</div>
					</p>
					<p class="price">NTD$1,259</p>
				</div>
				<div class="prodItem">
					<img src="images/Mafia3.jpg">
					<p class="title">
						<h5 class="prodTitle">四海兄弟3</h5>
						<div class="tagName">PS4</div>
						<div class="tag cat">動作射擊</div>
					</p>
					<p class="price">NTD$1,259</p>
				</div> -->
			</div>
		</div>
	</div>
</div>
<?php include("function/footer.php"); ?>
</body>
</html>