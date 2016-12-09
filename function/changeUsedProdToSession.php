<?php 
ob_start();
session_start();
error_reporting( E_ALL || ~E_NOTICE);
require_once("connectSQL.php");
// $postData=json_decode($_REQUEST['postData']);

$memAccount= $_SESSION["GTopiaAccount"];
// $memAccount="qaz020306";
$k= 1;
$STR= "";
// echo $_REQUEST["action"];
if ($_REQUEST["action"] == 'plus') {
	if ( $_REQUEST["usedProdName"] != "" ) {
		$k= CountAndReset();
		$j= $k+1;
		while ($k>= 1) {
			if ($j-$k== 1) {
				$_SESSION['usedProd'][($k)]['name']= $_REQUEST["usedProdName"];
				$_SESSION['usedProd'][($k)]['series']= $_REQUEST["usedProdSeries"];
				$_SESSION['usedProd'][($k)]['class']= $_REQUEST["usedProdClass"];
				$_SESSION['usedProd'][($k)]['price']= $_REQUEST["usedProdPrice"];
				foreach ($_FILES["photos"]["error"] as $key => $value) {
					if (file_exists("../images")===false) {
						mkdir("../images");
					}
					$from= $_FILES["photos"]["tmp_name"][$key];
					$to= "../images/". mb_convert_encoding($_FILES["photos"]["name"][$key], "utf8", auto);
					$_SESSION['usedProd'][($k)]['images'][$key]= 'images/'. mb_convert_encoding($_FILES["photos"]["name"][$key], "utf8", auto);
					copy($from, $to);

					echo $to;
				}
				$_SESSION['usedProd'][($k)]['info']= $_REQUEST["prodInfo"];
			}
			// $img= explode('//', $_SESSION['usedProd'][($j-$k)]['images']);
			

			$STR.= '!__!usedprod'.($j-$k);
			$STR.= '!__!UP'.($j-$k);
			$STR.= '!__!'.($j-$k);
			$STR.= '!__!'.$_SESSION['usedProd'][($j-$k)]['images'][0];
			$STR.= '!__!'.$_SESSION['usedProd'][($j-$k)]['name'];
			$STR.= '!__!'.$_SESSION['usedProd'][($j-$k)]['series'];
			$STR.= '!__!'.$_SESSION['usedProd'][($j-$k)]['class'];
			$STR.= '!__!NT$<span>'.$_SESSION['usedProd'][($j-$k)]['price'].'</span>';
			$STR.= '!__!'.$_SESSION['usedProd'][($j-$k)]['info'];
			$k--;
		}
	}else{
		
		if (isset($_SESSION['usedProd'])=== true) {
			$k= CountAndReset();
			$j= 1;
			while ( $j<=$k ) {
				if (isset( $_SESSION['usedProd'][($j)]['name'] )) {
					$img= explode('//', $_SESSION['usedProd'][($j)]['images']);

					$STR.= '!__!usedprod'.($j);
					$STR.= '!__!UP'.($j);
					$STR.= '!__!'.($j);
					$STR.= '!__!'.$_SESSION['usedProd'][($j)]['images'][0];
					$STR.= '!__!'.$_SESSION['usedProd'][($j)]['name'];
					$STR.= '!__!'.$_SESSION['usedProd'][($j)]['series'];
					$STR.= '!__!'.$_SESSION['usedProd'][($j)]['class'];
					$STR.= '!__!NT$<span>'.$_SESSION['usedProd'][($j)]['class'].'</span>';
					$STR.= '!__!'.$_SESSION['usedProd'][($j)]['info'];
				}
				$j++;
			}
		}else{
			$STR= "false";
		}
	}
		
}else if ($_REQUEST["action"] == 'remove') {

		$k= $_REQUEST["deProd"];
		// echo $m;
		// exit();
		// 取出要砍掉的項目
		$removeObj= explode('a1a1a1', $k);
		$m= CountAndReset();
		$num= is_array($_SESSION['usedProd']) ? $m : 0;
		foreach ($removeObj as $key => $value) {

			unset($_SESSION['usedProd'][$value]);

		}
		// 砍完重新整理
			$m= CountAndReset();

		// ( is_array($_SESSION['usedProd']) ? $m : 0 )
		if ( ($m+ 1) == 1) {
			$STR= "dropTable";
			unset($_SESSION['usedProd']);
		}

}else {
	if (isset($_SESSION['usedProd'])) {
		// require_once("function/connectSQL.php");
			// sql 產生
			$sql= "INSERT INTO products VALUES "; 

		for ($i=1; $i <= count($_SESSION['usedProd']); $i++) {

			$sql.= "(null";
			$sql.= ", 'UP". $memAccount. $i. "'";
			$sql.= ", '二手'";
			$sql.= ", '". $_SESSION['usedProd'][$i]['name']. "'";
			$sql.= ", '". $_SESSION['usedProd'][$i]['series']. "'";
			$sql.= ", '". $_SESSION['usedProd'][$i]['class']. "'";
			$images= $_SESSION['usedProd'][$k]['images'];
			for ($j=0; $j < 4 ; $j++) { 
				if ($j== 4) {
					// 只能放四張圖 Img, 01, 02, 03
					break;
				}
				if ($images[$j]== "") {
					$sql.= ", ''";
				}else{
					$sql.= ", '". $images[$j]. "'";
				}
			}
			
			$sql.= ", '". $_SESSION['usedProd'][$k]['price']. "'";
			$sql.= ", '". $_SESSION['usedProd'][$k]['info']. "'";
			$sql.= ", '$memAccount'";
			$sql.= ", 0";
			$sql.= ", '上架')";
			if ($i!=count($_SESSION['usedProd'])) {
				$sql.=',';
			}
			// PDO statement
		}
		$pdo->query($sql);
		unset($_SESSION['usedProd']);
		// header("Location:member.php" );
		$STR= "finish";
	}
		// exit();
}
		echo $STR;





function CountAndReset() {
	// unset() 不會將空間釋出
	// 所以要重新整理 才不會有空值佔有空間的錯誤
	$a= array("0");
	$p= 1;
	for ($i=1; $i <= count($_SESSION['usedProd']); $i++) { 
		if ($_SESSION['usedProd'][$p] != null) {
			$a[$i]= $_SESSION['usedProd'][$p];
			// echo $_SESSION['usedProd'][$p]['name']."/";
		}else{
			$i--;
		}
			$p++;
	}

		unset($_SESSION['usedProd']);
		foreach ($a as $key => $value) {
			if ($key== 0) {
				continue;
			}
			$_SESSION['usedProd'][$key]= $value;
		}

		return $p;
}

?>