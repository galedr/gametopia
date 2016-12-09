<?php
  require_once("function/connectSQL.php");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">

<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>後端-訂單管理</title>
<link rel="shortcut icon" href="01_LOGO.png">
<style type="text/css"></style>
<link href="./view_pages.css" rel="stylesheet" type="text/css">
<script src="js/jquery-3.1.1.min.js"></script>

<style>
  .orderDetail{
    display: none;
    width: 300px;
    background-color: white;
    position: fixed;
    top: 30%;
    left: 20%;
    z-index: 10;
    text-align: center;
    outline: 6px solid black;
  }
  .orderDetail tr td{
    width: 100px;
  }
  .leaveDetail{
    width: 20px;
    height: 20px;
    text-align: center;
    background-color: white;
    z-index: 11;
    border-radius: 50%;
    position: absolute;
    top: -35%;
    right: -3%;
  }
  .orderId:hover{
    background-color: pink;
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
        <li id="menu_now">訂單管理</li>
        <li><a href="file:///C:/Users/user/Desktop/server/server_second_hand_product.html">商品管理</a></li>
        <li><a href="file:///C:/Users/user/Desktop/server/server_news.html">新聞管理</a></li>
        <li><a href="file:///C:/Users/user/Desktop/server/server_forum.html">討論區管理</a></li>
        <li><a href="file:///C:/Users/user/Desktop/server/server_station_letter.html">站內信管理</a></li>
     </ul>
     <div id="menu_footer"><a href="">登出</a></div>
  </div><!--menu-->

<div id="content_wrap">
  <div id="container">

      <div id="content_topic">              <!--標題-->
        <div id="topic">訂單管理</div>
      </div> 
     
      <div id="add"><div id="addgap">
      <!-- <form action="">
  		<select name="field">
    		<option value="normal_no">訂單查詢</option>
    		<option value="normal_name"></option>
  		</select>
  		<input type="text" name="data">
  		<input type="submit" value="搜尋">
	  </form> -->
      </div></div>  <!--新增按鈕--> 

    <div id="content_table">             <!--表格內容-->
       
       <table border="0" class="data_table">
           <tbody>
             <tr>                          <!--表格th-->
                 <th>訂單編號</th>
                 <th>訂購人</th>             
                 <th>收件人</th>
                 <th>收件人電話</th>
                 <th>收件地址</th>
                 <th>訂單總金額</th>
                 <th>訂單狀態</th>
                 <th>出貨</th>
              </tr>
              <?php
                $orderQuery = "SELECT * FROM order_list_overall WHERE status = '已結帳'";
                $orderRec = $pdo->query($orderQuery);
                while($orderRow = $orderRec->fetch(PDO::FETCH_ASSOC)){
              ?>
              <tr>
                 <td style="cursor: pointer;" class="orderId"><?php echo $orderRow["orderId"]; ?></td>
                 <td><?php echo $orderRow["orderAccount"]; ?></td>
                 <td><?php echo $orderRow["orderContecter"]; ?></td>
                 <td><?php echo $orderRow["contecterPhone"]; ?></td>
                 <td><?php echo $orderRow["contecterAddress"]; ?></td>
                 <td>$ <?php echo $orderRow["totalPrice"]; ?>元</td>
                 <td><?php echo $orderRow["status"]; ?></td>
                 <td>
                    <a href="function/server_dealOrder.php?orderId=<?php echo $orderRow["orderId"]; ?>"><input type="button" style="background-color: transparent;" id="subBtn"></a>
                 </td>
              </tr>
              <?php } ?>
           </tbody>
       </table>          
  </div>     
           
  <div class="orderDetail">
    <div class="leaveDetail" style="cursor: pointer;">X</div>
    <table class="forDetail">
      
    </table>
  </div>
  </div>        
      
     
<!-- 以下印頁碼區 -->      
      <table class="data_table2" id="pagecss">  
          <tbody><tr>
           <td><a href=""><font color="#8f2b2b"><u>1</u></font></a></td>
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
    $('.orderId').click(function(){
        var orderId = $(this).text();

        $.ajax({

          url: "function/server_orderDetail.php",
          type: "POST",
          data: {orderId:orderId},
          dataType: "JSON",
          success: function(data){
            if(data["status"] == 'success'){
              $('.orderDetail').css('display','block');
              $('.forDetail').html(data["data"]);
            }
          }

        })
    })

    $('.leaveDetail').click(function(){
        $('.orderDetail').css('display','none');
    })
</script>