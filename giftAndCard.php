<?php
ob_start();
session_start();
?>

<?php
  error_reporting(E_ALL || ~E_NOTICE);
?>

<!DOCTYPE html>
<html lang="en">

<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>送禮專區/遊戲烏托邦-GameTopia</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="Shortcut Icon" type="image/x-icon" href="images/gametopia.ico"/>
	<meta name="Resource-type" content="Document"/>
	<link rel="stylesheet" type="text/css" href="css/header.css">
  <link rel="stylesheet" type="text/css" href="css/footer.css">
  <link rel="stylesheet" type="text/css" href="css/nav.css">
	<link rel="stylesheet" type="text/css" href="css/giftAndCard.css">
  <link rel="stylesheet" type="text/css" href="js/giftAndCard.js">
	<link rel="stylesheet" type="text/css" href="css/jquery.fullPage.css" />
	<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>
  <script src="js/jquery-3.1.0.min.js"></script>
	<script type="text/javascript" src="js/jquery.fullPage.js"></script>
	<script type="text/javascript" src="js/dragRole.js"></script>
  <script type="text/javascript" src="js/roleSelection.js"></script>

	<script type="text/javascript">
  $(document).ready(function() {
   $('#fullpage').fullpage({
    // sectionsColor: ['#1bbc9b', '#4BBFC3', '#7BAABE', 'whitesmoke', '#ccddff'],
    anchors: ['firstPage', 'secondPage', '3rdPage', '4thPage', '5thPage' , 'lastPage'],
    menu: '#menu',
    // easingcss3: 'cubic-bezier(0.175, 0.885, 0.320, 1.275)'
   });

   //====================== menuList ===========================
   var state = [1,0,0,0,0];
   var aaa= [0, 0, 0];
   var answer_1 = [0,0];
   var answer_2 = [0,0,0,0];
   var answer_3 = [0,0,0,0];
     var next = document.getElementsByClassName('next');
        console.log(next.length);
     answer_1[0] = document.getElementById('male');
     answer_1[1] = document.getElementById('female');
     answer_2[0] = document.getElementById('personality_1');
     answer_2[1] = document.getElementById('personality_2');
     answer_2[2] = document.getElementById('personality_3');
     answer_2[3] = document.getElementById('personality_4');
     answer_3[0] = document.getElementById('category_1');
     answer_3[1] = document.getElementById('category_2');
     answer_3[2] = document.getElementById('category_3');
     answer_3[3] = document.getElementById('category_4');
     answer_3[4] = document.getElementById('category_5');
     answer_3[5] = document.getElementById('category_6');
     answer_3[6] = document.getElementById('category_7');
     answer_3[7] = document.getElementById('category_8');
     var checkAnswer= document.getElementById('checkAnswer');
     
     for (var i = 0; i < next.length; i++) {
      next[i].addEventListener('click', pageState, false);
          if (i== 2) {
                     next[1].style.color= "#ccc";
                     next[2].style.color= "#ccc";
                     next[3].style.color= "#ccc";
                     next[4].style.color= "#ccc";
                     next[5].style.color= "#ccc";

                     next[1].style.cursor= "default";
                     next[2].style.cursor= "default";
                     next[3].style.cursor= "default";
                     next[4].style.cursor= "default";
                     next[5].style.cursor= "default";
                     // next[0] = document.getElementById('option1Icon').src="images/boy-with-tie-talking-white.png";
          }
     }
     document.getElementById('startForm').addEventListener('click', pageState, false);
     // console.log(document.getElementById('startForm'));
     for (var i = 0; i < answer_1.length; i++) {
      answer_1[i].addEventListener('click', pageState, false);
     }
     for (var i = 0; i < answer_2.length; i++) {
      answer_2[i].addEventListener('click', pageState, false);
     }
     for (var i = 0; i < answer_3.length; i++) {
      answer_3[i].addEventListener('click', pageState, false);
     }
     checkAnswer.addEventListener('click', pageState, false);

     function pageState(e){
       var target = this.innerHTML;
          console.log(target);

      if ( (target == next[0].innerHTML) && state[0] == 1 ) {


      }else if (target == next[1].innerHTML && state[1] == 0) {
      			    e.preventDefault();

      }else if (target == next[2].innerHTML && state[2] == 0) {
       // 點擊對象個性的按鈕，且上一題未完成，不跳頁
                e.preventDefault();

      }else if (target == next[3].innerHTML && state[3] == 0) {
       // 點擊對象喜歡遊戲類型的按鈕，且上一題未完成，不跳頁
                e.preventDefault();

      }else if ( (target == next[4].innerHTML || target == next[5].innerHTML) && state[4] == 0) {
            // 點擊卡片設計的按鈕，且上一題未完成，不跳頁
                e.preventDefault();

      }else if (target == document.getElementById('startForm').innerHTML){
                     next[1].style.color= "#000";
                     next[1].style.cursor= "pointer";
                     state[1]= 1;
      }
      else if (target == "男性" || target == "女性") {
                     next[2].style.color= "#000";
                     next[2].style.cursor= "pointer";
                     state[2]= 1;
                     aaa[0]= target;

      }else if (target == "積極主動" || target == "溫柔體貼" || target == "穩重內斂" || target == "熱情活潑") {            
                     next[3].style.color= "#000";
                     next[3].style.cursor= "pointer";
                     state[3]= 1;
                     aaa[1]= target;

      }else if (target == "冒險犯難" || target == "動作驚險" || target == "多人合作" || target == "競速刺激" || target == "策略多謀" || target == "運動休閒" || target == "即時射擊" || target == "角色扮演") {
                     next[4].style.color= "#000";
                     next[5].style.color= "#000";
                     next[4].style.cursor= "pointer";
                     next[5].style.cursor= "pointer";
                     state[4]= 1;
                     aaa[2]= target;
                     loadSuggestProd();
      }
    }
    function loadSuggestProd() {
      var xhr= new XMLHttpRequest();

      xhr.onreadystatechange= function(){
        if (xhr.readyState == 4) {
          if (xhr.status == 200) {
            //把結果拿出來放進推薦商品內
            document.getElementById('inputSuggestProdResult').innerHTML= xhr.responseText;

            // <div class="singlePro">
            //   <div class="singleProBox">
            //     <img src="images/witcher3.jpg">                
            //     <h5>巫師3:狂獵</h5>
            //     <div class="tag">PS4</div>
            //     <div class="tag">動作</div>
            //     <p class="price">NT$878</p>
            //   </div>
            // </div>
          }else {
            alert( xhr.status );
          }
        }
      }

      var url= "function/findSuggestProd.php?gender="+ aaa[0]+ "&personality="+ aaa[1]+ "&category="+ aaa[2];
      xhr.open("Get", url, true);
      xhr.send( null );
    }
  });
 </script>

 <script type="text/javascript">

    // function hoverChangeRole(){
    //   document.getElementById("original").src = "images/male_original.png";
    // }

    // function hoverFinished(){
    //   document.getElementById("original").src = "images/empty.png";
    // }
 // document.getElementById("male").addEventListener("mouseover" , hoverChangeRole)
 // document.getElementById("male").addEventListener("mouseout" , hoverFinished)
 //   function hoverChangeRole(){
 //      document.getElementById("original").src = "i"
 //   }

 </script>

</head>
<body>

<?php

  include("function/header.php");
  include("function/memberBarSwitcher.php");

?>
<script src="js/jquery-3.1.0.min.js"></script>
<script type="text/javascript" src="js/jquery.fullPage.js"></script>

<!--=======================導覽列按鈕=====================-->
<ul id="menu">  
  <li data-menuanchor="firstPage" id="option1">
    <!-- <span>
      <a href="#firstPage"></a>
    </span> -->
    <a href="#firstPage" class="next"><span><img id="option1Icon" src="images/question-speech-bubble.png"></span>送禮說明</a>
  </li>
  <li data-menuanchor="secondPage" id="option2">
   <!--  <span>
      <a href="#secondPage"><img id="option2Icon" src="images/gender-symbols.png"></a>
    </span>     -->
    <a href="#secondPage" class="next"><span><img id="option2Icon" src="images/gender-symbols.png"></span>對象性別</a>
  </li>
  <li data-menuanchor="3rdPage" id="option3">
    <a href="#3rdPage" class="next"><span><img src="images/head.png"></span>對象個性</a>
  </li>
  <li data-menuanchor="4thPage" id="option4">
    <a href="#4thPage" class="next"><span><img src="images/icon.png"></span>遊戲類型</a></li>
  <li data-menuanchor="5thPage" id="option5">
    <a href="#5thPage" class="next"><span><img src="images/christmas-card.png"></span>卡片設計</a>
  </li>
  <li data-menuanchor="lastPage" id="option6">
    <a href="#lastPage" class="next"><span><img src="images/present.png"></span>禮物選擇</a>
  </li>
</ul>

<div id="fullpage">
	<div class="section" id="section0" name="section0"> 

      <div class="page_container" id="page_container0">
		    <div class="page1Text">
  	  		<p>還在煩惱要送什麼禮物給朋友嗎？</p>
  	  		<p>烏托邦協助你依量身需求送禮喔！</p>
  	  	</div>
  	  	<div class="explanation">
  	  		<div class="explanationInside">
	  	  		<p id="expTitle">送禮專區說明</p>
	  	  		<p id="expText">透過以下幾個簡單的問題，即可透過您所回答的問題，由系統提供推薦商品，並製作專屬的禮物卡片送給朋友。讓我們為朋友精心挑選一個適合的禮物吧！</p>
	  	  		<div id="expStep" class="expStep1">
	  	  			<div class="stepDescribe">
	  	  				<div class="stepIcon">
	  	  					<img src="images/help-web-button.png">
	  	  				</div>
	  	  				<div class="stepTitle">
	  	  				<p>步驟一</p>
	  	  				<p>回答以下問題</p>
	  	  				</div>
	  	  			</div>
	  	  			<div class="stepDescribe">
	  	  				<div class="stepIcon">
	  	  					<img src="images/xmas-card.png">
	  	  				</div>
	  	  				<div class="stepTitle">
	  	  				 <p>步驟二</p>
	  	  				 <p>選擇卡片樣式</p>
	  	  				</div>
	  	  			</div>
	  	  			<div class="stepDescribe">
	  	  				<div class="stepIcon">
	  	  					<img src="images/column-with-rows-content-layout.png">
	  	  				</div>
	  	  				<div class="stepTitle">
	  	  				 <p>步驟三</p>
	  	  				 <p>撰寫卡片內容</p>
	  	  				</div>
	  	  			</div>
	  	  			<div class="stepDescribe">
	  	  				<div class="stepIcon">
	  	  					<img src="images/gift.png">
	  	  				</div>
	  	  				<div class="stepTitle">
	  	  				 <p>步驟四</p>
	  	  				 <p>挑選贈送禮物</p>
	  	  				</div>
	  	  			</div>
	        	</div>
        	</div>                  
  	  	</div>
  	  	<div class="giveGift">
  	  		<a href="#secondPage"><div class="btnMain" id="startForm">開始送禮</div></a>
  	  	</div>
  	  </div>
	</div>
	<div class="section" id="section1" name="section1">
		
      <div class="page_container" id="page_container1">
            <div class="leftCol">
            	<div class="floater"></div>
                <div class="role">
                    <div class="roleImgbox">
                    	<img src="images/empty.png" id="original">
                    </div>    
                </div>
            </div>
            
            <div class="rightCol">
            	<div class="floater1"></div>
            	<div class="combine">
            		<img src="images/diamond.png" id="diamond">	                    
	                <div class="question">
	                    <p>Q1：請問送禮對象的性別？</p>
	                </div>
	                <div class="options1">
	                  <a href="#3rdPage"><div class="btnMain" id="male" onclick="changeSex('male')" onmouseover="hoverChangeSex('male')">男性</div></a>
	                  <a href="#3rdPage"><div class="btnMain" id="female" onclick="changeSex('female')" onmouseover="hoverChangeSex('female')">女性</div></a>
	                </div>
                </div>                
            </div>
        </div>
	</div>
	<div class="section" id="section2">
		
	    <div class="page_container" id="page_container2">
            <div class="leftCol">
            	<div class="floater"></div>
                <div class="role">
                	<div class="roleImgbox">
                    	<img src="images/empty.png" id="personality" name="3rdPageRole">
                    </div>
                </div>
            </div>
            
            <div class="rightCol">
            	<div class="floater1"></div>
            	<div class="combine">
            		<img src="images/diamond.png" id="diamond">
	                <div class="question">
	                    <p>Q2：請問送禮對象的個性？</p>
	                </div>
	                <div class="options2">
	                    <div class="option">
	                      <a href="#4thPage"><div class="btnMain" id="personality_1" onclick="changePersonality('personality_1')" onmouseover="hoverChangePersonality('personality_1')">積極主動</div></a>
	                      <a href="#4thPage"><div class="btnMain" id="personality_2" onclick="changePersonality('personality_2')" onmouseover="hoverChangePersonality('personality_2')">溫柔體貼</div></a>
	                    </div>
	                    <div class="option">
	                      <a href="#4thPage"><div class="btnMain" id="personality_3" onclick="changePersonality('personality_3')" onmouseover="hoverChangePersonality('personality_3')">穩重內斂</div></a>
	                      <a href="#4thPage"><div class="btnMain" id="personality_4" onclick="changePersonality('personality_4')" onmouseover="hoverChangePersonality('personality_4')">熱情活潑</div></a>
	                    </div>
	                </div>
                </div>
            </div>
	    </div>
	</div>

	<div class="section" id="section3">
		
	    <div class="page_container" id="page_container3">	    	
            <div class="leftCol">
            	<div class="floater"></div>
                <div class="role">
                	<div class="roleImgbox">
                    	<img src="images/empty.png" id="category">
                    </div>
                </div>
            </div>
	            
            <div class="rightCol">
            	<div class="floater1"></div>
            	<div class="combine">
            		<img src="images/diamond.png" id="diamond">
	                <div class="question">
	                    <p>Q3：送禮對象喜歡的遊戲類型？</p>
	                </div>
	                <div class="options2">
	                    <div class="option">
	                      <a href="#5thPage"><div class="btnMain" id="category_1" onclick="changeGameType('category_1')" onmouseover="hoverChangeGameType('category_1')">冒險犯難</div></a>
	                      <a href="#5thPage"><div class="btnMain" id="category_2" onclick="changeGameType('category_2')" onmouseover="hoverChangeGameType('category_2')">動作驚險</div></a>
	                      <a href="#5thPage"><div class="btnMain" id="category_3" onclick="changeGameType('category_3')" onmouseover="hoverChangeGameType('category_3')">多人合作</div></a>
	                      <a href="#5thPage"><div class="btnMain" id="category_4" onclick="changeGameType('category_4')" onmouseover="hoverChangeGameType('category_4')">競速刺激</div></a>
	                    </div>
	                    <div class="option">
	                      <a href="#5thPage"><div class="btnMain" id="category_5" onclick="changeGameType('category_5')" onmouseover="hoverChangeGameType('category_5')">策略多謀</div></a>
	                      <a href="#5thPage"><div class="btnMain" id="category_6" onclick="changeGameType('category_6')" onmouseover="hoverChangeGameType('category_6')">運動休閒</div></a>
	                      <a href="#5thPage"><div class="btnMain" id="category_7" onclick="changeGameType('category_7')" onmouseover="hoverChangeGameType('category_7')">即時射擊</div></a>
	                      <a href="#5thPage"><div class="btnMain" id="category_8" onclick="changeGameType('category_8')" onmouseover="hoverChangeGameType('category_8')">角色扮演</div></a>
	                    </div>
	                </div>
	            </div>
            </div>
	    </div>		
	</div>

	<div class="section" id="section4">
		
	    <div class="page_container" id="page_container4">	    	
            <div class="leftCol2">
            	<div class="floater3"></div>
            	<div class="page5Text">
            		<p>送禮對象形象如下</p>
            	</div>              
              <div class="role">
              	<div class="roleImgbox" id="roleTransId">
              		<img src="images/empty.png" id="finalRole">
              	</div>
              </div>
            </div>

            <div class="arrowInstruction">              
              <img src="images/arrow-gift0.png">
              <p>請拖曳人物至卡片上製作與裝飾</p>
              <div class="roleCardPreviewMobile">
                <span><img src="images/push-pin.png"></span>
                <p>形象卡片預覽</p>
              </div>
              
              <!--手機版所使用的大張卡片(放上人物的那張預覽卡片-->
              <div class="cardForMobile" id="dragRoleForMobile">
                <img src="images/blue.png" id="cardForMobile">
                <div class="roleFinal" id="roleFinalForMobile">
                  <img src="images/roleFinal_empty.png" id="roleFinalPictureForMobile">
                </div>    
              </div>
            </div>

            <!-- <div class="floater2"></div> -->
            <div class="rightCol2">            
            	<div class="floater2"></div>
            	<div class="combine1">            
	                <div class="cardPreview">
	                	<div class="preTitle">
	                		<p>卡片製作及預覽</p>
	                	</div>                	
	                	<div class="card" id="dragRole">
	                		<img src="images/blue.png" id="card">
	                		<div class="roleFinal" id="roleFinal">
                        <img src="images/roleFinal_empty.png" id="roleFinalPicture">
                      </div> 		
	                	</div>
	                	<div class="cardStyle">
	                		<div class="style style1" id="style1" onclick="changeCardStyle('style1')"><img src="images/blue.png"></div>
	                		<div class="style style2" id="style2" onclick="changeCardStyle('style2')"><img src="images/green.png"></div>
	                		<div class="style style3" id="style3" onclick="changeCardStyle('style3')"><img src="images/orange.png"></div>
	                		<div class="style style4" id="style4" onclick="changeCardStyle('style4')"><img src="images/pink.png"></div>
		                    <div class="style style5" id="style5" onclick="changeCardStyle('style5')"><img src="images/purple.png"></div>
		                    <div class="style style6" id="style6" onclick="changeCardStyle('style6')"><img src="images/white.png"></div>
	                	</div>
	                </div>                
	                <div class="cardDeco">                	
	                	<div class="cardText">
	                		<input type="textarea" name="textarea" id="textarea" placeholder="請在此區域輸入卡片內容…">
	                	</div>
	                </div>                
	                <div class="confirm">
	                  <a href="#lastPage"><div class="btnMain" id="btnConfirm">確認送出</div></a>
	                </div>
                </div>
            </div>
	    </div>
	</div>

	<div class="section" id="section5">
		
        <div class="page_container" id="page_container5">
	    	<!-- div class="resultTitle">
	    		<p>烏托邦推薦以下商品送給您的朋友！</p>
	    	</div> -->
        <div class="proRecommend">
          <div class="resultTitle">
            <p>烏托邦推薦以下商品送給您的朋友！</p>
          </div>
          <div class="proRow" id="inputSuggestProdResult">

            <div class="singlePro">
              <div class="singleProBox">
                <img src="images/witcher3.jpg">                
                <h5>巫師3:狂獵</h5>
                <div class="tag">PS4</div>
                <div class="tag">動作</div>
                <p class="price">NT$878</p>
              </div>
            </div>

            <div class="singlePro">
              <div class="singleProBox">
                <img src="images/Warframe.jpg">                
                <h5>戰甲神兵</h5>
                <div class="tag">XBOX</div>
                <div class="tag">射擊</div>
                <p class="price">NT$878</p>
              </div>
            </div>

            <div class="singlePro">
              <div class="singleProBox">
                <img src="images/Mafia3.jpg">                
                <h5>四海兄弟3</h5>
                <div class="tag">PC</div>
                <div class="tag">角色扮演</div>
                <p class="price">NT$878</p>
              </div>
            </div>

            <div class="singlePro">
              <div class="singleProBox">
                <img src="images/Mafia3.jpg">                
                <h5>四海兄弟3</h5>
                <div class="tag">PC</div>
                <div class="tag">角色扮演</div>
                <p class="price">NT$878</p>
              </div>
            </div><!-- 

            <div class="singlePro singleProForMobile">
              <div class="singleProBox">
                <img src="images/Mafia3.jpg">                
                <h5>四海兄弟3</h5>
                <div class="tag">PC</div>
                <div class="tag">角色扮演</div>
                <p class="price">NT$878</p>
              </div>
            </div>

            <div class="singlePro singleProForMobile">
              <div class="singleProBox">
                <img src="images/Mafia3.jpg">                
                <h5>四海兄弟3</h5>
                <div class="tag">PC</div>
                <div class="tag">角色扮演</div>
                <p class="price">NT$878</p>
              </div>
            </div> -->

            <!-- <div class="singlePro singleProForMobile">
              <div class="singleProBox">
                <img src="images/Mafia3.jpg">                
                <h5>四海兄弟3</h5>
                <div class="tag">PC</div>
                <div class="tag">角色扮演</div>
                <p class="price">NT$878</p>
              </div>
            </div>

            <div class="singlePro singleProForMobile">
              <div class="singleProBox">
                <img src="images/Mafia3.jpg">                
                <h5>四海兄弟3</h5>
                <div class="tag">PC</div>
                <div class="tag">角色扮演</div>
                <p class="price">NT$878</p>
              </div>
            </div> -->

          </div>

        </div>
	    	<div class="proMore">
	    		<a href=""><div class="btnMain">更多商品</div></a>
	    	</div>           
	    </div>
	</div>
</div>

<!-- <div id="snowflakeContainer">
    <p class="snowflake">*</p>
</div> -->
  <?php 

  // include("function/footer.php");

  ?>  
</body>  
</html>
<script>
  $('#btnConfirm').click(function(){
  var cardImg = $('#finalRole').attr('src');
  var cardBG = $('#card').attr('src');
  var cardInfo = $('#textarea').val();

  console.log(cardImg);
  console.log(cardBG);
  console.log(cardInfo);

  $.ajax({

    url: "function/sessionCartAdd.php",
    type: "POST",
    data: {cardImg:cardImg,cardBG:cardBG,cardInfo:cardInfo},
    dataType: "JSON"

  })

})
</script>