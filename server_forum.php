<?php
require_once('function/connectSQL.php');
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>後端-討論區管理</title>
<link rel="shortcut icon" href="01_LOGO.png">
<style type="text/css"></style>
<link href="./view_pages.css" rel="stylesheet" type="text/css">
<script src="js/jquery-3.1.0.min.js"></script>

<style>
  .messageControl{
    margin-top: 30px;
  }
  .commentInfoContenter{
    position: relative;
  }
  .commentInfo{
    outline: 3px solid black;
    display: none;
    padding: 15px;
    background-color: white;
    width: 180%;
    line-height: 20px;
    position: absolute;
    top: -10%;
    left: -15%;
    z-index: 11;
  }
  .replyInfoContenter{
    position: relative;
  }
  .replyInfo{
    outline: 3px solid black;
    display: none;
    padding: 15px;
    background-color: white;
    width: 180%;
    line-height: 20px;
    position: absolute;
    top: -10%;
    left: -15%;
    z-index: 11;
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
        <li><a href="file:///C:/Users/user/Desktop/server/server_orders.html">訂單管理</a></li>
        <li><a href="file:///C:/Users/user/Desktop/server/server_second_hand_product.html">商品管理</a></li>
        <li><a href="file:///C:/Users/user/Desktop/server/server_news.html">新聞管理</a></li>
        <li id="menu_now">留言檢舉</li>
        <li><a href="file:///C:/Users/user/Desktop/server/server_station_letter.html">網站管理</a></li>
     </ul>
     <div id="menu_footer"><a href="">登出</a></div>
  </div><!--menu-->

<div id="content_wrap">
  <div id="container">

      <div id="content_topic">              <!--標題-->
        <div id="topic">討論區</div>
      </div> 
     
         <div id="add"><div id="addgap">
      <!-- <form action="">
  		<select name="field">
    		<option value="record_no">類別</option>
    		<option value="record_peo">PS4</option>
            <option value="record_date">PS2</option>
  		</select>
  		<input type="text" name="data">
  		<input type="submit" value="搜尋">
	  </form> -->
      </div></div>  <!--新增按鈕--> 

    <div id="content_table">             <!--表格內容-->
       
       <table border="0" class="data_table">
       
         <tbody>
           <tr>                          <!--表格th-->
               <th>留言編號</th>
               <th>文章所在</th>
               <th>留言會員</th>
               <th>留言日期</th>
               <th>留言內容</th>             
               <th>處理方式</th>
           </tr>
            
            <?php
              $commentsTitleQuery = "SELECT * FROM comments WHERE status = '檢舉'";
              $commentsTitleRec = $pdo->query($commentsTitleQuery);
              while($commentsTitleRow = $commentsTitleRec->fetch(PDO::FETCH_ASSOC)){
            ?>

           <tr>
               <td><?php echo $commentsTitleRow["comId"]; ?></td>
               <td><?php echo $commentsTitleRow["comPlatform"]; ?></td>
               <td><?php echo $commentsTitleRow["memAccount"]; ?></td>
               <td><?php echo $commentsTitleRow["comDate"]; ?></td>
               <td class="commentInfoContenter" style="cursor: pointer;">
                  <?php echo $commentsTitleRow["comTitle"]; ?>
                 <div class="commentInfo">
                    <?php echo $commentsTitleRow["comTitle"]; ?><br><br>
                    <?php echo $commentsTitleRow["comContent"]; ?>
                 </div>
               </td>
               <td>
                  <button onclick="location.href='function/reportManager.php?dealType=comRecover&comId=<?php echo $commentsTitleRow["comId"]; ?>'">恢復</button>
                  <button onclick="location.href='function/reportManager.php?dealType=comDelete&comId=<?php echo $commentsTitleRow["comId"]; ?>'">刪除</button>
               </td>
           </tr>

           <?php } ?>
     
       </tbody>
      </table>


<!-- 以下印頁碼區 -->      
      <table class="data_table2" id="pagecss">  
          <tbody><tr>
           <td> <a href=""><font color="#8f2b2b"><u>1</u></font></a></td>
         </tr>
      </tbody></table>
<!-- 以上印頁碼區 -->
    </div><!--content_table-->

    

    <div id="content_table" class="messageControl">             <!--表格內容-->
       <div id="content_topic">              <!--標題-->
        <div id="topic">留言</div>
       </div> 
       <table border="0" class="data_table">
      
           <tbody>
           <tr>                          <!--表格th-->
               <th>留言編號</th>
               <th>文章所在</th>
               <th>留言會員</th>
               <th>留言日期</th>
               <th>留言內容</th>             
               <th>處理方式</th>
           </tr>
            <?php
              $comReplyQuery = "SELECT * FROM com_reply WHERE status = '檢舉'";
              $comReplyRec = $pdo->query($comReplyQuery);
              while($comReplyRow = $comReplyRec->fetch(PDO::FETCH_ASSOC)){
                $comId = $comReplyRow["comId"];
                $replyId = $comReplyRow["replyId"];
                $titleQuery = "SELECT * FROM comments WHERE comId = '$comId'";
                $titleRec = $pdo->query($titleQuery);
                $titleRow = $titleRec->fetch(PDO::FETCH_ASSOC);
            ?>
           <tr>
               <td><?php echo $comReplyRow["replyId"]; ?></td>
               <td><?php echo $titleRow["comPlatform"]; ?></td>
               <td><?php echo $comReplyRow["memAcc"]; ?></td>
               <td><?php echo $comReplyRow["replyDate"]; ?></td>
               <td class="replyInfoContenter">
                  <?php echo $titleRow["comTitle"]; ?>
                 <div class="replyInfo">
                   <?php echo $comReplyRow["replyContent"]; ?>
                 </div>
               </td>               
               <td>
                  <button onclick="location.href='function/reportManager.php?dealType=replyRecover&replyId=<?php echo $replyId; ?>'">恢復</button>
                  <button onclick="location.href='function/reportManager.php?dealType=replyDelete&replyId=<?php echo $replyId; ?>'">刪除</button>
               </td>
           </tr>
            <?php } ?>
           
     
      </tbody></table>

      
<!-- 以下印頁碼區 -->      
      <table class="data_table2" id="pagecss">  
          <tbody><tr>
           <td> <a href=""><font color="#8f2b2b"><u>1</u></font></a></td>
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
<script>
    $('.commentInfoContenter').hover(function(){
        $(this).children('div').slideToggle();
    })

    $('.replyInfoContenter').hover(function(){
        $(this).children('div').slideToggle();
    })
</script>