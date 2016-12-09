<?php
ob_start();
session_start();

// $memAccount = $_SESSION["GTopiaAccount"];
$memAccount= "test";
	try {
		require_once("function/connectSQL.php");
		$echoSTR= "";

		if(isset($_GET["mailId"]) && ($_GET["mailId"]) != ""){
			$mailId = $_GET["mailId"];
			if(isset($_GET["mailFrom"]) && ($_GET["mailFrom"] != "")){
				$mailFrom = $_GET["mailFrom"];
			}
			//更改被點擊信件為已讀
			$readedQuery = "UPDATE mail SET status = '已讀' WHERE mailTo = '$memAccount' AND mailFrom = '$mailFrom'";
			$readedRec = $pdo->query($readedQuery);

			//選出收件與寄件人分別是目前登入會員與對象
			$mailInfoQuery = "SELECT * FROM mail WHERE (mailFrom = '$mailFrom' AND mailTo = '$memAccount') OR (mailFrom = '$memAccount' AND mailTo = '$mailFrom') ORDER BY mailId";
						
			$mailInfoRec = $pdo->query($mailInfoQuery);
			while($mailInfoRow = $mailInfoRec->fetch(PDO::FETCH_ASSOC)){

				//SQL寄件人資料
				$mailFromMem = $mailInfoRow["mailFrom"];
				$mailFromMemQuery = "SELECT * FROM memberdata WHERE memAccount = '$mailFromMem'";
				$mailFromMemRec = $pdo->query($mailFromMemQuery);
				$mailFromMemRow = $mailFromMemRec->fetch(PDO::FETCH_ASSOC);

				$converCheck = $mailInfoRow["mailInfo"];
				if($converCheck == "forNewConverIsSettingForHiddenDoNotShowOnTheList"){

				}else{
				$echoSTR.=
					"<div class='oneMessageBetweenEachOther'>

						<div class='col_xs_2 col_sm_2 imageWhoSendMessage'>
							<div class='limitImage'>
								<img src='".$mailFromMemQuery["memImg"]."'>
							</div>
						</div>
						<div class='col_xs_5 col_sm_5 messageWhoSend'>
							".$converCheck."
						</div>
						<div class='clearfix'></div>

					</div>";
				}
			}
			echo $echoSTR;
		}else{
			$echoSTR.= 
					"<div class='mailInit'>
						<span>點擊信件列表開始閱讀</span>
					</div>";
			echo $echoSTR;
		}
	} catch (PDOException $e) {
		echo $e->getMessage();
	}
?>