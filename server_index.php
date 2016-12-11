<!DOCTYPE html>
<html lang="">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>Title Page</title>
		<link rel="stylesheet" href="css/bootstrap/css/bootstrap.min.css">
		<link rel="stylesheet" href="css/server_index.css">
		<script src="js/server_index.js"></script>
		<script src="js/jquery-3.1.0.min.js"></script>
		<script src="css/bootstrap/js/bootstrap.min.js"></script>
		<!--[if lt IE 9]>
			<script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
			<script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
		<![endif]-->
	</head>
	<body>

		<div class="container indexList
					col-lg-2 col-md-2">
			<div class="row">
				<div class="container logo">
					<img src="images/01LOGO.png" class="logoImg img-responsive">
				</div>
				<div class="list-group pageList">
					<a href="#tab_productManager" class="list-group-item active" role="presentation">商品管理</a>
					<a href="#tab_orderManager" class="list-group-item" onclick="javascript:orderRow();">訂單管理</a>
					<a href="#tab_newsManager" class="list-group-item" onclick="javascript:newsRow();">新聞管理</a>
					<a href="#tab_reportManager" class="list-group-item" onclick="reportRow();">檢舉項目管理</a>
					<!-- <a href="#" class="list-group-item">頁面管理</a> -->
				</div>		
			</div>
		</div>		
			
			
		<div class="container tab_container
					col-lg-10 col-lg-offset-2
					col-md-10 col-md-offset-2">
			<!-- 商品管理 -->
			<div id="tab_productManager">
				<div class="row">

					<!-- 上層導覽列開始 -->
					<nav class="navbar navbar-default" role="navigation">
						<div class="navbar-header">
							<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
								<span class="sr-only">選單切換</span>
								<span class="icon-bar"></span>
								<span class="icon-bar"></span>
								<span class="icon-bar"></span>
							</button>
							<a class="navbar-brand">GameTopia 後臺管理系統</a>
						</div>
					
						<!-- 手機隱藏選單區 -->
						<div class="collapse navbar-collapse navbar-ex1-collapse">
							<!-- 左選單 -->
							<ul class="nav navbar-nav">
								<li class="active"><a>商品管理</a></li>
							</ul>
										
							<!-- 右選單 -->
							<ul class="nav navbar-nav navbar-right">
								<li><a>管理者 您好</a></li>
								<li><a href="function/sessionAdmin.php?logout=true">登出</a></li>			
							</ul>
						</div>
						<!-- 手機隱藏選單區結束 -->
					</nav>
					<!-- 上層導覽列結束 -->
					
					<div class="container">
						<div class="row">
							<button class="btn btn-success" data-toggle="modal" href='#insertProduct'>新增商品</button>
						</div>
					</div>

					<!-- 商品ROW -->
					<div class="container productRow">
						<div class="row">
							<div class="container">
				
								<table class="table" id="proInfoHolder">
									<!-- 商品內容->server_index.js -->
								</table>
																
								<ul class="pagination" id="proPages">
									<!-- 分頁->server_index.js -->
								</ul>
								

							</div>
						</div>
					</div>
					
					<!-- 新增商品 -->
					<div class="modal fade" id="insertProduct">
						<div class="modal-dialog">
							<div class="modal-content">
								<div class="modal-header">
									<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
									<h4 class="modal-title">新增商品</h4>
								</div>
								<div class="modal-body">

									<form action="function/productInput.php" method="post" enctype="multipart/form-data">
										<div class="form-group">
											<label for="proName">商品名稱</label>
											<input type="text" name="proName" id="proName" class="form-control">
										</div>
										<div class="form-group">
											<label for="proSeries">主機別</label>
											<select name="proSeries" id="proSeries" class="form-control">
												<option value="">請選擇</option>
												<option value="PS4">PS4</option>
												<option value="XBOX">XBOX</option>
												<option value="Wii">Wii</option>
												<option value="PC">PC</option>
												<option value="3DS">3DS</option>
											</select>
											<label for="proClass">遊戲類型</label>
											<select name="proClass" id="proClass" class="form-control">
												 <option value="">請選擇</option>
									             <option value="冒險犯難">冒險犯難</option>
									             <option value="動作驚險">動作驚險</option>
									             <option value="多人合作">多人合作</option>
									             <option value="競速刺激">競速刺激</option>
									             <option value="策略多謀">策略多謀</option>
									             <option value="運動休閒">運動休閒</option>
									             <option value="即時射擊">即時射擊</option>
									             <option value="角色扮演">角色扮演</option>
											</select>
											<label for="proImg">商品主圖</label>
											<input type="file" name="proImg" class="form-control">
											<label for="proPic01">商品圖01</label>
											<input type="file" name="proPic01" class="form-control">
											<label for="proPic02">商品圖02</label>
											<input type="file" name="proPic02" class="form-control">
											<label for="proPic03">商品圖03</label>
											<input type="file" name="proPic03" class="form-control">
											<label for="proPrice">商品價格</label>
											<input type="text" name="proPrice" class="form-control">
											<label for="proInfo">商品描述</label>
											<textarea name="proInfo" cols="30" rows="10" class="form-control"></textarea>	
										</div>
									</div>
									<div class="modal-footer">
										<button type="button" class="btn btn-default" data-dismiss="modal">取消</button>
										<button type="submit" class="btn btn-primary">確認送出</button>
									</div>
								</form>
							</div>
						</div>
					</div>
					<!-- 新增商品結束 -->

					<!-- 修改商品 -->
					<div class="modal fade" id="updateProduct">
						<div class="modal-dialog">
							<div class="modal-content">
								<div class="modal-header">
									<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
									<h4 class="modal-title">商品修改</h4>
								</div>
								<div class="modal-body">
									<form action="function/server_productUpdate.php" method="post" enctype="multipart/form-data">
										<div class="form-group">
											<label for="proName">商品名稱</label>
											<input type="text" name="proName" id="proName" class="form-control">
										</div>
										<div class="form-group">
											<label for="proSeries">主機別</label>
											<select name="proSeries" id="proSeries" class="form-control">
												<option value="">請選擇</option>
												<option value="PS4">PS4</option>
												<option value="XBOX">XBOX</option>
												<option value="Wii">Wii</option>
												<option value="PC">PC</option>
												<option value="3DS">3DS</option>
											</select>
											<label for="proClass">遊戲類型</label>
											<select name="proClass" id="proClass" class="form-control">
												 <option value="">請選擇</option>
									             <option value="冒險犯難">冒險犯難</option>
									             <option value="動作驚險">動作驚險</option>
									             <option value="多人合作">多人合作</option>
									             <option value="競速刺激">競速刺激</option>
									             <option value="策略多謀">策略多謀</option>
									             <option value="運動休閒">運動休閒</option>
									             <option value="即時射擊">即時射擊</option>
									             <option value="角色扮演">角色扮演</option>
											</select>
											<label for="proImg">商品主圖</label>
											<input type="file" name="proImg" class="form-control">
											<label for="proPic01">商品圖01</label>
											<input type="file" name="proPic01" class="form-control">
											<label for="proPic02">商品圖02</label>
											<input type="file" name="proPic02" class="form-control">
											<label for="proPic03">商品圖03</label>
											<input type="file" name="proPic03" class="form-control">
											<label for="proPrice">商品價格</label>
											<input type="text" name="proPrice" class="form-control">
											<label for="proInfo">商品描述</label>
											<textarea name="proInfo" cols="30" rows="10" class="form-control"></textarea>	
										</div>
									</div>
									<div class="modal-footer">
										<input type="hidden" name="proId" value="" id="productUpdate">
										<button type="button" class="btn btn-default" data-dismiss="modal">取消</button>
										<button type="submit" class="btn btn-primary">確認送出</button>
									</div>
								</form>
							</div>
						</div>
					</div>
					<!-- 修改商品結束 -->

				</div>
			</div>
			<!-- 商品管理結束 -->

			<div id="tab_orderManager">
				<div class="row">
					<!-- 上層導覽列開始 -->
					<nav class="navbar navbar-default" role="navigation">
						<div class="navbar-header">
							<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
								<span class="sr-only">選單切換</span>
								<span class="icon-bar"></span>
								<span class="icon-bar"></span>
								<span class="icon-bar"></span>
							</button>
							<a class="navbar-brand">GameTopia 後臺管理系統</a>
						</div>
					
						<!-- 手機隱藏選單區 -->
						<div class="collapse navbar-collapse navbar-ex1-collapse">
							<!-- 左選單 -->
							<ul class="nav navbar-nav">
								<li class="active"><a>訂單管理</a></li>
							</ul>
										
							<!-- 右選單 -->
							<ul class="nav navbar-nav navbar-right">
								<li><a>管理者 您好</a></li>
								<li><a href="function/sessionAdmin.php?logout=true">登出</a></li>			
							</ul>
						</div>
						<!-- 手機隱藏選單區結束 -->
					</nav>
					<!-- 上層導覽列結束 -->

					<div class="container orderlistRow">
						<div class="row">

							<table class="table" id="orderInfoHolder">
									<!-- 訂單ROW->server_index.js -->
							</table>

							<ul class="pagination" id="orderPages">
									<!-- 分頁->server_index.js -->
								</ul>

						</div>
					</div>
					
					<!-- 訂單細節 -->
					<div class="modal fade" id="orderDetail">
						<div class="modal-dialog">
							<div class="modal-content">
								<div class="modal-header">
									<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
									<h4 class="modal-title">訂單內容</h4>
								</div>
								<div class="modal-body">
									<table class="table" id="orderDetailRow">
										<!-- AJAX匯入資料 -->
									</table>
								</div>
								<div class="modal-footer">
									<button type="button" class="btn btn-default" data-dismiss="modal">取消</button>
								</div>
							</div>
						</div>
					</div>
					<!-- 訂單細節結束 -->
				</div>
			</div>
			
			<!-- 新聞管理 -->
			<div id="tab_newsManager">
				<div class="row">

					<!-- 上層導覽列開始 -->
					<nav class="navbar navbar-default" role="navigation">
						<div class="navbar-header">
							<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
								<span class="sr-only">選單切換</span>
								<span class="icon-bar"></span>
								<span class="icon-bar"></span>
								<span class="icon-bar"></span>
							</button>
							<a class="navbar-brand">GameTopia 後臺管理系統</a>
						</div>
					
						<!-- 手機隱藏選單區 -->
						<div class="collapse navbar-collapse navbar-ex1-collapse">
							<!-- 左選單 -->
							<ul class="nav navbar-nav">
								<li class="active"><a>新聞管理</a></li>
							</ul>
										
							<!-- 右選單 -->
							<ul class="nav navbar-nav navbar-right">
								<li><a>管理者 您好</a></li>
								<li><a href="function/sessionAdmin.php?logout=true">登出</a></li>			
							</ul>
						</div>
						<!-- 手機隱藏選單區結束 -->
					</nav>
					<!-- 上層導覽列結束 -->

					<div class="container">
						<div class="row">
							<button class="btn btn-success" data-toggle="modal" href='#insertNews'>新增新聞</button>
						</div>
					</div>

					<div class="container newsInfoRow">
						<div class="row">
							<table class="table" id="newsInfoHolder">
									<!-- 新聞ROW->server_index.js -->
							</table>

							<ul class="pagination" id="newsPages">
									<!-- 分頁->server_index.js -->
							</ul>

						</div>
					</div>

					<!-- 新聞修改 -->
					<div class="modal fade" id="newsUpdate">
						<div class="modal-dialog">
							<div class="modal-content">
								<div class="modal-header">
									<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
									<h4 class="modal-title">新聞修改</h4>
								</div>
								<div class="modal-body">

									<form action="function/server_newsUpdate.php" method="post" enctype="multipart/form-data">
										<div class="form-group">
											<label for="newsTitle">新聞標題</label>
											<input type="text" name="newsTitle" id="newsTitle" class="form-control">
										</div>
										<div class="form-group">
											
											<label for="newsImg">新聞主圖</label>
											<input type="file" name="newsImg" class="form-control">
											<label for="newsPic01">新聞內圖01</label>
											<input type="file" name="newsPic01" class="form-control">
											<label for="newsPic02">新聞內圖02</label>
											<input type="file" name="newsPic02" class="form-control">

											<label for="newsInfo_1">新聞內文01</label>
											<textarea name="newsInfo_1" cols="30" rows="10" class="form-control"></textarea>
											<label for="newsInfo_2">新聞內文02</label>
											<textarea name="newsInfo_2" cols="30" rows="10" class="form-control"></textarea>
											<label for="newsInfo_3">新聞內文03</label>
											<textarea name="newsInfo_3" cols="30" rows="10" class="form-control"></textarea>	
											<input type="hidden" name="newsId" value="" id="newsId_update">
										</div>
									
								</div>
										<div class="modal-footer">
											<button type="button" class="btn btn-default" data-dismiss="modal">取消</button>
											<button type="submit" class="btn btn-primary">確認送出</button>
										</div>
									</form>
							</div>
						</div>
					</div>

					<!-- 新增新聞，彈出視窗 -->					
					<div class="modal fade" id="insertNews">
						<div class="modal-dialog">
							<div class="modal-content">
								<div class="modal-header">
									<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
									<h4 class="modal-title">新增新聞</h4>
								</div>
								<div class="modal-body">
									
									<form action="function/server_newsInsert.php" method="post" enctype="multipart/form-data">
										<div class="form-group">
											<label for="newsTitle">新聞標題</label>
											<input type="text" name="newsTitle" id="newsTitle" class="form-control">
										</div>
										<div class="form-group">

											<label for="newsauthor">發布者</label>
											<input type="text" name="newsauthor" class="form-control">
											<label for="newsImg">新聞主圖</label>
											<input type="file" name="newsImg" class="form-control">
											<label for="newsPic01">新聞內圖01</label>
											<input type="file" name="newsPic01" class="form-control">
											<label for="newsPic02">新聞內圖02</label>
											<input type="file" name="newsPic02" class="form-control">

											<label for="newsInfo_1">新聞內文01</label>
											<textarea name="newsInfo_1" cols="30" rows="10" class="form-control"></textarea>
											<label for="newsInfo_2">新聞內文02</label>
											<textarea name="newsInfo_2" cols="30" rows="10" class="form-control"></textarea>
											<label for="newsInfo_3">新聞內文03</label>
											<textarea name="newsInfo_3" cols="30" rows="10" class="form-control"></textarea>	

										</div>

								</div>
										<div class="modal-footer">
											<button type="button" class="btn btn-default" data-dismiss="modal">取消</button>
											<button type="submit" class="btn btn-primary">確認送出</button>
										</div>
									</form>	
							</div>
						</div>
					</div>

				</div>
			</div>
			<!-- 新聞管理結束 -->

				
			<div id="tab_reportManager">
				<div class="row">
					<!-- 上層導覽列開始 -->
					<nav class="navbar navbar-default" role="navigation">
						<div class="navbar-header">
							<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
								<span class="sr-only">選單切換</span>
								<span class="icon-bar"></span>
								<span class="icon-bar"></span>
								<span class="icon-bar"></span>
							</button>
							<a class="navbar-brand">GameTopia 後臺管理系統</a>
						</div>
					
						<!-- 手機隱藏選單區 -->
						<div class="collapse navbar-collapse navbar-ex1-collapse">
							<!-- 左選單 -->
							<ul class="nav navbar-nav">
								<li class="active"><a>檢舉管理</a></li>
							</ul>
										
							<!-- 右選單 -->
							<ul class="nav navbar-nav navbar-right">
								<li><a>管理者 您好</a></li>
								<li><a href="function/sessionAdmin.php?logout=true">登出</a></li>			
							</ul>
						</div>
						<!-- 手機隱藏選單區結束 -->
					</nav>
					<!-- 上層導覽列結束 -->
				

					<div class="container" id="comReportRow">
						<div class="row">
							<table class="table" id="comReportHolder">
									<!-- comments ROW->server_index.js -->
							</table>
							<ul class="pagination" id="comPages">
									<!-- comments分頁->server_index.js -->
							</ul>
							
							<table class="table" id="replyReportHolder">
									<!-- reply ROW->server_index.js -->
							</table>
							<ul class="pagination" id="replyPages">
									<!-- reply分頁->server_index.js -->
							</ul>

						</div>
					</div>

					<!-- 文章內容 -->
					<div class="modal fade" id="reportInfo">
						<div class="modal-dialog">
							<div class="modal-content">
								<div class="modal-header">
									<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
									<h4 class="modal-title">文章內容</h4>
								</div>
								<div class="modal-body" id="reportContent">
									<!-- 文章內容區塊 -->									
								</div>
								<div class="modal-footer">
									<button type="button" class="btn btn-default" data-dismiss="modal">取消</button>
								</div>
							</div>
						</div>
					</div>

				</div>
			</div>
			<!-- 檢舉管理結束 -->











		</div>	
		

		
	</body>
</html>