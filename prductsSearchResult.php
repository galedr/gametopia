<?php
include("function/connectSQL.php");
$proClass = 1;
$proSeries = 1;
$proSearch = 1;

if(isset($_GET["proSeries"]) && ($_GET["proSeries"]) != ""){
	$proSeries = $_GET["proSeries"];
}
if(isset($_GET["proClass"]) && ($_GET["proClass"]) != ""){
	$proClass = $_GET["proClass"];
}
if(isset($_GET["proSearch"]) && ($_GET["proSearch"]) != ""){
	$proSearch = $_GET["proSearch"];
}

// 三種搜尋方式搭配可能
if($proSearch != 1 && $proClass == 1 && $proSeries == 1){
	$searchList = " WHERE proName LIKE '%$proSearch%'";
}elseif($proSearch != 1 && $proClass != 1 && $proSeries = 1){
	$searchList = " WHERE proName LIKE '%$proSearch%' AND proClass = '$proClass'";
}elseif($proSearch != 1 && $proClass != 1 && $proSeries != 1){
	$searchList = " WHERE proName LIKE '%$proSearch%' AND proClass = '$proClass' AND proSeries = '$proSeries'";
}elseif($proSearch == 1 && $proClass != 1 && $proSeries == 1){
	$searchList = " WHERE proClass = '$proClass'";
}elseif($proSearch == 1 && $proClass == 1 && $proSeries != 1){
	$searchList = " WHERE proSeries = '$proSeries'";
}elseif($proSearch == 1 && $proClass != 1 && $proSeries != 1){
	$searchList = " WHERE proClass = '$proClass' AND proSeries = '$proSeries'";
}


// 三種都沒輸入則跳警告返回原頁
if(!isset($_GET["proSearch"]) && !isset($_GET["proSeries"]) && !isset($_GET["proClass"])){
	unset($_GET["proSeries"]);
	unset($_GET["proClass"]);
	unset($_GET["proSearch"]);
	echo "
		<script>
			alert('請至少輸入一種搜尋方式');
			location.href='products.php';
		</script>
	";
}

$searchQuery = "SELECT * FROM products".$searchList;
$searchRec = $pdo->query($searchQuery);
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Gametopia 商品</title>
	<link rel="stylesheet" type="text/css" href="css/header.css">
	<link rel="stylesheet" type="text/css" href="css/footer.css">
	<link rel="stylesheet" type="text/css" href="css/nav.css">
	<link rel="stylesheet" type="text/css" href="css/products.css">
	<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css">
	<link rel="Shortcut Icon" type="image/x-icon" href="images/gametopia.ico"/>
	<script src="js/jquery-3.1.0.min.js"></script>
	<script src="js/resizeSvg.js"></script>
	<script src="js/tagName.js"></script>
	<!-- <script src="js/slider.js"></script> -->
	<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
</head>
<body class="sm">
	<?php
		error_reporting( E_ALL || ~E_NOTICE);
		include("function/header.php");
		include("function/memberBarSwitcher.php");
	?>
	<div class="productsBox">
		<div class="filter"> <!-- 篩選/搜尋列 -->
				<form action="#" method="get">
					<input type="search" name="search" id="search">
					<select name="platform" id="platform">
						<option value="1" selected>平台</option>
						<option value="PS4">PS4</option>
						<option value="XBOX">XBOX</option>
						<option value="3DS">3DS</option>
						<option value="Wii">Wii</option>
						<option value="PC">PC</option>
					</select>
					<select name="category" id="category">
						<option value="1" selected>遊戲分類</option>
						<option value="advance">冒險犯難</option>
						<option value="action">動作驚險</option>
						<option value="multiplayer">多人合作</option>
						<option value="race">競速刺激</option>
						<option value="strategy">策略多謀</option>
						<option value="sports">運動休閒</option>
						<option value="shooting">即時射擊</option>
						<option value="roleplay">角色扮演</option>
					</select>
					<button id="btnSearch"><i class="fa fa-search"></i></button>
				</form>
		</div>
			
			
			
			
		<div class="giftSct">  <!-- 贈禮專區超大按鈕? -->
			<div class="male">
				<img src="images/male_original.png" alt="">		
			</div>
			<a href="giftAndCard.php"><i class="fa fa-gift"></i>送禮專區</a>
			<span>煩惱該送什麼遊戲給親朋好友嗎？點我就對了！</span>
			<div class="female">
				<img src="images/female_original.png" alt="">
			</div>
		</div>
		
		
		<div class="mainContent"> <!-- 下方主要內容區大Container -->
			
			<div class="adsSct"> <!-- 左下方廣告區域 -->
				<div class="item-advs"> <!-- 似乎是有ad或adv字眼的東西都會被adBlock擋住 -->
					<a href="http://www.trionworlds.com/rift/en/" target="_blank"><img src="images/adsBanner.jpg"></a>
				</div>
				<div class="item-advs">
					<a href="http://www.worldoftanks.com" target="_blank"><img src="images/adsBanner2.jpg"></a>
				</div>
			</div>
		
		
			<div class="products"> <!-- 主要商品區 -->
				
				<div class="prod-latest">  <!-- 最新商品 -->
					<h3 class="block-title">搜尋結果</h3>
					<div class="row">
						
						<?php
						if( $searchRec->rowCount() == 0 ){
							echo "<p style='text-align:center;font-size:19px;padding:5px;'>本次搜尋無相關結果</p>";
						}
						while($proRow = $searchRec->fetch(PDO::FETCH_ASSOC)){	
						?>
						<div class="item-box" onclick="location.href='productIntro.php?proId=<?php echo $proRow["proId"]; ?>'">
							<div class="item">
									<img src="<?php echo $proRow["proImg"]; ?>">
								<h5><?php echo $proRow["proName"]; ?></h5>
								<div class="tagName"><?php echo $proRow["proSeries"]; ?></div>
								<div class="catName"><i class="catTarget"></i><?php echo $proRow["proClass"]; ?></div>
								<p class="price">NT$<?php echo $proRow["proPrice"]; ?></p>
							</div>
						</div>
						<?php } ?>
					</div>
				</div>	
			</div>
		
		</div>	
	</div>
</body>
</html>
<?php include("function/footer.php");?>