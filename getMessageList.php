<?php
ob_start();
session_start();

// $memAccount = $_SESSION["GTopiaAccount"];
$memAccount= "test";
	try {
		require_once("function/connectSQL.php");
		$echoSTR= "";

		$mailQuery = "SELECT * FROM (SELECT * FROM mail WHERE mailTo = ".$memAccount." ORDER BY mailId DESC LIMIT 0,10000) aa GROUP BY mailFrom";
		$mailRec = $pdo->query($mailQuery);
		//寄件人訊息
		$mailFromQuery = "SELECT * FROM memberdata WHERE memAccount = :mailFrom";
		$mailFromRec = $pdo->prepare($mailFromQuery);
		while ($mailRow = $mailRec->fetch(PDO::FETCH_ASSOC)) {
			
			//抓出寄件者頭像
			$mailFromRec->bindValue(":mailFrom",$mailRow["mailFrom"]);
			$mailFromRec->execute();
			$mailFromRow = $mailFromRec->fetch(PDO::FETCH_ASSOC);

			$newCheck = $mailRow["mailInfo"];
			$checKMem = $mailRow["mailFrom"];
			if($newCheck == 'forNewConverIsSettingForHiddenDoNotShowOnTheList'){

				$newConverQuery = "SELECT * FROM mail WHERE mailFrom = '$memAccount' AND mailTo = '$checKMem'";
				$newConverRec = $pdo->query($newConverQuery);
				$newConverRow = $newConverRec->fetch(PDO::FETCH_ASSOC);

				$echoSTR.= "<div id=".$memAccount."/".$mailRow["mailId"]" class='oneML ";
				if ($mailRow["status"]== "未讀") {
					$echoSTR.= "unread";
				}

				$echoSTR.= "'>
					<div class='personalImage'>
						<!-- 頭像區 -->
						<div class='limitImage'>
							<img src=".$mailFromRow["memImg"].">
						</div>
					</div>
					<div class='personalBlock'>
						<div class='personalName'>
							".$mailRow["mailFrom"]."
						</div>
						<div class='personalMessage'>
							".$newConverRow["mailInfo"]."
						</div>
					</div>
					<div class='clearfix'></div>
				</div>";
			}else{

				$echoSTR.= "<div id=".$memAccount."/".$mailRow["mailId"]" class='oneML ";
				if ($mailRow["status"]== "未讀") {
					$echoSTR.= "unread";
				}

				$echoSTR.= "'>
					<div class='personalImage'>
						<!-- 頭像區 -->
						<div class='limitImage'>
							<img src=".$mailFromRow["memImg"].">
						</div>
					</div>
					<div class='personalBlock'>
						<div class='personalName'>
							".$mailRow["mailFrom"]."
						</div>
						<div class='personalMessage'>
							".$mailRow["mailInfo"]."
						</div>
					</div>
					<div class='clearfix'></div>
				</div>";
			}
		}// while
		echo $echoSTR;
	} catch (PDOException $e) {
		echo $e->getMessage();
	}
?>