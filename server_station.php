<?php
require_once('function/connectSQL.php');
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>後端-網頁管理</title>
<link rel="shortcut icon" href="01_LOGO.png">
<style type="text/css"></style>
<link href="./view_pages.css" rel="stylesheet" type="text/css">

<style>
  .news_banner{
    width: 100%;
    height: 100%;
    max-width: 475px;
    max-height: 60px;
  }
  .product_slider{
    width: 100%;
    height: 100%;
    max-width: 240px;
    max-height: 130px;
  }
  .productBanner{
    width: 100%;
    height: 100%;
    max-width: 145px;
    max-height: 285px;
  }
</style>


</head>

<body>
 
<!--側邊選單-->
  <div id="menu">
     <div id="logo_container">
      <img id="logo" src="01_LOGO.png">
     </div>     
     <div id="menu_header">
      Welcome，管理員: 金城五~ 
     </div> 
     <ul id="menu_ul">
        <li><a href="file:///C:/Users/user/Desktop/server/server_member.html">會員管理</a></li>
        <li><a href="server_orders.php">訂單管理</a></li>
        <li><a href="server_product.php">商品管理</a></li>
        <li><a href="server_news.php">新聞管理</a></li>
        <li><a href="server_forum.php">討論區管理</a></li>
        <li id="menu_now">網頁管理</li>
     </ul>
     <div id="menu_footer"><a href="">登出</a></div>
  </div><!--menu-->

<div id="content_wrap">
  <div id="container">

      <div id="content_topic">              <!--標題-->
        <div id="topic">廣告管理-新聞頁</div>
      </div> 
     
      <div id="add"><div id="searcharea">
      <!-- <form action="">
  		<select name="field">
    		<option value="art_name">會員站內信</option>
            <option value="art_type">系統站內信</option>
  		</select>
  		<input type="text" name="data">
  		<input type="submit" value="搜尋">
	  </form> -->
      </div><a href=""></a></div>  <!--新增按鈕--> 

    <div id="content_table">             <!--表格內容-->
       
       <table border="0" class="data_table">
           <tbody>
              <?php
                $newsBannerQuery = "SELECT * FROM banner WHERE bannerType = '新聞banner-1' OR bannerType = '新聞banner-2' OR bannerType = '新聞banner-3' OR bannerType = '新聞banner-4' ORDER BY bannerType ASC";
                $newsBannerRec = $pdo->query($newsBannerQuery);
                $newsBannerArr = array();
                while($newsBannerRow = $newsBannerRec->fetch(PDO::FETCH_ASSOC)){
                  $newsBannerArr[] = $newsBannerRow["bannerImg"];
                }
               
              ?>
              <tr>
                <td>新聞頁banner-1</td>
                <td>新聞頁banner-2</td>
                <td>新聞頁banner-3</td>
                <td>新聞頁banner-4</td>
              </tr>
              <tr>
                <td>
                  <img src="<?php echo $newsBannerArr[0]; ?>" class="news_banner">
                </td>
                <td>
                  <img src="<?php echo $newsBannerArr[1]; ?>" class="news_banner">
                </td>
                <td>
                  <img src="<?php echo $newsBannerArr[2]; ?>" class="news_banner">
                </td>
                <td>
                  <img src="<?php echo $newsBannerArr[3]; ?>" class="news_banner">
                </td>

                <form action="function/bannerManager.php" method="post" enctype="multipart/form-data">
                    <tr>
                      <td>
                        <label for="news_banner_1">變更banner</label>
                        <input type="file" name="news_banner_1">
                        <input type="text" name="news_banner_1_href" placeholder="請輸入連結網址">
                      </td>
                      <td>
                        <label for="news_banner_1">變更banner</label>
                        <input type="file" name="news_banner_2">
                        <input type="text" name="news_banner_2_href" placeholder="請輸入連結網址">
                      </td>
                      <td>
                        <label for="news_banner_1">變更banner</label>
                        <input type="file" name="news_banner_3">
                        <input type="text" name="news_banner_3_href" placeholder="請輸入連結網址">
                      </td>
                      <td>
                        <label for="news_banner_1">變更banner</label>
                        <input type="file" name="news_banner_4">
                        <input type="text" name="news_banner_4_href" placeholder="請輸入連結網址">
                      </td>
                    </tr>
                    <tr>
                      <td>
                        <input type="hidden" name="bannerFrom" value="news">
                        <button type="submit">確認送出</button>
                        <button type="reset">重置</button>
                      </td>
                    </tr>
                </form>      
          </tbody>
      </table>

      <div id="content_topic">              <!--標題-->
        <div id="topic">廣告管理-商品頁</div>
      </div> 
      
      <table border="0" class="data_table">
        <tr>
          <td colspan="2">商品頁slider-01</td>
          <td colspan="2">商品頁slider-02</td>
          <td colspan="2">商品頁slider-03</td>
        </tr>

        <?php
          $productSliderQuery = "SELECT * FROM banner WHERE bannerType = '商品頁slider-1' OR bannerType = '商品頁slider-2' OR bannerType = '商品頁slider-3' ORDER BY bannerType ASC";
          $productSliderRec = $pdo->query($productSliderQuery);
          $proSlider = array();

          while($productSliderRow = $productSliderRec->fetch(PDO::FETCH_ASSOC)){
            $proSlider[] = $productSliderRow["bannerImg"];
          }
        ?>
        <form action="function/bannerManager.php" method="post" enctype="multipart/form-data">
          <tr>
            <td>
              <img src="<?php echo $proSlider[0]; ?>" class="product_slider">
            </td>
            <td>
              <label for="product_slider_1">變更banner</label><br>
              <input type="file" name="product_slider_1">
              <input type="text" name="product_slider_1_href" placeholder="請輸入連結網址">
            </td>
            <td>
              <img src="<?php echo $proSlider[1]; ?>" class="product_slider">
            </td>
            <td>
              <label for="product_slider_2">變更banner</label><br>
              <input type="file" name="product_slider_2">
              <input type="text" name="product_slider_2_href" placeholder="請輸入連結網址">
            </td>
            <td>
              <img src="<?php echo $proSlider[2]; ?>" class="product_slider">
            </td>
            <td>
              <label for="product_slider_3">變更banner</label><br>
              <input type="file" name="product_slider_3">
              <input type="text" name="product_slider_3_href" placeholder="請輸入連結網址">
            </td>
          </tr>
          <tr>
            <td>
              <input type="hidden" name="bannerFrom" value="product_slider">
              <button type="submit">確認送出</button>
              <button type="reset">重置</button>
            </td>
          </tr>
        </form>
        
        <form action="function/bannerManager.php" method="post" enctype="multipart/form-data">
          <?php
            $productBannerQuery = "SELECT * FROM banner WHERE bannerType = '商品頁banner-1' OR bannerType = '商品頁banner-2' ORDER BY bannerType ASC";
            $productBannerRec = $pdo->query($productBannerQuery);
            $proBanner = array();

            while($productBannerRow = $productBannerRec->fetch(PDO::FETCH_ASSOC)){
              $proBanner[] = $productBannerRow["bannerImg"];
            }
          ?>
          <tr>
            <tr>
              <td colspan="2">
                商品頁banner-1
              </td>
              <td colspan="2">
                商品頁banner-2
              </td>
            </tr>
            <td>
              <img src="<?php echo $proBanner[0]; ?>" class="productBanner">
            </td>
            <td>
              <label for="produt_banner_1">變更banner</label><br>
              <input type="file" name="product_banner_1">
              <input type="text" name="product_banner_1_href" placeholder="請輸入連結網址">
            </td>
            <td>
              <img src="<?php echo $proBanner[1]; ?>" class="productBanner">
            </td>
            <td>
              <label for="produt_banner_2">變更banner</label><br>
              <input type="file" name="product_banner_2">
              <input type="text" name="product_banner_2_href" placeholder="請輸入連結網址">
            </td>
          </tr>
          <tr>
            <td>
              <input type="hidden" name="bannerFrom" value="productBanner">
              <button type="submit">確認送出</button>
              <button type="reset">重置</button>
            </td>
          </tr>
        </form>
      </table>
      
<!-- 以下印頁碼區 -->      
      <table class="data_table2" id="pagecss">  
          <tbody><tr>
           <td><a href=""><font color="#8f2b2b"><u></u></font></td>
         </tr>
      </tbody></table>
<!-- 以上印頁碼區 -->           
    </div><!--content_table-->

  </div><!--container-->
        
        <div id="content_footer"><!--頁尾-->
           Copyright © since 2016 gametopia.com.tw All Rights Reserved.
        </div>
</div><!--content_wrap-->

</body>
</html>