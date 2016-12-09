<?php
ob_start();
session_start();
error_reporting(E_ALL || ~E_NOTICE);
require_once("function/connectSQL.php");

if(isset($_GET["proId"]) && ($_GET["proId"]) != ""){
  $proId = $_GET["proId"];
}

$proQuery = "SELECT * FROM products WHERE proId = '$proId'";
$proRec = $pdo->query($proQuery);
$proRow = $proRec->fetch(PDO::FETCH_ASSOC);

?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>二手商品/遊戲烏托邦-GameTopia</title>  
  <link rel="Shortcut Icon" type="image/x-icon" href="images/gametopia.ico"/>
  <link rel="stylesheet" href="css/header.css">
  <link rel="stylesheet" href="css/footer.css">
  <link rel="stylesheet" type="text/css" href="css/nav.css">
	<link rel="stylesheet" href="css/secondHandEx.css">
	 <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
   <script type="text/javascript" src="js/jquery-3.1.0.min.js"></script>
</head>
<body class="sh">
<?php 
    error_reporting(E_ALL || ~E_NOTICE);
    include('function/header.php');
    include('function/memberBarSwitcher.php')
?>
	<div class="SHPEx_Container">
      <div class="sliderBox">
        <div class="fakeSlider"></div>
      </div>
      <div class="productLightboxDetal">
      <!-- 麵包屑 -->
        <div class="breadcrumbs">
        <a href="index.php">HOME</a> &gt; <a href="SH_index.php">二手買賣</a> &gt; <a href="SH_search.php">二手搜尋</a> &gt; <?php echo $proRow["proName"]; ?>
      </div>
      
      <div class="productDetal">
        <div class="productPaW">
          <div class="productPic">
            <img id="SH_ProductImg" src="<?php echo $proRow["proImg"]; ?>" alt="">
          </div>
          <div class="productTable">
            <table class="productWord">
              <tr>
                <td colspan="2">
                  <h2 id="SH_productName"><?php echo $proRow["proName"]; ?></h2>
                </td>
              </tr>
              <tr>
                <td colspan="2">
                  <?php
                    $proSeries = $proRow["proSeries"];
                    if($proSeries == 'PS'){
                      $spanId = "gameMomPS";
                    }elseif($proSeries == 'XBOX'){
                      $spanId = "gameMomXBOX";
                    }elseif($proSeries == '掌機'){
                      $spanId = "gameMom3DS";
                    }elseif($proSeries == 'PC'){
                      $spanId = "gameMomPC";
                    }
                  ?>
                  <span class="gameMom" id="<?php echo $spanId; ?>"><?php echo $proRow["proSeries"]; ?></span>
                  <!-- <span class="gameMom" id="gameMom3DS">3DS</span>
                  <span class="gameMom" id="gameMomXBOX">XBOX</span>
                   <span class="gameMom" id="gameMomWii">Wii</span>
                  <span class="gameMom" id="gameMomPC">PC</span> -->
                </td>
              </tr>
              <tr>
                <th>二手價</th>
                <td><span id="price"><?php echo $proRow["proPrice"]; ?></span>元</td>
              </tr>
              <tr>
                <th>附款方式</th>
                <td>
                  <div class="payway">
                    <div class="atm">
                      <img src="images/atm.png" alt="">
                      <span>轉帳</span>
                    </div>
                    <div class="visa">
                      <img src="images/visa.png" alt="">
                      <span>信用卡</span>
                    </div>
                  </div>
                </td>
              </tr>
              <tr>
                <td colspan="2"><button id="addCart" class="btn_addCart">加入購物車</button></td>
                <input type="hidden" name="proId" value="<?php echo $proRow["proId"]; ?>">
              </tr>
             
              <tr>
                <th>聯絡賣家</th>
                <td><a href="mail_1.php?seller=<?php echo $proRow["seller"]; ?>" id="sellMem"><?php echo $proRow["seller"]; ?></a></td>
              </tr>
            </table>
          </div>
        </div>
        <div class="productEx">
          <div class="productExContent">
            <p class="memo">備註</p>
            <p class="memoContent" id="SH_productmemo"><?php echo $proRow["proInfo"]; ?></p>
          </div>
          <div class="productInfoImg">
            <img id="SH_productImg1" src="<?php echo $proRow["proPic01"]; ?>" alt="">
            <img id="SH_productImg2" src="<?php echo $proRow["proPic02"]; ?>" alt="">
            <img id="SH_productImg3" src="<?php echo $proRow["proPic03"]; ?>" alt="">
          </div>
        </div>
      </div>
      <div class="adBox">
        <div class="ad">
          <img src="images/add.png" alt="">
        </div>
        <div class="ad">
          <img src="images/add.png" alt="">
        </div>
      </div>
    </div>

	</div>
<?php 

  include("function/footer.php");

?>
</body>
</html>
<script>
    $('#addCart').click(function(){
        var proId = $('input[name="proId"]').val();
        console.log(proId);
        $.ajax({
          url:"function/sessionCartAdd.php",
          type:"POST",
          data:{proId:proId,quantiyy:1},
          dataType:"JSON"
        })
    })

</script>