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
	<title>二手撈寶/遊戲烏托邦-GameTopia</title>  
  <link rel="stylesheet" href="css/header.css">
  <link rel="stylesheet" href="css/footer.css">
  <link rel="stylesheet" type="text/css" href="css/nav.css">
  <link rel="Shortcut Icon" type="image/x-icon" href="images/gametopia.ico"/>
  <script src="js/jquery-1.9.1.min.js"></script>
  <script type="text/javascript" src="js/jquery-3.1.0.min.js"></script>
  <script type="text/javascript" src="js/two-hand-main.js"></script>
  <script type="text/javascript" src="js/jquery-canvas-sparkles.js"></script>
  <script type="text/javascript" src="js/chooseForMegami.js"></script>
  <link rel="stylesheet" href="css/megami.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <!-- <link rel="stylesheet" href="css/fontello.css"> -->
  <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
</head>
<body class="sh">  
<?php 
    error_reporting(E_ALL || ~E_NOTICE);
    include('function/header.php');
    include('function/memberBarSwitcher.php')
?>
    
  <div class="blackback"></div>
  <div class="backgroundCover"></div>
  <div class="back">

      <!-- 問題集 -->
      <div class="Qbox">
        <!-- 類型問題 -->
        <div class="Qtype">
          <div class="QtypeQ">請選擇遊戲類型</div>
          <div class="QtypesP">
            <div class="Qtypes" id="gameTypeAVG" onclick="chooseForMegami();">冒險犯難</div>
            <div class="Qtypes" id="gameTypeACT" onclick="chooseForMegami();">動作驚險</div>
            <div class="Qtypes" id="gameTypeMMO" onclick="chooseForMegami();">多人合作</div>
            <div class="Qtypes" id="gameTypeRAC" onclick="chooseForMegami();">競速刺激</div>
            <div class="Qtypes" id="gameTypeSLG" onclick="chooseForMegami();">策略多謀</div>
            <div class="Qtypes" id="gameTypeSPT" onclick="chooseForMegami();">運動休閒</div>
            <div class="Qtypes" id="gameTypeSTG" onclick="chooseForMegami();">即時射擊</div>
            <div class="Qtypes" id="gameTypeRPG" onclick="chooseForMegami();">角色扮演</div>
          </div>
          <input type="hidden" name="typeResult" value="">
        </div>
        <!-- 平台問題 -->
        <div class="QgameMom">
          <div class="QgameMomQ">請選擇遊戲平台</div>
          <div class="QgameMomsP">
            <div class="QgameMoms" id="gamePS" onclick="chooseForMegami();">PS4</div>
            <div class="QgameMoms" id="gameXBOX" onclick="chooseForMegami();">XBOX</div>
            <div class="QgameMoms" id="gameHH" onclick="chooseForMegami();">3DS</div>
            <div class="QgameMoms" id="gameWii" onclick="chooseForMegami();">Wii</div>
            <div class="QgameMoms" id="gamePC" onclick="chooseForMegami();">PC</div>
            <input type="hidden" name="consoleResult" value="">
          </div>
        </div>
        
      </div>
      
  
      <!-- 商品小圖 -->
<!--       <div class="productLightbox">
        <div class="productTitle">
          <div class="productImg">
            <img src="" alt="" name="resultImg">
          </div>
          <div class="view">
            <i class="fa fa-hand-pointer-o" aria-hidden="true"></i>
            <span>點我看更多</span>
          </div>
          <h2 class="productName" id="SH_productName"></h2>
        </div>
      </div> -->

      <!-- 商品詳細 -->
      <div class="productLightboxDetal">
        <div class="cancelBtn">
          <i class="fa fa-times icon-cancel" aria-hidden="true"></i>
        </div>
        <div class="productDetal">
          <div class="productPaW">
            <div class="productPic">
              <img id="SH_ProductImg" src="images/witcher3.jpg" alt="">
            </div>
            <div class="productTable">
              <table class="productWord">
                <tr>
                  <td colspan="2">
                    <h2 id="SH_productName_detail"></h2>
                  </td>
                </tr>
                <tr>
                  <td colspan="2">
                    <span class="gameMom" id="gameMomPS">PS</span>
                    <span class="gameMom" id="gameMom3DS">3DS</span>
                    <span class="gameMom" id="gameMomXBOX">XBOX</span>
                    <span class="gameMom" id="gameMomPC">PC</span>
                    <span class="gameMom" id="gameMomWii">Wii</span>
                  </td>
                </tr>
                <tr>
                  <th>二手價</th>
                  <td><span id="price">300</span>元</td>
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
                </tr>
               
                <tr>
                  <th>聯絡賣家</th>
                  <td><a href="#" id="sellMem">卍狂氣の川普卍</a></td>
                </tr>
              </table>
            </div>
          </div>
          <div class="productEx">
            <div class="productExContent">
              <p class="memo">備註</p>
              <p class="memoContent" id="SH_productmemo">商品9成新，包裝盒上有些許的刮傷磨損，內容物保存良好。</p>
            </div>
            <div class="productInfoImg">
              <img id="SH_productImg1" src="images/productD1.jpg" alt="">
              <img id="SH_productImg2" src="images/productD2.jpg" alt="">
              <img id="SH_productImg3" src="images/productD3.jpg" alt="">
            </div>
          </div>
        </div>
      </div>

      <!-- 對話框 -->
      <div class="megamiContent">
        <div class="megamiContentbox">
          <div class="megamiSpeakperson">
            女神
          </div>
          <div class="megamiBottonBar">
            <div class="megamiNextBox">
              <i class="fa fa-caret-down" aria-hidden="true"></i>
              <span class="megamiNextBotton">next</span>
            </div>
            <div class="megamiMoreagainBox">
              <img src="images/again.png" alt="">
              <span class="megamiAgainBotton">再一次</span>
            </div>
          </div>
          <p class="megamiContentword">勇者啊，請問您在尋找什麼呢？</p>
        </div>
      </div>  

      <!-- 女神 -->
      <div class="megami">
        <img id="megamiImg" src="images/anime.gif" alt="">
      </div>

      <!-- 水晶球光點點 -->
      <div class="megamiBg">
        <section class="stage">
              <!-- 商品小圖 -->
          <div class="productLightbox">
            <div class="productTitle">
              <div class="productImg">
                <img src="" alt="" name="resultImg">
              </div>
              <div class="view">
                <i class="fa fa-hand-pointer-o" aria-hidden="true"></i>
                <span>點我看更多</span>
              </div>
              <h2 class="productName" id="SH_productName"></h2>
            </div>
          </div>
          <figure class="ball bubble"></figure>
          <div class="light">
            <div class="heart-0"></div>
            <div class="heart-1"></div>
            <div class="heart-2"></div>
            <div class="heart-3"></div>
            <div class="heart-4"></div>
          </div>
        </section>  
        <!-- 水晶球 -->
        <figure class="ball bubble "></figure>    
      </div>
  </div>
<?php 

  include("function/footer.php");

?>
</body>
  <script type="text/javascript">
    $(document).ready(function(){
      $("*").sparkle();

    });
  </script>
</html>
