<?php
ob_start();
session_start();
error_reporting(E_ALL || ~E_NOTICE);
require_once("function/connectSQL.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>二手商品搜尋/遊戲烏托邦-GameTopia</title>  
	<link rel="Shortcut Icon" type="image/x-icon" href="images/gametopia.ico"/>
	<link rel="stylesheet" href="css/header.css">
  	<link rel="stylesheet" href="css/footer.css">
  	<link rel="stylesheet" type="text/css" href="css/nav.css">
	<link rel="stylesheet" href="css/SH_search.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">	 
	<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
	<script type="text/javascript" src="js/jquery-3.1.0.min.js"></script>
	<script type="text/javascript" src="js/secondHandSearch.js"></script>
	<script type="text/javascript" src="js/SH_search.js"></script>
	
</head>
<body class="sh">
<?php 
    error_reporting(E_ALL || ~E_NOTICE);
    include('function/header.php');
    include('function/memberBarSwitcher.php')
?>
	<div class="SHSearch_container">
		<div class="sliderBox">
			<div class="fakeSlider"></div>
		</div>
		 <!-- 麵包屑 -->
        <div class="breadcrumbs">
        	<a href="index.php">HOME</a> &gt; <a href="SH_index.php">二手買賣</a> &gt; <a href="SH_search.php">二手搜尋</a>
      	</div>
		<div class="gameSearchBar">
			<div class="selectbox">
				<div class="gameP">
					<div class="gamePIcon">
						<img src="images/game-console.png" alt="">
					</div>
					<select id="gameConsole">
						<option value ="gamePselect">請選擇遊戲平台</option>
					  	<option value ="PS4" id="gamePS">PS4</option>
					  	<option value="XBOX" id="gameXBOX">XBOX</option>
					  	<option value="3DS" id="gameHH">3DS</option>
					  	<option value="Wii" id="gameWii">Wii</option>
					  	<option value="PC" id="gamePC">PC</option>
					  	<input type="hidden" name="gameConsole" value="1">
					</select>
				</div>
				<div class="gameType">
					<div class="gameTypeIcon">
						<img src="images/ancient-sword.png" alt="">
					</div>
					<select name="gameType" id="gameType">
						<option value ="gamePselect">請選擇遊戲類型</option>
					  	<option value ="冒險犯難">冒險犯難</option>
					  	<option value="動作驚險">動作驚險</option>
					  	<option value="多人合作">多人合作</option>
					  	<option value ="競速刺激">競速刺激</option>
					  	<option value="策略多謀">策略多謀</option>
					  	<option value="運動休閒">運動休閒</option>
					  	<option value="即時射擊">即時射擊</option>
					  	<option value="角色扮演">角色扮演</option>
					  	<input type="hidden" name="gameType" value="1">
					</select>
				</div>
			</div>
			<div class="SH_searchboxarea">
				<div class="SH_searchbox">
					<div class="SH_searchmain">
						<input id="search" type="text" placeholder="Search...">
						<input type="hidden" name="searchInfo" value="1">
					</div>
					<div class="SH_searchIcon">
						<label for="search"><i class="fa fa-search" aria-hidden="true" id="searchBtn"></i></label>
					</div>
				</div>
			</div>
		</div>
		<div class="SH_products">

			<?php
				$usedQuery = "SELECT * FROM products WHERE proType = '二手' ORDER BY id DESC";
				$usedRec = $pdo->query($usedQuery);
				while($usedRow = $usedRec->fetch(PDO::FETCH_ASSOC)){
			?>

			<div class="SH_productbox">
				<div class="SH_productImg"><img src="<?php echo $usedRow["proImg"]; ?>" alt="" onclick="location.href='SH_productEx.php?proId=<?php echo $usedRow["proId"]; ?>'"></div>
				<div class="productInfoarea">
					<div class="SH_productContent">
						<h2 id="SH_productName" onclick="location.href='SH_productEx.php?proId=<?php echo $usedRow["proId"]; ?>'"><?php echo $usedRow["proName"]; ?></h2>

						<?php
							//判定遊戲主機
							if($usedRow["proSeries"] == 'PS'){
								$seriesId = "gameMomPS";
							}elseif($usedRow["proSeries"] == 'XBOX'){
								$seriesId = "gameMomXBOX";
							}elseif($usedRow["proSeries"] == '掌機'){
								$seriesId = "gameMom3DS";
							}elseif($usedRow["proSeries"] == 'PC'){
								$seriesId = "gameMomPC";
							}
						?>
						<div class="tags">
			                <span class="gameMom" id="<?php echo $seriesId; ?>"><?php echo $usedRow["proSeries"]; ?></span>
						</div>
						<div class="pricebox"><span id="price"><?php echo $usedRow["proPrice"]; ?></span>元</div>
						<div class="memobox">
							<p id="memo"><?php echo $usedRow["proInfo"]; ?></p>
						</div>
					</div>
					<div class="paybar">
						<div class="paybox">

							<span id="addCart" class="add_Cart" onclick="searchAndAddCart('<?php echo $usedRow['proId']; ?>')">加入購物車</span>
							<input type="hidden" name="proId" value="<?php echo $usedRow["proId"]; ?>">
						</div>
						<div class="clearBoth"></div>
					</div>
				</div>
			</div>

			<?php } ?>
<!-- 			<div class="SH_productbox">
				<div class="SH_productImg"><img src="images/witcher3.jpg" alt=""></div>
				<div class="productInfoarea">
					<div class="SH_productContent">
						<h2 id="SH_productName">SH_productName</h2>
						<div class="tags">
			                <span class="gameMom" id="gameMomPS">PS</span>
			                <span class="gameMom" id="gameMom3DS">3DS</span>
			                <span class="gameMom" id="gameMomXBOX">XBOX</span>
			                <span class="gameMom" id="gameMomPC">PC</span>
						</div>
						<div class="pricebox"><span id="price">300</span>元</div>
						<div class="memobox">
							<p id="memo">九成新，外殼有些許刮痕，但內部光碟完好。</p>
						</div>
					</div>
					<div class="paybar">
						<div class="paybox">
							<span class="count">
								<select name="" id="count">
									<option value="count_1">1</option>
								</select>
							</span>
							<span class="add_Cart">加入購物車</span>
						</div>
						<div class="clearBoth"></div>
					</div>
				</div>
			</div>
			<div class="SH_productbox">
				<div class="SH_productImg"><img src="images/witcher3.jpg" alt=""></div>
				<div class="productInfoarea">
					<div class="SH_productContent">
						<h2 id="SH_productName">SH_productName</h2>
						<div class="tags">
			                <span class="gameMom" id="gameMomPS">PS</span>
			                <span class="gameMom" id="gameMom3DS">3DS</span>
			                <span class="gameMom" id="gameMomXBOX">XBOX</span>
			                <span class="gameMom" id="gameMomPC">PC</span>
						</div>
						<div class="pricebox"><span id="price">300</span>元</div>
						<div class="memobox">
							<p id="memo">九成新，外殼有些許刮痕，但內部光碟完好。</p>
						</div>
					</div>
					<div class="paybar">
						<div class="paybox">
							<span class="count">
								<select name="" id="count">
									<option value="count_1">1</option>
								</select>
							</span>
							<span class="add_Cart">加入購物車</span>
						</div>
						<div class="clearBoth"></div>
					</div>
				</div>
			</div>
			<div class="SH_productbox">
				<div class="SH_productImg"><img src="images/witcher3.jpg" alt=""></div>
				<div class="productInfoarea">
					<div class="SH_productContent">
						<h2 id="SH_productName">SH_productName</h2>
						<div class="tags">
			                <span class="gameMom" id="gameMomPS">PS</span>
			                <span class="gameMom" id="gameMom3DS">3DS</span>
			                <span class="gameMom" id="gameMomXBOX">XBOX</span>
			                <span class="gameMom" id="gameMomPC">PC</span>
						</div>
						<div class="pricebox"><span id="price">300</span>元</div>
						<div class="memobox">
							<p id="memo">九成新，外殼有些許刮痕，但內部光碟完好。</p>
						</div>
					</div>
					<div class="paybar">
						<div class="paybox">
							<span class="count">
								<select name="" id="count">
									<option value="count_1">1</option>
								</select>
							</span>
							<span class="add_Cart">加入購物車</span>
						</div>
						<div class="clearBoth"></div>
					</div>
				</div>
			</div>
			<div class="SH_productbox">
				<div class="SH_productImg"><img src="images/witcher3.jpg" alt=""></div>
				<div class="productInfoarea">
					<div class="SH_productContent">
						<h2 id="SH_productName">SH_productName</h2>
						<div class="tags">
			                <span class="gameMom" id="gameMomPS">PS</span>
			                <span class="gameMom" id="gameMom3DS">3DS</span>
			                <span class="gameMom" id="gameMomXBOX">XBOX</span>
			                <span class="gameMom" id="gameMomPC">PC</span>
						</div>
						<div class="pricebox"><span id="price">300</span>元</div>
						<div class="memobox">
							<p id="memo">九成新，外殼有些許刮痕，但內部光碟完好。</p>
						</div>
					</div>
					<div class="paybar">
						<div class="paybox">
							<span class="count">
								<select name="" id="count">
									<option value="count_1">1</option>
								</select>
							</span>
							<span class="add_Cart">加入購物車</span>
						</div>
						<div class="clearBoth"></div>
					</div>
				</div>
			</div>
			<div class="SH_productbox">
				<div class="SH_productImg"><img src="images/witcher3.jpg" alt=""></div>
				<div class="productInfoarea">
					<div class="SH_productContent">
						<h2 id="SH_productName">SH_productName</h2>
						<div class="tags">
			                <span class="gameMom" id="gameMomPS">PS</span>
			                <span class="gameMom" id="gameMom3DS">3DS</span>
			                <span class="gameMom" id="gameMomXBOX">XBOX</span>
			                <span class="gameMom" id="gameMomPC">PC</span>
						</div>
						<div class="pricebox"><span id="price">300</span>元</div>
						<div class="memobox">
							<p id="memo">九成新，外殼有些許刮痕，但內部光碟完好。</p>
						</div>
					</div>
					<div class="paybar">
						<div class="paybox">
							<span class="count">
								<select name="" id="count">
									<option value="count_1">1</option>
								</select>
							</span>
							<span class="add_Cart">加入購物車</span>
						</div>
						<div class="clearBoth"></div>
					</div>
				</div>
			</div>
			<div class="SH_productbox">
				<div class="SH_productImg"><img src="images/witcher3.jpg" alt=""></div>
				<div class="productInfoarea">
					<div class="SH_productContent">
						<h2 id="SH_productName">SH_productName</h2>
						<div class="tags">
			                <span class="gameMom" id="gameMomPS">PS</span>
			                <span class="gameMom" id="gameMom3DS">3DS</span>
			                <span class="gameMom" id="gameMomXBOX">XBOX</span>
			                <span class="gameMom" id="gameMomPC">PC</span>
						</div>
						<div class="pricebox"><span id="price">300</span>元</div>
						<div class="memobox">
							<p id="memo">九成新，外殼有些許刮痕，但內部光碟完好。</p>
						</div>
					</div>
					<div class="paybar">
						<div class="paybox">
							<span class="count">
								<select name="" id="count">
									<option value="count_1">1</option>
								</select>
							</span>
							<span class="add_Cart">加入購物車</span>
						</div>
						<div class="clearBoth"></div>
					</div>
				</div>
			</div>
			<div class="SH_productbox">
				<div class="SH_productImg"><img src="images/witcher3.jpg" alt=""></div>
				<div class="productInfoarea">
					<div class="SH_productContent">
						<h2 id="SH_productName">SH_productName</h2>
						<div class="tags">
			                <span class="gameMom" id="gameMomPS">PS</span>
			                <span class="gameMom" id="gameMom3DS">3DS</span>
			                <span class="gameMom" id="gameMomXBOX">XBOX</span>
			                <span class="gameMom" id="gameMomPC">PC</span>
						</div>
						<div class="pricebox"><span id="price">300</span>元</div>
						<div class="memobox">
							<p id="memo">九成新，外殼有些許刮痕，但內部光碟完好。</p>
						</div>
					</div>
					<div class="paybar">
						<div class="paybox">
							<span class="count">
								<select name="" id="count">
									<option value="count_1">1</option>
								</select>
							</span>
							<span class="add_Cart">加入購物車</span>
						</div>
						<div class="clearBoth"></div>
					</div>
				</div>
			</div>
			<div class="SH_productbox">
				<div class="SH_productImg"><img src="images/witcher3.jpg" alt=""></div>
				<div class="productInfoarea">
					<div class="SH_productContent">
						<h2 id="SH_productName">SH_productName</h2>
						<div class="tags">
			                <span class="gameMom" id="gameMomPS">PS</span>
			                <span class="gameMom" id="gameMom3DS">3DS</span>
			                <span class="gameMom" id="gameMomXBOX">XBOX</span>
			                <span class="gameMom" id="gameMomPC">PC</span>
						</div>
						<div class="pricebox"><span id="price">300</span>元</div>
						<div class="memobox">
							<p id="memo">九成新，外殼有些許刮痕，但內部光碟完好。</p>
						</div>
					</div>
					<div class="paybar">
						<div class="paybox">
							<span class="count">
								<select name="" id="count">
									<option value="count_1">1</option>
								</select>
							</span>
							<span class="add_Cart">加入購物車</span>
						</div>
						<div class="clearBoth"></div>
					</div>
				</div>
			</div> -->
		</div>
	</div>
<?php 

  include("function/footer.php");

?>
	</body>
</html>
