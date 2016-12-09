<?php
ob_start();
session_start();
error_reporting(E_ALL || ~E_NOTICE);
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<link rel="stylesheet" type="text/css" href="css/forum.css">
	<link rel="stylesheet" type="text/css" href="css/header.css">
	<link rel="stylesheet" type="text/css" href="css/footer.css">
	<link rel="stylesheet" type="text/css" href="css/nav.css">
	<link href="https://fonts.googleapis.com/css?family=VT323" rel="stylesheet">
	<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<link rel="Shortcut Icon" type="image/x-icon" href="images/gametopia.ico"/>
	<script src="js/jquery-3.1.0.min.js"></script>
	<script src="js/forum.js"></script>
	<script src="js/tagName.js"></script>
	<script src="js/objAdjust.js"></script>
	<script src="js/commentLike.js"></script>
	<title>討論區/遊戲烏托邦-Gametopia</title>
	<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0"><!-- 補上meta方便看RWD成果 -->
</head>
<body class="fo">
	<?php
	include("function/header.php");
	include("function/memberBarSwitcher.php");
	// include("header.html");
	?>	
<div class="forumContainer">
	<div class="blankDiv"></div>
	<div class="uiBtns"> <!-- 麵包屑+搜尋+發文 -->
		<div class="breadcrumbs">
			<a href="index.php">HOME</a> &gt; <a href="forumIndex.php">討論區</a> &gt; <a href="#" id="conName">平台</a>
		</div>
		<div class="post">
			<form action="forum-search.php" method="post">
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
			<a class="btnClose" id="btnClose">
				<i class="fa fa-times fa-fw"></i>
			</a>
			<form action="function/forumAddArticle.php" method="post" id="form_Post">
				<input type="hidden" name="comId" value="<?php echo $_REQUEST['comId'];?>">
				<div class="platNcat">
					<select name="platform" id="platform">
						<option value="default" selected>平台</option>
						<option value="PS4">PS</option>
						<option value="XBOX">XBOX</option>
						<option value="PC">PC</option>
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
			<!-- <a class="btnClose" id="btnClose">&times;</a> -->

			
		</div>
	</div>
	
	
	<!-- <div class="pagination"> --> <!-- 中間分頁 -->
	<!-- 		<a href="#">&lt;</a>
		<a href="#">1</a>
		<a href="#">2</a>
		<a href="#">3</a>
		<a href="#">4</a>
		<a href="#">5</a>
		<a href="#">6</a>
		<a href="#">&gt;</a>
		<a href="#">》</a>
	</div> -->
	
	<div class="mainContent"> <!-- 主要內容區 -->
		<?php
			try{
				require_once("function/connectSQL.php");	
				//點閱數加 1
				$comId = $_REQUEST["comId"];
				$comHeatQuery = "SELECT comHeat FROM comments WHERE comId = '$comId' AND status = '正常' OR status = '檢舉'";
				$comHeatRec = $pdo->query($comHeatQuery);
				$comHeatRow = $comHeatRec->fetch(PDO::FETCH_ASSOC);
				$comHeatNow = $comHeatRow["comHeat"];
				$comHeat = $comHeatNow + 1;

				$updateHeatQuery = "UPDATE comments SET comHeat = '$comHeat' WHERE comId = '$comId'";
				$updateHeatRec = $pdo->query($updateHeatQuery);


				$sql_loadArticle = 'SELECT * FROM comments WHERE comments.comId = :comId';
	
				$article = $pdo->prepare( $sql_loadArticle );
				$article->bindValue(":comId", $_REQUEST['comId']);
				$article->execute();
	
				while($artRow = $article->fetch(PDO::FETCH_ASSOC)){
		?>
				<h2 class="articleBar">
					<span class="category">
						<?php 
							switch ( $artRow["comCategory"] ){ /*判斷文章類型*/
								case 'notice':
									echo "【公告】";
									break;
								case 'chat':
									echo "【閒聊】";
									break;
								case 'guide':
									echo "【攻略】";
									break;
								default:
									echo "【心得】";
									break;
								}
						?>
					</span>
					<span class="artTitle"><?php echo $artRow['comTitle'];?></span>
					<span class="artHeat"><?php echo $artRow['comHeat'];?></span>
				</h2>
				<div class="contentBox"> <!-- 文章本體 -->
					<div class="author">
						<div class="avatar">
							<img src="memImg/avatar-member.jpg">
						</div>
						<div class="memName"><?php echo $artRow["memAccount"];?></div>
						<span class="postDate">發表日期:<?php echo $artRow["comDate"];?></span>
					</div>
					<?php echo "<pre>",$artRow['comContent'],"</pre>";?>
					<div class="uiBar">
						<button class="btnReport comReport" id="btnReport" value="<?php echo $artRow['comId']; ?>" onclick="comReport();">檢舉文章</button>
						<button type="button" class="btnReply" id="btnReply">回覆</button>

						<?php
							//討論本文點讚
							$comLikeNumQuery = "SELECT * FROM com_like WHERE comId = '$comId'";
							$comLikeNumRec = $pdo->query($comLikeNumQuery);
							$comLikeCount = $comLikeNumRec->rowCount();

							if(isset($_SESSION["GTopiaAccount"])){
								$memAccount = $_SESSION["GTopiaAccount"];
								
								$comLikeQuery = "SELECT * FROM com_like WHERE comId = '$comId' AND memAccount = '$memAccount'";
								
								$comLikeRec = $pdo->query($comLikeQuery);
								$comNumCheck = $comLikeRec->rowCount();

								if($comNumCheck == 0){ ?>
									
									<button type="button" class="btnLike" onclick="comLikeAdd();"><i class="fa fa-thumbs-o-up"></i><span><?php echo $comLikeCount; ?></span></button>
									<input type="hidden" name="comLike" value="comments">
									<input type="hidden" name="comId" value="<?php echo $comId; ?>">
									<input type="hidden" name="com_memAccount" value="<?php echo $memAccount; ?>">

								<?php }else{ ?>
									
									<button type="button" style="background-color:red;" class="btnLike" onclick="comLikeMiner();"><i class="fa fa-thumbs-o-up"></i><span><?php echo $comLikeCount; ?></span></button>
									<input type="hidden" name="comDis" value="dislikeComments">
									<input type="hidden" name="comId" value="<?php echo $comId; ?>">
									<input type="hidden" name="com_memAccount" value="<?php echo $memAccount; ?>">

								<?php }
							}else{ // for Line 174 => 登入驗證
						?>	
							<button type="button" class="btnLike" onclick="alert('請先登入會員');"><i class="fa fa-thumbs-o-up"></i><span><?php echo $comLikeCount; ?></span></button>

							<?php } ?>

					</div>
				</div>
				
		<?php		
			
				} /*while結尾*/
		
			}catch(PDOExeption $e){
				echo "資料庫操作錯誤: ", $e.getMessage(), "<br>";
				echo "行號: ", $e.getLine(), "<br>";
			}
		?>
		<?php /*讀取回覆資訊SQL*/
			try{ 
				$sql_loadReplies = 'SELECT * FROM com_Reply WHERE comId = :comId ORDER BY replyId';
	
				$replies = $pdo->prepare( $sql_loadReplies );
				$replies->bindValue(":comId", $_REQUEST['comId']);
				$replies->execute();

				//分頁
				$pageRow_records = 15;
				$num_pages = 1;
				if(isset($_GET["page"])){
					$num_pages = $_GET["page"];
				}
				$startRow_records = ($num_pages - 1)*$pageRow_records;
				$queryLimit = $sql_loadReplies." LIMIT ".$startRow_records.",".$pageRow_records;
				$result = $pdo->prepare($queryLimit);
				$result->bindValue(":comId",$_REQUEST["comId"]);
				$result->execute();
				$count = $replies->rowCount();

				$totalPages = ceil($count/$pageRow_records);
	
				while($repRow = $result->fetch(PDO::FETCH_ASSOC)){
		?>
				<div class="repliesBox"> <!-- 回覆文章 -->
					<div class="author">
						<div class="avatar">
							<img src="memImg/avatar-member.jpg">
						</div>
						<div class="memName"><?php echo $repRow['memAcc']; ?></div>
						<span class="postDate"><?php echo $repRow['replyDate'];?></span>
					</div>
					<pre><?php echo $repRow['replyContent'];?></pre>
					<div class="uiBar">
						<button class="btnReport" id="btnReport" onclick="replyReport(<?php echo $repRow['replyId']; ?>);">檢舉文章</button>
						<button type="button" class="btnReply" id="btnReply">回覆</button>
						
						<?php
							//點讚
							if(isset($_SESSION["GTopiaAccount"])){

								$memAccount = $_SESSION["GTopiaAccount"];
								$replyId = $repRow["replyId"];
								$repLikeQuery = "SELECT * FROM reply_like WHERE replyId = '$replyId'";
								$repLikeRec = $pdo->query($repLikeQuery);
								$repLikeCount = $repLikeRec->rowCount();
								
								//確認登入的會員是否已經按過讚
								
								$checkQuery = "SELECT * FROM reply_like WHERE memAccount = '$memAccount' AND replyId = '$replyId' AND active = 'on'";
								$checkRec = $pdo->query($checkQuery);
								$check = $checkRec->rowCount();
								echo $check;

								if($check == 0){
						?>

									<button type="button" class="btnLike" onclick="replyLikeAdd('<?php echo $memAccount; ?>','<?php echo $repRow['replyId']; ?>','reply');"><i class="fa fa-thumbs-o-up"></i><span><?php echo $repLikeCount; ?></span></button>
									
									
									<input type="hidden" name="repLike" value="reply">
							
								<?php }elseif($check != 0){ ?>
						
									<button type="button" class="btnLike" onclick="replyLikeMiner('<?php echo $memAccount; ?>','<?php echo $repRow['replyId']; ?>','replyDislike');" style='background-color: red;'><i class="fa fa-thumbs-o-up"></i><span><?php echo $repLikeCount; ?></span></button>

									<input type="hidden" name="repDis" value="replyDislike">

								<?php } ?>
						<?php }else{ ?>
							
								<button type="button" class="btnLike" onclick="alert('請先登入會員');"><i class="fa fa-thumbs-o-up"></i><span><?php echo $repLikeCount; ?></span></button>
							
						<?php } ?>


					</div>
				</div>
	
	
		<?php
		}/*回覆文章while結尾*/
			}catch(PDOExeption $e){
				echo "資料庫操作錯誤: ", $e.getMessage(), "<br>";
				echo "行號: ", $e.getLine(), "<br>";
			}
			
		?>
		
	</div>
	
	
	<div class="hotPost"> <!-- 右方熱門文章 -->
		<h3 class="title">熱門文章</h3>

		<?php
			//熱門文章
			$hotPostQuery = "SELECT * FROM comments WHERE comPlatform = (SELECT comPlatform FROM comments WHERE comId = '$comId') AND status = '正常' OR status = '檢舉' ORDER BY comId DESC LIMIT 0,4";
			$hotPostRec = $pdo->query($hotPostQuery);
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
		<!-- <div class="postItem">
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
	
	<div class="pagination"> <!-- 下方分頁 -->
		<?php if($num_pages > 1){ ?>
			<a href="<?php echo "{$_SERVER["PHP_SELF"]}"; ?>?comId=<?php echo $comId; ?>&page=1"><<</a>
			<a href="<?php echo "{$_SERVER[PHP_SELF]}"; ?>?comId=<?php echo $comId; ?>&page=<?php echo $num_pages-1; ?>">&lt;</a>
			<?php } ?>
			<?php
				$range = 5; //前後取頁數

				for ($i= (($num_pages - $range) -1); $i < (($num_pages + $range) + 1); $i++) {

					if(($i > 0) && ($i <= $totalPages)){

						if($i == $num_pages){ ?>
							<a>><?php echo $i; ?><</a>
						<?php }else{ ?>
							<a href="<?php echo "{$_SERVER["PHP_SELF"]}"; ?>?comId=<?php echo $comId; ?>&page=<?php echo $i; ?>"><?php echo $i; ?></a>
						<?php }

					}
						
				}
					

			?>
			<!-- 跳到最後頁 && 退後一頁 -->
			<?php if($num_pages < $totalPages){ ?>
			<a href="<?php echo "{$_SERVER["PHP_SELF"]}"; ?>?comId=<?php echo $comId; ?>&page=<?php echo $num_pages+1; ?>">&gt;</a>
			<a href="<?php echo "{$_SERVER["PHP_SELF"]}"; ?>?comId=<?php echo $comId; ?>&page=<?php echo $totalPages; ?>">>></a>
			<?php } ?>
	</div>
	
	<div class="hotProducts"> <!-- 下方熱門商品 -->
		<h3 class="title">熱門商品</h3>
		<div class="itemBox">

			<?php
				$hotProQuery = "SELECT * FROM products WHERE proSeries LIKE (SELECT comPlatform FROM comments WHERE comId LIKE '$comId') AND display = '上架' ORDER BY clickNum DESC LIMIT 0,4";
				$hotProRec = $pdo->query($hotProQuery);
				while($hotProRow = $hotProRec->fetch(PDO::FETCH_ASSOC)){
			?>

			<div class="prodItem" onclick="location.href='productIntro.php?proId=<?php echo $hotProRow["proId"]; ?>'">
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

	
<?php 
	
	include("function/footer.php");

?>
	
</body>
</html>