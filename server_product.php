<?php

require_once('function/connectSQL.php');

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>後端-商品管理</title>
<link rel="shortcut icon" href="01_LOGO.png">
<style type="text/css"></style>
<link href="./view_pages.css" rel="stylesheet" type="text/css">
<script type="text/javascript" src="js/jquery-3.1.0.min.js"></script>
</head>

<body>

<!--側邊選單-->
<div id="menu">
  <div id="logo_container"> <img id="logo" src="01_LOGO.png"> </div>
  <div id="menu_header">Welcome，管理員: 金城五~</div>
  <ul id="menu_ul">
    <li><a href="file:///C:/Users/user/Desktop/server/server_member.html">會員管理</a></li>
    <li><a href="file:///C:/Users/user/Desktop/server/server_orders.html">訂單管理</a></li>
    <li id="menu_now">商品管理</li>
    <li><a href="file:///C:/Users/user/Desktop/server/server_news.html">新聞管理</a></li>
    <li><a href="file:///C:/Users/user/Desktop/server/server_forum.html">討論區管理</a></li>
    <li><a href="file:///C:/Users/user/Desktop/server/server_station_letter.html">站內信管理</a></li>
  </ul>
  <div id="menu_footer"><a href="">登出</a></div>
</div>
<!--menu-->

<div id="content_wrap">
  <div id="container">
    <div id="content_topic"> <!--標題-->
      <div id="topic">商品管理</div>
    </div>
    <div id="add" style="cursor: pointer;"><a class="add_button">新增</a></div>
    <!--新增按鈕-->
    <div class="addProductCube">
      <form action="function/productInput.php" method="post" enctype="multipart/form-data">
           <label for="proImg">主要圖片</label>
           <input type="file" name="proImg">
           <label for="proPic01">副圖片 01</label>
           <input type="file" name="proPic01">
           <label for="proPic02">副圖片 02</label>
           <input type="file" name="proPic02">
           <label for="proPic03">副圖片 03</label>
           <input type="file" name="proPic03">
           <label for="proName">商品名稱</label>
           <input type="text" name="proName">
           <label for="proSeries">商品主機別</label>
           <select name="proSeries">
             <option value="none">請選擇</option>
             <option value="PS4">PS4</option>
             <option value="XBOX">XBOX</option>
             <option value="Wii">Wii</option>
             <option value="3DS">3DS</option>
             <option value="PC">PC</option>
           </select>
           <label for="proCLass">遊戲類別</label>
           <select name="proClass">
             <option value="none">請選擇</option>
             <option value="冒險犯難">冒險犯難</option>
             <option value="動作驚險">動作驚險</option>
             <option value="多人合作">多人合作</option>
             <option value="競速刺激">競速刺激</option>
             <option value="策略多謀">策略多謀</option>
             <option value="運動休閒">運動休閒</option>
             <option value="即時射擊">即時射擊</option>
             <option value="角色扮演">角色扮演</option>
           </select>
           <label for="proInfo">商品說明</label>
           <textarea name="proInfo" cols="30" rows="10"></textarea>
           <label for="proPrice">商品價格</label>
           <input type="text" name="proPrice">
           <label for="submit"></label>
           <button type="submit">確認送出</button>
      </form> 
           <button class="pro_cancelInput">取消</button>
    </div>
    
    <div id="content_table"> <!--表格內容-->
      
      <table border="0" class="data_table">
        <tbody>
          <tr class="proTitle"> <!--表格th-->
            <th>商品編號</th>
            <th>商品類別</th>
            <th>主機別</th>
            <th>遊戲類別</th>
            <th>商品名稱</th>
            <th>商品圖</th>
            <th>價格</th>  
            <th>狀態</th>
            <th>動作</th>
          </tr>
          
          <?php

            //現有商品 ROWOUT
            $proQuery = "SELECT * FROM products ORDER BY id DESC";
            $proRec = $pdo->query($proQuery);
            while($proRow = $proRec->fetch(PDO::FETCH_ASSOC)){

          ?>

          <tr class="proIntroCol">
            <td><?php echo $proRow["proId"]; ?></td>
            <td><?php echo $proRow["proType"]; ?></td>
            <td><?php echo $proRow["proSeries"]; ?></td>
            <td><?php echo $proRow["proClass"]; ?></td>
            <td><?php echo $proRow["proName"]; ?></td>
            <td class="proImg">
              <img src="<?php echo $proRow["proImg"]; ?>">
              <img src="<?php echo $proRow["proPic01"]; ?>">
              <img src="<?php echo $proRow["proPic02"]; ?>">
              <img src="<?php echo $proRow["proPic03"]; ?>">
            </td>
            <td><?php echo $proRow["proPrice"]; ?></td>
            <td><?php echo $proRow["display"]; ?></td>
            <td class="proUpdate" style="cursor: pointer;" value="<?php echo $proRow["proId"]; ?>">修改</td>
          </tr>
          
          <div class="proUpdateCube" id="<?php echo $proRow["proId"]; ?>">
              <form action="function/server_productUpdate.php" method="post" enctype="multipart/form-data">
                     <input type="hidden" name="proId" value="<?php echo $proRow["proId"]; ?>">
                     <label for="proImg">主要圖片</label>
                     <input type="file" name="proImg">
                     <label for="proPic01">副圖片 01</label>
                     <input type="file" name="proPic01">
                     <label for="proPic02">副圖片 02</label>
                     <input type="file" name="proPic02">
                     <label for="proPic03">副圖片 03</label>
                     <input type="file" name="proPic03">
                     <label for="proName">商品名稱</label>
                     <input type="text" name="proName" placeholder="<?php echo $proRow["proName"]; ?>">
                     <label for="proInfo">商品說明</label>
                     <textarea name="proInfo" cols="30" rows="10" placeholder="<?php echo $proRow["proInfo"]; ?>"></textarea>
                     <label for="proPrice">商品價格</label>
                     <input type="text" name="proPrice">
                     <label for="display">狀態調整</label>
                     <select name="display">
                       <option value="none">不變動</option>
                       <option value="上架">上架</option>
                       <option value="下架">下架</option>
                     </select>
                     <label for="submit"></label>
                     <button type="submit">確認送出</button>
              </form>
                      <button class="pro_cancelUpdate">取消</button>
          </div>

          <?php } ?>
        
        </tbody></table>
<!-- 以下印頁碼區 -->      
      <table class="data_table2" id="pagecss">  
          <tbody><tr>
           <td><a href=""><font color="#8f2b2b"><u>1</u></font></a></td>
         </tr>
          </tbody>
     </table>
<!-- 以上印頁碼區 -->
    </div><!--content_table--> 
    
  </div>
  <!--container-->
  
  <div id="content_footer"><!--頁尾--> 
    Copyright © since 2016 gametopia.com.tw All Rights Reserved.</div>
</div><!--content_wrap-->

</body>
</html>
<script>
    $('.proUpdate').click(function(){

        var proId = $(this).attr('value');

        $('#'+proId).css("display","block");

        ifWannaCancel(proId);

    })

    function ifWannaCancel(proId){

      $('.pro_cancelUpdate').click(function(){

          $('#'+proId).css("display","none");

      })

    }

    $('#add').click(function(){

        $('.addProductCube').css("display","block");

        ifDontInputProduct()

    })

    function ifDontInputProduct(){

        $('.pro_cancelInput').click(function(){

          $('.addProductCube').css("display","none");

        })

    }
</script>