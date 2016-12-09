<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>後台管理/遊戲烏托邦-GameTopia</title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="Shortcut Icon" type="image/x-icon" href="images/gametopia.ico"/>
	<link rel="stylesheet" type="text/css" href="css/backLogin.css">
	<link href="https://fonts.googleapis.com/css?family=Exo+2" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css?family=Titillium+Web" rel="stylesheet">
</head>
<body>
	<div class="container">
		<div class="box">
			<div class="m-layer-border-box">
					<p>遊戲烏托邦</p>
					<p>G a m e</p>
					<p>T o p i a</p>
					<p>遊戲玩家的理想國度</p>
			</div>
			<div class="back_login">
			<form method="post" action="function/adminLogin.php">
				<input type="text" name="adminAccount" placeholder="請輸入帳號"><br>
				<input type="password" name="adminPassword" placeholder="請輸入密碼"><br>
				<input type="submit" name=""><br>
			</form>
			</div>		
		</div>
	</div>
</body>
</html>