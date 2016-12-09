var totalOver= 0;
var k= 0;
function doFirst(){
	// 直接先看SESSION 有無資料，有的話直接LOAD 出
	changeUsedProdToSession( 'plus' );

	$(".usedInfo").on("change","input[type='file']",function(){
		// 上傳圖檔
	    var files= this.files;
	    var fileNames= "";
	    for (var i = files.length - 1; i >= 0; i--) {
	    	if(files[i].name.indexOf("jpg")!=-1 || files[i].name.indexOf("png")!=-1){
	    		k= 1;
	    		fileNames+= files[i].name+ ", ";
	    	}else{
	    		k= 0;
	    		var ori= $("#fileSelect");
	    		ori.after(ori.clone().val(""));
	    		ori.remove();
	    		alert("未上傳圖檔, 或格式有誤, 只可為 .jpg, .png");
	    	}
	    }
	    if (k) {
	    	$("#showFile").html(fileNames);
	    }
	});
	// var kkkkkk= "<?php if(isset($_SESSION['usedProd'])=== false) echo "false";else echo "true";?>";
	// if (kkkkkk== "true") {
	// 	$('.usedList .init').css('display', 'none');
	// 	$('.usedList table').css('display', 'block');
	// }else{
	// 	$('.usedList table').css('display', 'none');
	// 	$('.usedList .init').css('display', 'block');
	// }
// 三個動作 新增 移除 送出
	$('.uploadList span').click(function(){
		// 表單驗證
		if( !($("#showFile").html()=="" || $("#showFile").html()=="未上傳圖檔，或格式有誤" || $('.prodName+input').val()=="" || $('.prodSeries + select').val()=="" || $('.prodClass + select').val()=="" || $('.prodPrice+input').val()=="" || $('.prodInfo+input').val()=="") ){
			changeUsedProdToSession('plus');
		}
		else{
			if ($("#showFile").html()=="未上傳圖檔，或格式有誤") {
				alert('圖檔上傳有誤');
			}else{
				alert('有表格未填寫');
			}
		}
	});
	$('#remove').click(function(){
		changeUsedProdToSession('remove');
	});
	$('#send').click(function(){

		if (!totalOver) {
			$('#problem').html("*尚未寄賣任何東西");
		}else if ($('#checkRule').prop('checked')== false) {
			$('#problem').html("*尚未同意寄賣條款");
		}else{
			$('#problem').html("");
			changeUsedProdToSession('send');
		}

	});
// 全選限制
	$('#deAll_1').click(function(){
		if ( $(this).prop('checked') ) {

			$('#deAll_1').prop('checked', true);
			$('#deAll_2').prop('checked', true);

			$('input[name="usedProdList"]').each(function(){
				$(this).prop('checked', true);
			});
		}else{

			$('#deAll_1').prop('checked', false);
			$('#deAll_2').prop('checked', false);

			$('input[name="usedProdList"]').each(function(){
				$(this).prop('checked', false);
			});
		}
	});
	$('#deAll_2').click(function(){
		if ( $(this).prop('checked') ) {

			$('#deAll_1').prop('checked', true);
			$('#deAll_2').prop('checked', true);

			$('input[name="usedProdList"]').each(function(){
				$(this).prop('checked', true);
			});
		}else{

			$('#deAll_1').prop('checked', false);
			$('#deAll_2').prop('checked', false);

			$('input[name="usedProdList"]').each(function(){
				$(this).prop('checked', false);
			});
		}
	});
// adjax
	function changeUsedProdToSession( action ){
		var xhr= new XMLHttpRequest();
		xhr.onreadystatechange= function(){
			if (xhr.readyState== 4) {
				if (xhr.status== 200) {
					if (action== 'plus') {
						// 新增或重新整理
						dependAction(xhr.responseText, action);
						console.log(xhr.responseText);

						if (xhr.responseText=="false") {
							totalOver= 0;
							$('#send').removeAttr('onclick');
						}else{
							totalOver= 1;
						}

					}else if (action== 'remove') {
						// 移除
						console.log(xhr.responseText);
						changeUsedProdToSession('plus');
						if (xhr.responseText== "dropTable") {
							totalOver= 0;
							$('#send').removeAttr('onclick');
							$('.usedList .table').css('display', 'none');
							$('.init').css('display', 'block');
						}
					}else{
						// 送出
						if (xhr.responseText== "finish") {
							location.href = "member.php";
						}
					}
				}else{
					alert(xhr.status);
				}
			}
		};


			var formData = new FormData();

		var url= "function/changeUsedProdToSession.php";
		if (action== "plus") {

			// Get the selected files from the input.
			var files = document.getElementById('fileSelect').files;
			// Create a new FormData object.
			// Loop through each of the selected files.
			for (var i = 0; i < files.length; i++) {
			  var file = files[i];

			  // Check the file type.
			  if (!file.type.match('image.*')) {
			    continue;
			  }

			  // Add the file to the request.
			  formData.append('photos[]', file, file.name);
			}

			// url+= '&usedProdName='+ $('.prodName+input').val();
			// url+= '&usedProdSeries='+ $('.prodSeries+input').val();
			// url+= '&usedProdClass='+ $('.prodClass+input').val();
			// url+= '&usedProdPrice='+ $('.prodPrice+input').val();
			// url+= '&usedProdImages='+ $('#showFile').text();
			// url+= '&prodInfo='+ $('.prodInfo+input').val();

			// var postData= {
			// 	"action":action,
			// 	"usedProdName":$('.prodName+input').val(),
			// 	"usedProdSeries":$('.prodSeries+input').val(),
			// 	"usedProdClass":$('.prodClass+input').val(),
			// 	"usedProdPrice":$('.prodPrice+input').val(),
			// 	"usedProdImages":$('#showFile').val(),
			// 	"prodInfo":$('.prodInfo+input').val()
			// }

			formData.append( "action", action );
			formData.append( "usedProdName", $('.prodName+input').val() );
			formData.append( "usedProdSeries", $('.prodSeries+select').val() );
			formData.append( "usedProdClass", $('.prodClass+select').val() );
			formData.append( "usedProdPrice", $('.prodPrice+input').val() );
			formData.append( "prodInfo", $('.prodInfo+input').val() );


			$('.prodName+input').val('');

			$('.prodSeries+select').val('PS4');

			$('.prodClass+select').val('冒險犯難');

			$('.prodPrice+input').val('');

			$('#showFile').text('');

			$('.prodInfo+input').val('');

			// console.log(postData);
		}else if (action== "remove") {
			var deObject= "";
			var arr= [];
			var total= 0;
			var drop= 0;
			if (document.getElementById('deAll_1').checked || document.getElementById('deAll_2').checked) {
				$('.usedList .table').css('display', 'none');
				$('.init').css('display', 'block');
				// <?php unset($_SESSION['usedProd']);?>
				$('input[name="usedProdList"]').each(function(){
					if ( $(this).prop('checked') ) {
						arr.push(this.id.split('P')[1]);
					};
				});
				$('.usedList #table').html("");
				document.getElementById('deAll_1').checked= false;
				document.getElementById('deAll_2').checked= false;
			}else {
				// $('input[name="usedProdList"]').prop('checked', true);
				$('input[name="usedProdList"]').each(function(){
					total+=1;
					if ( $(this).prop('checked') ) {
						drop+=1;
						// id="UP???"
						arr.push(this.id.split('P')[1]);

						var removeTarget= '#usedprod'+ this.id.split('P')[1];
						$(removeTarget).remove();
					};
				});
				if(total == drop){
					// 當所有等於要移除的 等同於整個table 移除掉
					$('.usedList .table').css('display', 'none');
					$('.init').css('display', 'block');
				}
			}
			deObject= arr.join('a1a1a1');
			// url+= "&deProd="+ deObject;
			// var postData= {
			// 	"action":action,
			// 	"deProd":deObject
			// }
			formData.append( "action", action );
			formData.append( "deProd", deObject );
		}
		xhr.open("post", url, true);
		// xhr.setRequestHeader("content-type", "application/x-www-form-urlencoded");
		xhr.send(formData);
	}
// 新增項目的html 組成
	function dependAction( str, action ){
			
		if (str!= "false") {
			var answerStr= "";
			var totalAnswer= str.split('!__!');
			console.log(str);
			for (var i = totalAnswer.length - 1; i >= 0; i--) {
				if (totalAnswer[i]== "") {
					totalAnswer[i]= "　";
				}
			}
			for (var i =  0; i < totalAnswer.length/9 -1; i++) {
				// <div class="tr" id="usedprod序號">
				answerStr+= '<div class="tr" id='+ totalAnswer[i*9+1]+ '>';
				// 	<div class="col_xs_1 col_sm_1">
				// 		<input type="checkbox" name="usedProdList" id="UP序號">
					answerStr+= '<div class="col_xs_1 col_sm_1">';
					answerStr+= '<input type="checkbox" name="usedProdList" id='+ totalAnswer[i*9+2]+ '>'
					answerStr+= '</div>';
				// 	<div class="col_xs_1 col_sm_1">
				// 		序號
				// 	</div>
					answerStr+= '<div class="col_xs_1 col_sm_1">';
					answerStr+= totalAnswer[i*9+3];
					answerStr+= '</div>';
				// 	<div class="col_xs_4 col_sm_2">
				// 		<img src="images/商品檔名">
				// 	</div>
					answerStr+= '<div class="col_xs_4 col_sm_2">';
					answerStr+= '<img src="'+ totalAnswer[i*9+4]+ '">';
					answerStr+= '</div>';
				// 	<div class="col_xs_6 col_sm_8">
					answerStr+= '<div class="col_xs_6 col_sm_8">';
				// 		<div class="col_xs_12 col_sm_2">
				// 			商品名稱
				// 		</div>
					answerStr+= '<div class="col_xs_12 col_sm_2">';
					answerStr+= totalAnswer[i*9+5];
					answerStr+= '</div>';
				// 		<div class="col_xs_12 col_sm_2">
				// 			商品系列
				// 		</div>
					answerStr+= '<div class="col_xs_12 col_sm_2">';
					answerStr+= totalAnswer[i*9+6];
					answerStr+= '</div>';
				// 		<div class="col_xs_12 col_sm_2">
				// 			商品類別
				// 		</div>
					answerStr+= '<div class="col_xs_12 col_sm_2">';
					answerStr+= totalAnswer[i*9+7];
					answerStr+= '</div>';
				// 		<div class="col_xs_12 col_sm_2">
				// 			NT$<span>商品價格</span>
				// 		</div>
					answerStr+= '<div class="col_xs_12 col_sm_2">';
					answerStr+= totalAnswer[i*9+8];
					answerStr+= '</div>';
				// 		<div class="col_xs_12 col_sm_4">
				// 			商品簡介
				// 		</div>
					answerStr+= '<div class="col_xs_12 col_sm_4">';
					answerStr+= totalAnswer[i*9+9];
					answerStr+= '</div>';

					answerStr+= '<div class="clearfix"></div>';
					answerStr+= '</div>';
					answerStr+= '<div class="clearfix"></div>';

				answerStr+= '</div>';
			}
			$('#table').html(answerStr);
			$('.usedList .table').css('display', 'block');
			$('.init').css('display', 'none');
		}else{
			$('.usedList .table').css('display', 'none');
			$('.init').css('display', 'block');
		}
		
	}
}window.addEventListener('load', doFirst, false);